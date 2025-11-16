<?php

namespace App\Http\Controllers\Admin\Product\File;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Interfaces\ProductFileInterface;

class ProductFileController
{
    private ProductFileInterface $productFileRepository;

    public function __construct(ProductFileInterface $productFileRepository)
    {
        $this->productFileRepository = $productFileRepository;
    }

    public function delete(int $id)
    {
        $resp = $this->productFileRepository->delete($id);
        return redirect()->back()->with($resp['status'], $resp['message']);
    }
}
