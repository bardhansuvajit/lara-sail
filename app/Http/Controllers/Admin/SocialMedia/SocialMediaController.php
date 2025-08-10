<?php

namespace App\Http\Controllers\Admin\SocialMedia;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Interfaces\SocialMediaInterface;

class SocialMediaController
{
    private SocialMediaInterface $socialMediaRepository;

    public function __construct(SocialMediaInterface $socialMediaRepository)
    {
        $this->socialMediaRepository = $socialMediaRepository;
    }

    public function index(Request $request): View
    {
        // dd($request->all());

        $request->validate([
            'keyword' => 'nullable|string|max:255',
            'perPage' => 'nullable|string',
            'sortBy' => 'nullable|string|in:id,name,position',
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
        $resp = $this->socialMediaRepository->list($keyword, $filters, $perPage, $sortBy, $sortOrder);

        return view('admin.social-media.index', [
            'data' => $resp['data'],
        ]);
    }

    public function create(): View
    {
        return view('admin.social-media.create');
    }

    public function store(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'name' => 'required|min:2|max:255',
            'icon_colored'  => [
                'required',
                'string',
                'regex:/<svg\b[^>]*>(.*?)<\/svg>/is',
            ],
            'icon_base'  => [
                'required',
                'string',
                'regex:/<svg\b[^>]*>(.*?)<\/svg>/is',
            ],
            'url' => 'required|url',
        ]);

        $resp = $this->socialMediaRepository->store($request->all());
        return redirect()->route('admin.website.social.media.index')->with($resp['status'], $resp['message']);
    }

    public function edit(Int $id): View|RedirectResponse
    {
        $resp = $this->socialMediaRepository->getById($id);
        // dd($resp);
        if ($resp['code'] == 200) {
            return view('admin.social-media.edit', [
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
            'id' => 'required|integer|min:1',
            'name' => 'required|min:2|max:255',
            'icon_colored'  => [
                'required',
                'string',
                'regex:/<svg\b[^>]*>(.*?)<\/svg>/is',
            ],
            'icon_base'  => [
                'required',
                'string',
                'regex:/<svg\b[^>]*>(.*?)<\/svg>/is',
            ],
            'url' => 'required|url',
        ]);

        $resp = $this->socialMediaRepository->update($request->all());
        // dd($resp);
        return redirect()->route('admin.website.social.media.index')->with($resp['status'], $resp['message']);
    }

    public function delete(Int $id)
    {
        $resp = $this->socialMediaRepository->delete($id);
        return redirect()->back()->with($resp['status'], $resp['message']);
    }

    public function bulk(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'ids' => 'required|array',
            'action' => 'required|in:delete,archive',
        ]);

        $resp = $this->socialMediaRepository->bulkAction($request->except('_token'));
        return redirect()->back()->with($resp['status'], $resp['message']);
    }

    public function import(Request $request)
    {
        $request->validateWithBag('importForm', [
            'file' => 'required|file|max:5000|mimes:csv,xlsx,xls',
        ]);

        $resp = $this->socialMediaRepository->import($request->file('file'));
        return redirect()->back()->with($resp['status'], $resp['message']);
    }

    public function export(Request $request, String $type)
    {
        $request->validate([
            'keyword' => 'nullable|string|max:255',
            'perPage' => 'nullable|string',
            'sortBy' => 'nullable|string|in:id,name,slug',
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

        $resp = $this->socialMediaRepository->export($keyword, $filters, $perPage, $sortBy, $sortOrder, $type);
        if ($resp instanceof \Symfony\Component\HttpFoundation\BinaryFileResponse) {
            return $resp;
        }

        return redirect()->back()->with('error', $resp['message']);
    }

    public function position(Request $request)
    {
        $resp = $this->socialMediaRepository->position($request->ids);
        return $resp;
        // return redirect()->back()->with($resp['status'], $resp['message']);
    }
}
