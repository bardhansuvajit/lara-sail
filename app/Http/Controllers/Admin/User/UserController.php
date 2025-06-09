<?php

namespace App\Http\Controllers\Admin\User;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Validation\Rule;
use App\Interfaces\UserInterface;

class UserController
{
    private UserInterface $userRepository;

    public function __construct(UserInterface $userRepository)
    {
        $this->userRepository = $userRepository;
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
        $resp = $this->userRepository->list($keyword, $filters, $perPage, $sortBy, $sortOrder);

        return view('admin.user.index', [
            'data' => $resp['data'],
        ]);
    }

    public function create(): View
    {
        return view('admin.user.create');
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

        $resp = $this->userRepository->store($request->all());

        if (isset($request->redirect_to) && $request->redirect_to == "offline-order") {
            return redirect()->route('admin.order.offline.create', [
                'country' => $request->country_code,
                'phone-no' => $request->primary_phone_no
            ])->with($resp['status'], $resp['message']);
        } else {
            return redirect()->route('admin.user.index')->with($resp['status'], $resp['message']);
        }

    }

    public function edit(Int $id): View
    {
        $resp = $this->userRepository->getById($id);
        return view('admin.user.edit', [
            'data' => $resp['data'],
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

        $resp = $this->userRepository->update($request->all());
        return redirect()->back()->with($resp['status'], $resp['message']);
    }

    public function delete(Int $id)
    {
        $resp = $this->userRepository->delete($id);
        return redirect()->back()->with($resp['status'], $resp['message']);
    }

    public function bulk(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'ids' => 'required|array',
            'action' => 'required|in:delete,archive',
        ]);

        $resp = $this->userRepository->bulkAction($request->except('_token'));
        return redirect()->back()->with($resp['status'], $resp['message']);
    }

    public function import(Request $request)
    {
        $request->validateWithBag('importForm', [
            'file' => 'required|file|max:5000|mimes:csv,xlsx,xls',
        ]);

        $resp = $this->userRepository->import($request->file('file'));
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

        $resp = $this->userRepository->export($keyword, $filters, $perPage, $sortBy, $sortOrder, $type);
        if ($resp instanceof \Symfony\Component\HttpFoundation\BinaryFileResponse) {
            return $resp;
        }

        return redirect()->back()->with('error', $resp['message']);
    }
}
