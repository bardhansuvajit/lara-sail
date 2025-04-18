<?php

namespace App\Exports;

use App\Models\ProductVariationAttributeValue;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProductVariationAttributeValuesExport implements FromCollection, WithHeadings
{
    private $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function collection()
    {
        return $this->data;
    }

    public function headings(): array
    {
        return array_keys($this->collection()->first()->toArray());
    }
}
