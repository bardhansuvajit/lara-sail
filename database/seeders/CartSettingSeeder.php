<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CartSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('cart_settings')->insert([
            [
                'country' => 'IN',
                'min_order_value' => 49,
                'shipping_charge' => 99,
                'free_shipping_threshold' => 499,
                'tax_rate' => 18,
                'tax_name' => 'GST',
                'tax_type' => 'percentage'
            ],
            [
                'country' => 'US',
                'min_order_value' => 1.99,
                'shipping_charge' => 0.99,
                'free_shipping_threshold' => 7.99,
                'tax_rate' => 19,
                'tax_name' => 'VAT',
                'tax_type' => 'fixed'
            ]
        ]);

    }
}
