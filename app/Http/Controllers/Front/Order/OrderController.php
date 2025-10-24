<?php

namespace App\Http\Controllers\Front\Order;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Interfaces\CartInterface;
use App\Interfaces\AddressInterface;
use App\Interfaces\OrderInterface;
use App\Interfaces\PaymentMethodInterface;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cookie;
use Barryvdh\DomPDF\Facade\Pdf;

class OrderController extends Controller
{
    private CartInterface $cartRepository;
    private AddressInterface $addressRepository;
    private OrderInterface $orderRepository;
    private PaymentMethodInterface $paymentMethodRepository;

    public function __construct(
        CartInterface $cartRepository, 
        AddressInterface $addressRepository, 
        OrderInterface $orderRepository,
        PaymentMethodInterface $paymentMethodRepository
    )
    {
        $this->cartRepository = $cartRepository;
        $this->addressRepository = $addressRepository;
        $this->orderRepository = $orderRepository;
        $this->paymentMethodRepository = $paymentMethodRepository;
    }

    public function index(): View
    {
        $userId = auth()->guard('web')->user()->id;
        // $orders = $this->orderRepository->exists([
        //     'user_id' => $userId
        // ]);
        $orders = $this->orderRepository->list('', [
            'user_id' => $userId
        ], 15, 'id', 'desc');

        return view('front.account.order.index', [
            'user' => auth()->guard('web')->user(),
            'orders' => $orders['data']
        ]);
    }

