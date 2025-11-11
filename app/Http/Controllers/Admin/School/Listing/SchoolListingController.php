<?php

namespace App\Http\Controllers\Admin\School\Listing;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Interfaces\SchoolInterface;
use App\Interfaces\SchoolBoardInterface;
use Illuminate\Database\Eloquent\Collection;

class SchoolListingController
{
    private SchoolInterface $schoolRepository;
    private SchoolBoardInterface $schoolBoardRepository;
    public array $schoolType;
    public array $educationLevel;
    public Collection $activeBoards;

    public function __construct(SchoolInterface $schoolRepository, SchoolBoardInterface $schoolBoardRepository)
    {
        $this->schoolRepository = $schoolRepository;
        $this->schoolBoardRepository = $schoolBoardRepository;

        $this->schoolType = [
            'government' => 'Government',
            'private' => 'Private',
            'aided' => 'Aided'
        ];

        $this->educationLevel = [
            'primary' => 'Primary',
            'secondary' => 'Secondary',
            'higher_secondary' => 'Higher Secondary'
        ];

        $activeBoardData = $this->schoolBoardRepository->list('', ['status' => 1], 'all', 'position', 'asc');
        $this->activeBoards = $activeBoardData['data'] ?? collect([]);
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
        $resp = $this->schoolRepository->list($keyword, $filters, $perPage, $sortBy, $sortOrder);

        return view('admin.school.listing.index', [
            'data' => $resp['data'],
        ]);
    }

    public function create(): View
    {
        return view('admin.school.listing.create', [
            'schoolType' => $this->schoolType,
            'educationLevel' => $this->educationLevel,
            'activeBoards' => $this->activeBoards,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'nullable|image|max:'.developerSettings('image_validation')->max_image_size.'|mimes:'.implode(',', developerSettings('image_validation')->image_upload_mimes_array).'|extensions:'.implode(',', developerSettings('image_validation')->image_upload_mimes_array),
            
            'name' => 'required|min:2|max:255',
            'slug' => 'required|min:2|max:255|unique:schools,slug',
            'code' => 'nullable|min:2|max:255',
            'description' => 'nullable|min:2|max:1000',
            
            // Location validation
            'country_code' => 'required|max:10',
            'state' => 'required|max:255',
            'district' => 'required|max:255',
            'city' => 'required|max:255',
            'address' => 'required|max:1000',
            'pincode' => 'nullable|max:20',
            
            // School details validation
            'type' => 'required|in:government,private,aided',
            'level' => 'required|in:primary,secondary,higher_secondary',
            'board_affiliation' => 'required|max:255',
            
            // Academic validation
            'established_year' => 'nullable|integer|min:1000|max:'.date('Y'),
            'principal_name' => 'nullable|max:255',
            'student_count' => 'nullable|integer|min:0',
            'teacher_count' => 'nullable|integer|min:0',
            
            // Contact validation
            'official_email' => 'nullable|email|max:255',
            'phone_number' => 'nullable|max:20',
            'alternate_phone' => 'nullable|max:20',
            'website' => 'nullable|url|max:255',
            'fax' => 'nullable|max:20',
            
            // Contact person validation
            'contact_person_name' => 'nullable|max:255',
            'contact_person_designation' => 'nullable|max:255',
            'contact_person_mobile' => 'nullable|max:20',
            'contact_person_email' => 'nullable|email|max:255',
            
            // SEO validation
            'meta_title' => 'nullable|max:255',
            'meta_description' => 'nullable|max:500',
            
            // Additional settings
            'tags' => 'nullable|max:500',
            'status' => 'required|in:0,1',
            
        ], [
            'image.max' => 'The image field must not be greater than '.developerSettings('image_validation')->max_image_size_in_mb.'.',
            'slug.unique' => 'The slug has already been taken. Please choose a different one.',
            'established_year.max' => 'Established year cannot be in the future.',
        ]);

        $resp = $this->schoolRepository->store($request->all());
        
        if ($resp['code'] == 200) {
            return redirect()->route('admin.school.listing.index')->with($resp['status'], $resp['message']);
        } else {
            return back()->withInput()->with($resp['status'], $resp['message']);
        }
    }

    /*
    public function store(Request $request)
    {
        dd($request->all());

        $request->validate([
            'image' => 'nullable|image|max:'.developerSettings('image_validation')->max_image_size.'|mimes:'.implode(',', developerSettings('image_validation')->image_upload_mimes_array).'|extensions:'.implode(',', developerSettings('image_validation')->image_upload_mimes_array),

            'name' => 'required|min:2|max:255',
            'code' => 'required|min:2|max:255',
            'description' => 'nullable|min:2',
        ], [
            'image.max' => 'The image field must not be greater than '.developerSettings('image_validation')->max_image_size_in_mb.'.',
        ]);

        $resp = $this->schoolRepository->store($request->all());
        return redirect()->route('admin.school.listing.index')->with($resp['status'], $resp['message']);
    }
    */

    public function edit(int $id): View|RedirectResponse
    {
        $resp = $this->schoolRepository->getById($id);
        // dd($resp);
        if ($resp['code'] == 200) {
            return view('admin.school.listing.edit', [
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

        $resp = $this->schoolRepository->update($request->all());
        // dd($resp);
        return redirect()->route('admin.school.listing.index')->with($resp['status'], $resp['message']);
    }

    public function delete(int $id)
    {
        $resp = $this->schoolRepository->delete($id);
        return redirect()->back()->with($resp['status'], $resp['message']);
    }

    public function bulk(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'ids' => 'required|array',
            'action' => 'required|in:delete,archive',
        ]);

        $resp = $this->schoolRepository->bulkAction($request->except('_token'));
        return redirect()->back()->with($resp['status'], $resp['message']);
    }

    public function import(Request $request)
    {
        $request->validateWithBag('importForm', [
            'file' => 'required|file|max:5000|mimes:csv,xlsx,xls',
        ]);

        $resp = $this->schoolRepository->import($request->file('file'));
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

        $resp = $this->schoolRepository->export($keyword, $filters, $perPage, $sortBy, $sortOrder, $type);
        if ($resp instanceof \Symfony\Component\HttpFoundation\BinaryFileResponse) {
            return $resp;
        }

        return redirect()->back()->with('error', $resp['message']);
    }

    public function position(Request $request)
    {
        $resp = $this->schoolRepository->position($request->ids);
        return $resp;
        // return redirect()->back()->with($resp['status'], $resp['message']);
    }
}
