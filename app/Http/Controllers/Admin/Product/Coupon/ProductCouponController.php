<?php

namespace App\Http\Controllers\Admin\Product\Coupon;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Interfaces\CouponInterface;

class ProductCouponController
{
    private CouponInterface $couponRepository;

    public function __construct(CouponInterface $couponRepository)
    {
        $this->couponRepository = $couponRepository;
    }

    public function index(Request $request): View
    {
        // dd($request->all());

        $request->validate([
            'keyword' => 'nullable|string|max:255',
            'perPage' => 'nullable|string',
            'sortBy' => 'nullable|string|in:id,title,position',
            'sortOrder' => 'nullable|string|in:asc,desc',
            'status' => 'nullable|string|in:0,1'
        ]);

        $perPage = $request->input('perPage', 15);
        $keyword = $request->input('keyword', '');
        $sortBy = $request->input('sortBy', 'position');
        $sortOrder = $request->input('sortOrder', 'asc');
        $filters = [
            'status' => $request->input('status', ''),
        ];
        $resp = $this->couponRepository->list($keyword, $filters, $perPage, $sortBy, $sortOrder);

        return view('admin.product.coupon.index', [
            'data' => $resp['data'],
        ]);
    }

    public function create(): View
    {
        return view('admin.product.coupon.create');
    }

    public function store(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'country_code' => 'required|min:2|max:2|exists:countries,code',
            'code' => 'required|string|min:4|max:30',
            'name' => 'required|string|min:2|max:255',
            'description' => 'nullable|string|min:2|max:1000',
            'discount_type' => 'required|string|in:percentage,fixed,free_shipping',
            
            'value' => ['required','numeric','min:0.01','max:1000000','regex:'.PRICE_REGEX],
            'max_discount_amount' => ['required','numeric','min:0.01','max:1000000','regex:'.PRICE_REGEX],
            'min_cart_value' => ['required','numeric','min:0.01','max:1000000','regex:'.PRICE_REGEX],
            
            'usage_limit' => ['required','numeric','min:1','max:1000000'],
            'usage_per_user' => ['required','numeric','min:1','max:1000000'],

            'starts_at' => 'required|date',
            'expires_at' => 'required|date',
            'show_in_frontend' => 'nullable|numeric|in:0,1',
        ]);

        $resp = $this->couponRepository->store($request->all());
        return redirect()->route('admin.product.coupon.index')->with($resp['status'], $resp['message']);
    }

    public function edit(Int $id): View|RedirectResponse
    {
        $resp = $this->couponRepository->getById($id);
        // dd($resp);
        if ($resp['code'] == 200) {
            return view('admin.product.coupon.edit', [
                'data' => $resp['data'],
            ]);
        } else {
            return redirect()->back()->with($resp['status'], $resp['message']);
        }
    }

    public function update(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'id' => 'required|integer',
            'image' => 'nullable|image|max:'.developerSettings('image_validation')->max_image_size.'|mimes:'.implode(',', developerSettings('image_validation')->image_upload_mimes_array).'|extensions:'.implode(',', developerSettings('image_validation')->image_upload_mimes_array),
            'title' => 'required|min:2|max:255',
            'short_description' => 'nullable|min:2|max:1000',
            'long_description' => 'nullable|min:2',
        ]);

        $resp = $this->couponRepository->update($request->all());
        // dd($resp);
        return redirect()->route('admin.product.coupon.index')->with($resp['status'], $resp['message']);
    }

    public function delete(Int $id)
    {
        $resp = $this->couponRepository->delete($id);
        return redirect()->back()->with($resp['status'], $resp['message']);
    }

    public function bulk(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'ids' => 'required|array',
            'action' => 'required|in:delete,archive',
        ]);

        $resp = $this->couponRepository->bulkAction($request->except('_token'));
        return redirect()->back()->with($resp['status'], $resp['message']);
    }

    public function import(Request $request)
    {
        $request->validateWithBag('importForm', [
            'file' => 'required|file|max:5000|mimes:csv,xlsx,xls',
        ]);

        $resp = $this->couponRepository->import($request->file('file'));
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
        $sortOrder = $request->input('sortOrder', 'desc');
        $filters = [
            'status' => $request->input('status', ''),
        ];

        $resp = $this->couponRepository->export($keyword, $filters, $perPage, $sortBy, $sortOrder, $type);
        if ($resp instanceof \Symfony\Component\HttpFoundation\BinaryFileResponse) {
            return $resp;
        }

        return redirect()->back()->with('error', $resp['message']);
    }

    public function position(Request $request)
    {
        $resp = $this->couponRepository->position($request->ids);
        return $resp;
        // return redirect()->back()->with($resp['status'], $resp['message']);
    }
}
