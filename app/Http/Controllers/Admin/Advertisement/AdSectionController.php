<?php

namespace App\Http\Controllers\Admin\Advertisement;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Interfaces\AdSectionInterface;

class AdSectionController
{
    public array $typesArr;
    private AdSectionInterface $adSectionRepository;

    public function __construct(AdSectionInterface $adSectionRepository)
    {
        $this->adSectionRepository = $adSectionRepository;
        $this->typesArr = ['hero', 'promo_strip', 'trust', 'product_promo', 'banner', 'sponsored', 'raw_html', 'custom'];
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
        $resp = $this->adSectionRepository->list($keyword, $filters, $perPage, $sortBy, $sortOrder);

        return view('admin.advertisement.section.index', [
            'data' => $resp['data'],
        ]);
    }

    public function create(): View
    {
        return view('admin.advertisement.section.create', [
            'typesArr' => $this->typesArr
        ]);
    }

    public function store(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'pages' => 'required|string|min:2|max:255',
            'name' => 'required|string|min:2|max:255',
            'type' => 'required|in:'.implode(',', $this->typesArr),
        ]);

        $resp = $this->adSectionRepository->store($request->all());
        return redirect()->route('admin.website.ad.section.index')->with($resp['status'], $resp['message']);
    }

    public function edit(Int $id): View
    {
        $resp = $this->adSectionRepository->getById($id);
        return view('admin.advertisement.section.edit', [
            'data' => $resp['data'],
            'typesArr' => $this->typesArr
        ]);
    }

    public function update(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'id' => 'required|integer',
            'pages' => 'required|string|min:2|max:255',
            'name' => 'required|string|min:2|max:255',
            'type' => 'required|in:'.implode(',', $this->typesArr),
        ]);

        $resp = $this->adSectionRepository->update($request->all());
        return redirect()->route('admin.website.ad.section.index')->with($resp['status'], $resp['message']);
    }

    public function delete(Int $id)
    {
        $resp = $this->adSectionRepository->delete($id);
        return redirect()->back()->with($resp['status'], $resp['message']);
    }

    public function bulk(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'ids' => 'required|array',
            'action' => 'required|in:delete,archive',
        ]);

        $resp = $this->adSectionRepository->bulkAction($request->except('_token'));
        return redirect()->back()->with($resp['status'], $resp['message']);
    }

    public function import(Request $request)
    {
        $request->validateWithBag('importForm', [
            'file' => 'required|file|max:5000|mimes:csv,xlsx,xls',
        ]);

        $resp = $this->adSectionRepository->import($request->file('file'));
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

        $resp = $this->adSectionRepository->export($keyword, $filters, $perPage, $sortBy, $sortOrder, $type);
        if ($resp instanceof \Symfony\Component\HttpFoundation\BinaryFileResponse) {
            return $resp;
        }

        return redirect()->back()->with('error', $resp['message']);
    }

    public function position(Request $request)
    {
        $resp = $this->adSectionRepository->position($request->ids);
        return $resp;
        // return redirect()->back()->with($resp['status'], $resp['message']);
    }
}
