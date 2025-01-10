<?php

namespace App\Exports;

use App\Models\ProductCategory;
use Maatwebsite\Excel\Concerns\FromCollection;

class ProductCategoriesExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return ProductCategory::all();
    }
}
