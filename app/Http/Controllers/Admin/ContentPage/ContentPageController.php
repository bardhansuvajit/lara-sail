<?php

namespace App\Http\Controllers\Admin\ContentPage;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Interfaces\ContentPageInterface;

class ContentPageController
{
    private ContentPageInterface $contentPageRepository;

    public function __construct(ContentPageInterface $contentPageRepository)
    {
        $this->contentPageRepository = $contentPageRepository;
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
        $sortBy = $request->input('sortBy', 'title');
        $sortOrder = $request->input('sortOrder', 'asc');
        $filters = [
            'status' => $request->input('status', ''),
        ];
        $resp = $this->contentPageRepository->list($keyword, $filters, $perPage, $sortBy, $sortOrder);

        return view('admin.content.page.index', [
            'data' => $resp['data'],
        ]);
    }

    public function create(): View
    {
        return view('admin.content.page.create');
    }

    public function store(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'title' => 'required|min:2|max:255',
            'content' => 'required|string',
            'section' => 'nullable',
            'meta_title' => 'nullable|string',
            'meta_description' => 'nullable|string',
        ]);

        $resp = $this->contentPageRepository->store($request->all());
        return redirect()->route('admin.website.content.page.index')->with($resp['status'], $resp['message']);
    }

    public function edit(int $id): View
    {
        $resp = $this->contentPageRepository->getById($id);
        return view('admin.content.page.edit', [
            'data' => $resp['data'],
        ]);
    }

    public function update(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'id' => 'required|integer',
            'title' => 'required|min:2|max:255',
            'content' => 'required|string',
            'section' => 'nullable',
            'meta_title' => 'nullable|string',
            'meta_description' => 'nullable|string',
        ]);

        $resp = $this->contentPageRepository->update($request->all());
        return redirect()->back()->with($resp['status'], $resp['message']);
        // return redirect()->route('admin.website.content.page.index')->with($resp['status'], $resp['message']);
    }

    public function delete(int $id)
    {
        $resp = $this->contentPageRepository->delete($id);
        return redirect()->back()->with($resp['status'], $resp['message']);
    }

    public function bulk(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'ids' => 'required|array',
            'action' => 'required|in:delete,archive',
        ]);

        $resp = $this->contentPageRepository->bulkAction($request->except('_token'));
        return redirect()->back()->with($resp['status'], $resp['message']);
    }

    public function import(Request $request)
    {
        $request->validateWithBag('importForm', [
            'file' => 'required|file|max:5000|mimes:csv,xlsx,xls',
        ]);

        $resp = $this->contentPageRepository->import($request->file('file'));
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

        $resp = $this->contentPageRepository->export($keyword, $filters, $perPage, $sortBy, $sortOrder, $type);
        if ($resp instanceof \Symfony\Component\HttpFoundation\BinaryFileResponse) {
            return $resp;
        }

        return redirect()->back()->with('error', $resp['message']);
    }
}
