<?php

namespace App\Http\Controllers\Admin\NewsletterEmail;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Interfaces\NewsletterSubscriptionEmailInterface;

class NewsletterEmailController
{
    private NewsletterSubscriptionEmailInterface $newsletterSubscriptionEmailRepository;

    public function __construct(NewsletterSubscriptionEmailInterface $newsletterSubscriptionEmailRepository)
    {
        $this->newsletterSubscriptionEmailRepository = $newsletterSubscriptionEmailRepository;
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
            'status' => $request->input('status', ''),
        ];
        $resp = $this->newsletterSubscriptionEmailRepository->list($keyword, $filters, $perPage, $sortBy, $sortOrder);

        return view('admin.newsletter.email.index', [
            'data' => $resp['data'],
        ]);
    }

    public function create(): View
    {
        return view('admin.newsletter.email.create');
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

        $resp = $this->newsletterSubscriptionEmailRepository->store($request->all());
        return redirect()->route('admin.website.newsletter.email.index')->with($resp['status'], $resp['message']);
    }

    public function edit(Int $id): View
    {
        $resp = $this->newsletterSubscriptionEmailRepository->getById($id);
        return view('admin.newsletter.email.edit', [
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

        $resp = $this->newsletterSubscriptionEmailRepository->update($request->all());
        return redirect()->route('admin.website.newsletter.email.index')->with($resp['status'], $resp['message']);
    }

    public function delete(Int $id)
    {
        $resp = $this->newsletterSubscriptionEmailRepository->delete($id);
        return redirect()->back()->with($resp['status'], $resp['message']);
    }

    public function bulk(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'ids' => 'required|array',
            'action' => 'required|in:delete,archive',
        ]);

        $resp = $this->newsletterSubscriptionEmailRepository->bulkAction($request->except('_token'));
        return redirect()->back()->with($resp['status'], $resp['message']);
    }

    public function import(Request $request)
    {
        $request->validateWithBag('importForm', [
            'file' => 'required|file|max:5000|mimes:csv,xlsx,xls',
        ]);

        $resp = $this->newsletterSubscriptionEmailRepository->import($request->file('file'));
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

        $resp = $this->newsletterSubscriptionEmailRepository->export($keyword, $filters, $perPage, $sortBy, $sortOrder, $type);
        if ($resp instanceof \Symfony\Component\HttpFoundation\BinaryFileResponse) {
            return $resp;
        }

        return redirect()->back()->with('error', $resp['message']);
    }
}
