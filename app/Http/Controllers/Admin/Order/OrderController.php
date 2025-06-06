<?php

namespace App\Http\Controllers\Admin\Order;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Validation\Rule;
use App\Interfaces\OrderInterface;

class OrderController
{
    private OrderInterface $orderRepository;

    public function __construct(OrderInterface $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function index(Request $request): View
    {
        // dd($request->all());

        $request->validate([
            'keyword' => 'nullable|string|max:255',
            'perPage' => 'nullable|string',
            'sortBy' => 'nullable|string|in:id,first_name,last_name',
            'sortOrder' => 'nullable|string|in:asc,desc',
            'status' => 'nullable|string|in:0,1',
            'countryCode' => 'nullable|string'
        ]);

        $perPage = $request->input('perPage', 15);
        $keyword = $request->input('keyword', '');
        $sortBy = $request->input('sortBy', 'id');
        $sortOrder = $request->input('sortOrder', 'desc');
        $filters = [
            'status' => $request->input('status', ''),
            'country_code' => $request->input('countryCode', ''),
        ];
        $resp = $this->orderRepository->list($keyword, $filters, $perPage, $sortBy, $sortOrder);

        return view('admin.order.index', [
            'data' => $resp['data'],
        ]);
    }

    public function create(): View
    {
        return view('admin.order.create');
    }

    public function store(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'country_code' => 'required|string:2|max:2|exists:countries,short_name',
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
        return view('admin.order.edit', [
            'data' => $resp['data'],
        ]);
    }

    public function update(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'id' => 'required|integer|min:1',
            'country_code' => 'required|string:2|max:2|exists:countries,short_name',
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