    public function store(Request $request)
    {
        // dd($request->all());

        $validated = $request->validate([
            'payment_method' => 'required|exists:payment_methods,id',
            'shipping_address_id' => 'required|exists:user_addresses,id',
            // 'billing_address_id' => 'nullable|exists:user_addresses,id',
            'billing_address_id' => 'nullable'
        ]);

        // dd('here');

        DB::beginTransaction();

        try {
            $user = auth()->guard('web')->user();

            if (!$user) {
                return back()->with('error', 'Authentication required to place order.');
            }

            $deviceId = $_COOKIE['device_id'] ?? null;
            if (!$deviceId) {
                return back()->with('error', 'Device identification missing.');
            }

            // Get cart Data
            $cartResponse = $this->cartRepository->exists(['user_id' => $user->id]);
            if ($cartResponse['code'] != 200) {
                return back()->with('error', 'Invalid cart data.');
            }
            $cart = $cartResponse['data'];

            // Get Shipping Address Data
            $addressResponse = $this->addressRepository->exists([
                'id' => $validated['shipping_address_id'],
                'user_id' => $user->id,
                'address_type' => 'shipping',
            ]);

            if ($addressResponse['code'] != 200) {
                return back()->with('error', 'Invalid shipping address.');
            }
            $shippingAddress = json_encode($addressResponse['data'][0]);

            // Handle Billing Address
            $billingAddress = null;
            if (!empty($validated['billing_address_id'])) {
                $billingResponse = $this->addressRepository->exists([
                    'id' => $validated['billing_address_id'],
                    'user_id' => $user->id,
                    'address_type' => 'billing', // Fixed from 'shipping' to 'billing'
                ]);

                if ($billingResponse['code'] != 200) {
                    return back()->with('error', 'Invalid billing address.');
                }
                $billingAddress = json_encode($billingResponse['data'][0]);
            }

            // Payment Method details
            $paymentMethodId = $validated['payment_method'];
            $paymentMethodResponse = $this->paymentMethodRepository->getById($paymentMethodId);
            if ($paymentMethodResponse['code'] != 200) {
                return back()->with('error', 'Invalid Payment Method.');
            }
            $paymentMethodStatus = isset($paymentMethodResponse['data']->statuses[0])
                ? $paymentMethodResponse['data']->statuses[0]->slug
                : 'unpaid';
            
            // dd($paymentMethodResponse['data']->statuses[0]->slug);
            // Prepare order data
            $orderData = [
                'cart_items' => $cart->items,

                'user_id' => $user->id,
                'user_first_name' => $user->first_name,
                'user_last_name' => $user->last_name,
                'device_id' => $cart->device_id,
                'email' => $user->email ?? null,
                'phone_no' => $user->primary_phone_no,

                'country' => $cart->country,
                'currency_code' => $cart->currency_code,

                'total_items' => $cart->total_items,
                'mrp' => $cart->mrp,
                'sub_total' => $cart->sub_total,
                'total' => $cart->total,

                'coupon_code_id' => $cart->coupon_code_id,
                'coupon_code' => $cart->coupon_code,
                'coupon_discount_amount' => $cart->coupon_discount_amount,
                'coupon_meta' => $cart->coupon_meta,

                'shipping_method_id' => $cart->shipping_method_id,
                'shipping_method_name' => $cart->shippingMethod->method,
                'shipping_cost' => $cart->shipping_cost,
                'shipping_address' => $shippingAddress,

                'billing_address' => $billingAddress,
                'same_as_shipping' => $billingAddress === null,

                'tax_amount' => $cart->tax_amount,
                'tax_type' => $cart->tax_type,
                'tax_details' => $cart->tax_details,

                'payment_method_id' => $validated['payment_method'],
                'payment_method_title' => $cart->payment_method_title,
                'payment_method_charge' => $cart->payment_method_charge,
                'payment_method_discount' => $cart->payment_method_discount,
                'payment_status' => $paymentMethodStatus,
                'transaction_id' => null,
                'payment_details' => null,

                'cart_meta' => json_encode($cart)
            ];

            $orderResponse = $this->orderRepository->store($orderData);

            if ($orderResponse['code'] != 200) {
                throw new \Exception('Order creation failed');
            }

            // Delete from Cart
            $cartDeleteResp = $this->cartRepository->delete($cart->id);

            DB::commit();

            // Store order ID in session for thank you page access control
            $request->session()->put('last_order_number', $orderResponse['data']->order_number);

            return redirect()->route('front.order.thankyou', ['orderNumber' => $orderResponse['data']->order_number])->with('success', 'Order placed successfully!');
        } catch (\Exception $e) {
            DB::rollback();

            logger()->channel('orders')->error('Order failed', [
                'user' => $user?->id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return back()->withInput()->with('error', 'Order failed. Our team has been notified.');
            // throw $th;
        }
    }

    public function thankyou(Request $request): View|RedirectResponse
    {
        $userId = auth()->guard('web')->user()->id;

        // $orderResponse = $this->orderRepository->exists([
        //     'user_id' => $userId,
        //     'order_number' => $_GET['orderNumber'],
        // ]);

        if (!$request->session()->has('last_order_number')) {
            return redirect()->route('front.order.detail', $_GET['orderNumber']);
        }

        $orderNumber = $request->session()->pull('last_order_number');

        // fetch order details to display
        // $orderResponse = $this->orderRepository->getById($orderNumber);
        $orderResponse = $this->orderRepository->exists([
            'user_id' => $userId,
            'order_number' => $orderNumber,
        ]);

        if ($orderResponse['code'] != 200) {
            return redirect()->route('front.home.index')->with('error', 'Order not found.');
        }

        return view('front.checkout.thankyou', [
            'order' => $orderResponse['data'][0]
        ]);
    }

    public function invoice(Request $request, $orderNumber): View|RedirectResponse {
        $userId = auth()->guard('web')->user()->id;

        $orders = $this->orderRepository->exists([
            'user_id' => $userId,
            'order_number' => $orderNumber
        ]);

        if ($orders['code'] == 200) {
            return view('front.account.invoice.index', [
                'user' => auth()->guard('web')->user(),
                'order' => $orders['data'][0]
            ]);
        } else {
            return redirect()->back()->with($orders['status'], $orders['message']);
        }
    }

    public function detail(Request $request, $orderNumber)
    {
        $userId = auth()->guard('web')->user()->id;
        // $orders = $this->orderRepository->exists([
        //     'user_id' => $userId
        // ]);
        // $orders = $this->orderRepository->list('', [
        //     'user_id' => $userId
        // ], 15, 'id', 'desc');

        // return view('front.account.order.index', [
        //     'user' => auth()->guard('web')->user(),
        //     'orders' => $orders['data']
        // ]);


        $order = \App\Models\Order::with(['items', 'user', 'paymentMethod', 'shippingMethod'])
            ->where('order_number', $orderNumber)
            ->firstOrFail();

        if (auth()->check()) {
            if ($order->user_id !== auth()->id()) {
                abort(404);
            }
        } else {
            abort(404);
        }

        return view('front.account.order.detail', [
            'user' => auth()->guard('web')->user(),
            'order' => $order
        ]);

        // return view('front.account.order.detail', compact('order'));
    }

    public function downloadInvoice($orderNumber)
    {
        $order = \App\Models\Order::with('items')
            ->where('order_number', $orderNumber)
            ->firstOrFail();

        // Check if user is authorized to view this invoice
        if (auth()->check()) {
            if ($order->user_id !== auth()->id()) {
                abort(404);
            }
        } else {
            // For guest users, you might want to implement additional verification
            abort(404);
        }

        $pdf = Pdf::loadView('front.account.invoice.download', compact('order'));

        return $pdf->download("invoice-{$order->order_number}.pdf");
    }
}
