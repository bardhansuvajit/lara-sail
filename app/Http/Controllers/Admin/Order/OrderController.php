<?php

namespace App\Http\Controllers\Admin\Order;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Validation\Rule;
use App\Interfaces\OrderInterface;
use App\Interfaces\ShippingMethodInterface;
use App\Interfaces\OrderStatusInterface;
use App\Interfaces\PaymentMethodStatusInterface;

class OrderController
{
    private OrderInterface $orderRepository;
    private ShippingMethodInterface $shippingMethodRepository;
    private OrderStatusInterface $orderStatusRepository;
    private PaymentMethodStatusInterface $paymentMethodStatusRepository;

    public function __construct(
        OrderInterface $orderRepository, 
        ShippingMethodInterface $shippingMethodRepository, 
        OrderStatusInterface $orderStatusRepository, 
        PaymentMethodStatusInterface $paymentMethodStatusRepository
    )
    {
        $this->orderRepository = $orderRepository;
        $this->shippingMethodRepository = $shippingMethodRepository;
        $this->orderStatusRepository = $orderStatusRepository;
        $this->paymentMethodStatusRepository = $paymentMethodStatusRepository;
    }

    public function index(Request $request): View
    {
        // dd($request->all());

        $request->validate([
            'keyword' => 'nullable|string|max:255',
            'perPage' => 'nullable|string',
            'sortBy' => 'nullable|string|in:id,first_name,last_name',
            'sortOrder' => 'nullable|string|in:asc,desc',
            'status' => 'nullable|string',
            'countryCode' => 'nullable|string',
            'shippingMethodId' => 'nullable|integer'
        ]);

        $perPage = $request->input('perPage', 15);
        $keyword = $request->input('keyword', '');
        $sortBy = $request->input('sortBy', 'id');
        $sortOrder = $request->input('sortOrder', 'desc');
        $filters = [
            'status' => $request->input('status', ''),
            'country_code' => $request->input('countryCode', ''),
            'shipping_method_id' => $request->input('shippingMethodId', ''),
        ];
        $resp = $this->orderRepository->list($keyword, $filters, $perPage, $sortBy, $sortOrder);

        // Order status
        $orderStatus = developerSettings('order_status');

        // Shipping methods
        $shippingMethods = $this->shippingMethodRepository->list('', [], 'all', 'id', 'asc')['data'];

        return view('admin.order.index', [
            'data' => $resp['data'],
            'orderStatus' => $orderStatus,
            'shippingMethods' => $shippingMethods
        ]);
    }

