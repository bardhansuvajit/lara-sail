<?php

namespace App\Http\Controllers\Front\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Interfaces\ProductFeatureInterface;

class IndexController extends Controller
{
    private ProductFeatureInterface $productFeatureRepository;

    public function __construct(ProductFeatureInterface $productFeatureRepository)
    {
        $this->productFeatureRepository = $productFeatureRepository;
    }

    public function index(): View
    {
        $featuredProducts = $this->productFeatureRepository->list('', [], 'all', 'position', 'asc');

        return view('front.home.index', [
            'featuredProducts' => $featuredProducts['data'],
        ]);
    }
}
