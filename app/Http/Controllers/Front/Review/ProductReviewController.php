<?php

namespace App\Http\Controllers\Front\Review;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;
use App\Interfaces\ProductListingInterface;
use App\Interfaces\ProductVariationInterface;
use App\Interfaces\ProductReviewInterface;

class ProductReviewController extends Controller
{
    private ProductListingInterface $productListingRepository;
    private ProductVariationInterface $productVariationRepository;
    private ProductReviewInterface $productReviewRepository;

    public function __construct(
        ProductListingInterface $productListingRepository, 
        ProductVariationInterface $productVariationRepository,
        ProductReviewInterface $productReviewRepository
    )
    {
        $this->productListingRepository = $productListingRepository;
        $this->productVariationRepository = $productVariationRepository;
        $this->productReviewRepository = $productReviewRepository;
    }

    public function listByProduct($slug): RedirectResponse|View
    {
        $resp = $this->productListingRepository->getBySlugFDCustomArr($slug);

        if ($resp['code'] == 200) {
            $product = $resp['data'];
            $reviews = $this->productReviewRepository->allActivePaginatedReviewsByProductId($product->id);

            return view('front.review.index', [
                'product' => $product,
                'activeImagesCount' => count($product->activeImages),
                'images' => $product->activeImages,
                'reviews' => ($reviews['code'] == 200) ? $reviews['data'] : [],
                'allReviews' => $product->activeReviews,
            ]);
        } else {
            return redirect()->route('front.error.404');
        }
    }

    public function create($slug): RedirectResponse|View
    {
        $resp = $this->productListingRepository->getBySlugFDCustomArr($slug);

        if ($resp['code'] == 200) {
            $product = $resp['data'];

            return view('front.review.create', [
                'product' => $product,
                'activeImagesCount' => count($product->activeImages),
                'images' => $product->activeImages,
            ]);
        } else {
            return redirect()->route('front.error.404');
        }
    }
    
    public function store(Request $request)
    {
        // dd($request->all());

        // Get uploaded files
        $uploadedFiles = $request->file('images');
        $fileNames = [];
        if ($uploadedFiles) {
            foreach ($uploadedFiles as $index => $file) {
                $fileNames["images.$index"] = $file->getClientOriginalName();
            }
        }

        $validator = Validator::make($request->all(), [
            'product_id' => 'required|integer|exists:products,id',
            'user_id' => 'required|integer|exists:users,id',
            'rating' => 'required|integer|in:1,2,3,4,5',
            'title' => 'nullable|string|min:2|max:1000',
            'review' => 'required|string|min:2',

            'images' => 'nullable|array',
            'images.*' => 'image|max:'.developerSettings('image_validation')->max_image_size.'|mimes:'.implode(',', developerSettings('image_validation')->image_upload_mimes_array).'|extensions:'.implode(',', developerSettings('image_validation')->image_upload_mimes_array)
        ], [
            'images.*.max' => '":filename" must not be greater than '.developerSettings('image_validation')->max_image_size_in_mb.'.',
            'images.*.mimes' => '":filename" must be a file of type: '.implode(',', developerSettings('image_validation')->image_upload_mimes_array),
            'images.*.extensions' => '":filename" is not supported. Please upload an image of these formats: '.implode(',', developerSettings('image_validation')->image_upload_mimes_array),
        ]);

        $validator->after(function ($validator) use ($fileNames) {
            $messages = $validator->errors(); // Get validation errors

            foreach ($fileNames as $key => $fileName) {
                if ($messages->has($key)) {
                    $updatedErrors = [];

                    foreach ($messages->get($key) as $error) {
                        $updatedErrors[] = str_replace(':filename', $fileName, $error);
                    }

                    // Overwrite the errors for this key
                    $messages->forget($key);
                    $messages->add($key, $updatedErrors);
                }
            }
        });

        $validator->validate();

        $resp = $this->productReviewRepository->store($request->all());

        if ($resp['code'] == 200) {
            return redirect()->back()->with($resp['status'], 'Thank you for your review !');
        } else {
            return redirect()->back()->with($resp['status'], $resp['message']);
        }

    }
}