    public function store(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'country_code' => 'required|string:2|max:2|exists:countries,code',
            'first_name' => 'required|string|min:2|max:100',
            'last_name' => 'required|string|min:2|max:100',
            'email' => [
                'nullable',
                'string',
                'min:2',
                'max:100',
                Rule::unique('users', 'email')->ignore($request->id)
            ],
            'primary_phone_no' => [
                'required',
                Rule::unique('users', 'primary_phone_no')->ignore($request->id)
            ],
            'alt_phone_no' => 'nullable',
            'gender_id' => 'required|in:1,2,3,4',
            'date_of_birth' => 'nullable|date',

            'profile_picture' => 'nullable|image|max:'.developerSettings('image_validation')->max_image_size.'|mimes:'.implode(',', developerSettings('image_validation')->image_upload_mimes_array).'|extensions:'.implode(',', developerSettings('image_validation')->image_upload_mimes_array),
        ], [
            'profile_picture.max' => 'The image field must not be greater than '.developerSettings('image_validation')->max_image_size_in_mb.'.',
        ]);

        $resp = $this->orderRepository->store($request->all());
        return redirect()->route('admin.order.index')->with($resp['status'], $resp['message']);
    }

    public function edit(Int $id): View
    {
        $resp = $this->orderRepository->getById($id);
        $orderStatuses = $this->orderStatusRepository->list('', [], 'all', 'position', 'asc');
        $paymentMethodStatuses = $this->paymentMethodStatusRepository->list('', [], 'all', 'position', 'asc');

        // dd($resp['data']);

        return view('admin.order.edit', [
            'order' => $resp['data'],
            'orderStatuses' => $orderStatuses['data'] ?? [],
            'paymentMethodStatuses' => $paymentMethodStatuses['data'] ?? [],
        ]);
    }

    public function update(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'id' => 'required|integer|min:1',
            'country_code' => 'required|string:2|max:2|exists:countries,code',
            'first_name' => 'required|string|min:2|max:100',
            'last_name' => 'required|string|min:2|max:100',
            'email' => [
                'nullable',
                'string',
                'min:2',
                'max:100',
                Rule::unique('users', 'email')->ignore($request->id)
            ],
            'primary_phone_no' => [
                'required',
                Rule::unique('users', 'primary_phone_no')->ignore($request->id)
            ],
            'alt_phone_no' => 'nullable',
            'gender_id' => 'required|in:1,2,3,4',
            'date_of_birth' => 'nullable|date',

            'profile_picture' => 'nullable|image|max:'.developerSettings('image_validation')->max_image_size.'|mimes:'.implode(',', developerSettings('image_validation')->image_upload_mimes_array).'|extensions:'.implode(',', developerSettings('image_validation')->image_upload_mimes_array),
        ], [
            'profile_picture.max' => 'The image field must not be greater than '.developerSettings('image_validation')->max_image_size_in_mb.'.',
        ]);

        $resp = $this->orderRepository->update($request->all());
        return redirect()->back()->with($resp['status'], $resp['message']);
    }

    public function updateStatus(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'id' => 'required|integer|min:1',
            'status' => 'required|string|min:2|exists:order_statuses,slug',
            'previous_status' => 'required|string|min:2|exists:order_statuses,slug',
            'notes' => 'required|string|min:2',
            'icon' => 'required|string',
            'class' => 'required|string|min:2',
        ]);

        // $resp = $this->orderRepository->updateStatus($request->all());
        $data = $request->only(['id', 'status', 'previous_status', 'notes', 'icon', 'class']) + [
            'actor_type' => 'admin',
            'actor_id' => auth()->guard('admin')->user()->id,
        ];

        $resp = $this->orderRepository->updateStatus($data);
        return redirect()->back()->with($resp['status'], $resp['message']);
    }

    public function delete(Int $id)
    {
        $resp = $this->orderRepository->delete($id);
        return redirect()->back()->with($resp['status'], $resp['message']);
    }

    public function bulk(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'ids' => 'required|array',
            'action' => 'required|in:delete,archive',
        ]);

        $resp = $this->orderRepository->bulkAction($request->except('_token'));
        return redirect()->back()->with($resp['status'], $resp['message']);
    }

    public function import(Request $request)
    {
        $request->validateWithBag('importForm', [
            'file' => 'required|file|max:5000|mimes:csv,xlsx,xls',
        ]);

        $resp = $this->orderRepository->import($request->file('file'));
        return redirect()->back()->with($resp['status'], $resp['message']);
    }

    public function export(Request $request, String $type)
    {
        $request->validate([
            'keyword' => 'nullable|string|max:255',
            'perPage' => 'nullable|string',
            'sortBy' => 'nullable|string|in:id,title,slug',
            'sortOrder' => 'nullable|string|in:asc,desc',
            'status' => 'nullable|string|in:0,1'
        ]);

        $perPage = $request->input('perPage', 15);
        $keyword = $request->input('keyword', '');
        $sortBy = $request->input('sortBy', 'id');
        $sortOrder = $request->input('sortOrder', 'asc');
        $filters = [
            'status' => $request->input('status', ''),
        ];

        $resp = $this->orderRepository->export($keyword, $filters, $perPage, $sortBy, $sortOrder, $type);
        if ($resp instanceof \Symfony\Component\HttpFoundation\BinaryFileResponse) {
            return $resp;
        }

        return redirect()->back()->with('error', $resp['message']);
    }
}
