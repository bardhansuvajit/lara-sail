<?php

namespace App\Http\Controllers\Admin\Banner;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Interfaces\BannerInterface;

class BannerController
{
    private BannerInterface $bannerRepository;

    public function __construct(BannerInterface $bannerRepository)
    {
        $this->bannerRepository = $bannerRepository;
    }

    public function index(Request $request): View
    {
        // dd($request->all());

        $request->validate([
            'keyword' => 'nullable|string|max:255',
            'perPage' => 'nullable|string',
            'sortBy' => 'nullable|string|in:id,title,slug',
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
        $resp = $this->bannerRepository->list($keyword, $filters, $perPage, $sortBy, $sortOrder);

        return view('admin.banner.index', [
            'data' => $resp['data'],
        ]);
    }

    public function create(): View
    {
        return view('admin.banner.create');
    }

    public function store(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'title' => 'required|min:2|max:255',
            'description' => 'nullable|min:2|max:10000',
            'start_at' => 'required|date',
            'end_at' => 'required|date|after:start_at',

            'web_image' => 'required|image|max:1000',
            'app_image' => 'required|image|max:1000',

            'web_redirect_url' => 'required|url|min:2',
            'mobile_redirect_target' => 'required|min:2',
            'mobile_redirect_type' => 'required|in:screen,deep-link,url'
        ]);

        $resp = $this->bannerRepository->store($request->all());
        return redirect()->route('admin.website.banner.index')->with($resp['status'], $resp['message']);
    }

    public function edit(Int $id): View
    {
        $resp = $this->bannerRepository->getById($id);
        return view('admin.banner.edit', [
            'data' => $resp['data'],
        ]);
    }

    public function update(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'id' => 'required|integer',
            'image' => 'nullable|image|max:1000',
            'title' => 'required|min:2|max:255',
            'level' => 'required|in:1,2,3,4',
            'parent_id' => 'nullable',
        ]);

        $resp = $this->bannerRepository->update($request->all());
        return redirect()->route('admin.website.banner.index')->with($resp['status'], $resp['message']);
    }

    public function delete(Int $id)
    {
        $resp = $this->bannerRepository->delete($id);
        return redirect()->back()->with($resp['status'], $resp['message']);
    }

    public function bulk(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'ids' => 'required|array',
            'action' => 'required|in:delete,archive',
        ]);

        $resp = $this->bannerRepository->bulkAction($request->except('_token'));
        return redirect()->back()->with($resp['status'], $resp['message']);
    }

    public function import(Request $request)
    {
        $request->validateWithBag('importForm', [
            'file' => 'required|file|max:5000|mimes:csv,xlsx,xls',
        ]);

        $resp = $this->bannerRepository->import($request->file('file'));
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

        $resp = $this->bannerRepository->export($keyword, $filters, $perPage, $sortBy, $sortOrder, $type);
        if ($resp instanceof \Symfony\Component\HttpFoundation\BinaryFileResponse) {
            return $resp;
        }

        return redirect()->back()->with('error', $resp['message']);
    }

    public function position(Request $request)
    {
        $resp = $this->bannerRepository->position($request->ids);
        return $resp;
        // return redirect()->back()->with($resp['status'], $resp['message']);
    }
}
