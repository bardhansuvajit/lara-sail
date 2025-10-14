<?php

namespace App\Http\Controllers\Admin\Advertisement;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Interfaces\AdItemInterface;
use App\Interfaces\AdSectionInterface;

class AdItemController
{
    public array $typesArr;
    private AdItemInterface $adItemRepository;
    private AdSectionInterface $adSectionRepository;

    public function __construct(AdItemInterface $adItemRepository, AdSectionInterface $adSectionRepository)
    {
        $this->adItemRepository = $adItemRepository;
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
        $sortBy = $request->input('sortBy', 'id');
        $sortOrder = $request->input('sortOrder', 'desc');
        $filters = [
            'ad_section_id' => $request->input('ad_section_id', ''),
            'status' => $request->input('status', ''),
        ];
        $resp = $this->adItemRepository->list($keyword, $filters, $perPage, $sortBy, $sortOrder);

        return view('admin.advertisement.item.index', [
            'data' => $resp['data'],
        ]);
    }

    public function create(): View
    {
        return view('admin.advertisement.item.create', [
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

        $resp = $this->adItemRepository->store($request->all());
        return redirect()->route('admin.website.ad.item.index')->with($resp['status'], $resp['message']);
    }

    public function edit(Int $id): View
    {
        $adSections = $this->adSectionRepository->list('', ['status' => 1], 'all', 'position', 'asc');
        $resp = $this->adItemRepository->getById($id);

        return view('admin.advertisement.item.edit', [
            'data' => $resp['data'],
            'typesArr' => $this->typesArr,
            'adSections' => $adSections['data'],
        ]);
    }

    public function update(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'id' => 'required|integer|min:1',
            'ad_section_id' => 'required|integer|min:1|exists:ad_sections,id',
            'country_code' => 'required|string|exists:countries,code',
            'title' => 'required|string|min:2|max:255',
            'subtitle' => 'required|string|min:2',
            'url' => 'nullable|string|min:2',
        ]);

        $resp = $this->adItemRepository->update($request->all());
        return redirect()->back()->with($resp['status'], $resp['message']);
        // return redirect()->route('admin.website.ad.item.index')->with($resp['status'], $resp['message']);
    }

    public function delete(Int $id)
    {
        $resp = $this->adItemRepository->delete($id);
        return redirect()->back()->with($resp['status'], $resp['message']);
    }

    public function bulk(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'ids' => 'required|array',
            'action' => 'required|in:delete,archive',
        ]);

        $resp = $this->adItemRepository->bulkAction($request->except('_token'));
        return redirect()->back()->with($resp['status'], $resp['message']);
    }

    public function import(Request $request)
    {
        $request->validateWithBag('importForm', [
            'file' => 'required|file|max:5000|mimes:csv,xlsx,xls',
        ]);

        $resp = $this->adItemRepository->import($request->file('file'));
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

        $resp = $this->adItemRepository->export($keyword, $filters, $perPage, $sortBy, $sortOrder, $type);
        if ($resp instanceof \Symfony\Component\HttpFoundation\BinaryFileResponse) {
            return $resp;
        }

        return redirect()->back()->with('error', $resp['message']);
    }

    public function position(Request $request)
    {
        $resp = $this->adItemRepository->position($request->ids);
        return $resp;
        // return redirect()->back()->with($resp['status'], $resp['message']);
    }
}
