<?php

namespace App\Http\Controllers\Admin\State;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Interfaces\StateInterface;

class StateController
{
    private StateInterface $stateRepository;

    public function __construct(StateInterface $stateRepository)
    {
        $this->stateRepository = $stateRepository;
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
        $sortOrder = $request->input('sortOrder', 'asc');
        $filters = [
            'status' => $request->input('status', ''),
        ];
        $resp = $this->stateRepository->list($keyword, $filters, $perPage, $sortBy, $sortOrder);

        return view('admin.state.index', [
            'data' => $resp['data'],
        ]);
    }

    public function create(): View
    {
        return view('admin.state.create');
    }

    public function store(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'image' => 'nullable|image|max:1000',
            'title' => 'required|min:2|max:255',
            'level' => 'required|in:1,2,3,4',
            'parent_id' => 'nullable',
        ]);

        $resp = $this->stateRepository->store($request->all());
        return redirect()->route('admin.state.index')->with($resp['status'], $resp['message']);
    }

    public function edit(int $id): View
    {
        $resp = $this->stateRepository->getById($id);
        return view('admin.state.edit', [
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

        $resp = $this->stateRepository->update($request->all());
        return redirect()->route('admin.state.index')->with($resp['status'], $resp['message']);
    }

    public function delete(int $id)
    {
        $resp = $this->stateRepository->delete($id);
        return redirect()->back()->with($resp['status'], $resp['message']);
    }

    public function bulk(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'ids' => 'required|array',
            'action' => 'required|in:delete,archive',
        ]);

        $resp = $this->stateRepository->bulkAction($request->except('_token'));
        return redirect()->back()->with($resp['status'], $resp['message']);
    }

    public function import(Request $request)
    {
        $request->validateWithBag('importForm', [
            'file' => 'required|file|max:5000|mimes:csv,xlsx,xls',
        ]);

        $resp = $this->stateRepository->import($request->file('file'));
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

        $resp = $this->stateRepository->export($keyword, $filters, $perPage, $sortBy, $sortOrder, $type);
        if ($resp instanceof \Symfony\Component\HttpFoundation\BinaryFileResponse) {
            return $resp;
        }

        return redirect()->back()->with('error', $resp['message']);
    }
}
