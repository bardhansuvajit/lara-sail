<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cart_settings', function (Blueprint $table) {
            $table->id();

            $table->string('country', 2)->unique();
            $table->foreign('country')->references('short_name')->on('countries')->onDelete('cascade');

            $table->decimal('min_order_value', 10, 2)->default(0);
            $table->decimal('shipping_charge', 10, 2)->default(0);
            $table->decimal('free_shipping_threshold', 10, 2)->nullable();

            // Tax settings
            $table->decimal('tax_rate', 5, 2)->default(0);
            $table->string('tax_name')->nullable();
            $table->string('tax_type')->default('percentage')->comment('fixed, percentage');
            $table->boolean('tax_exclusive')->default(false);

            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
        });

        $data1 = [
            'minimum_cart_value_to_place_order' => json_encode([
                [
                    'country' => 'IN',
                    'value' => '49',
                ],
                [
                    'country' => 'US',
                    'value' => '1.99',
                ],
            ]),
            'free_shipping_on_minimum_cart_value' => json_encode([
                [
                    'country' => 'IN',
                    'value' => '499',
                ],
                [
                    'country' => 'US',
                    'value' => '7.99',
                ],
            ]),
            'average_shipping_charge' => json_encode([
                [
                    'country' => 'IN',
                    'value' => '99',
                ],
                [
                    'country' => 'US',
                    'value' => '0.99',
                ],
            ]),
            'tax_rate' => json_encode([
                [
                    'country' => 'IN',
                    'value' => '18',
                    'type' => 'percentage',
                    'name' => 'GST',
                ],
                [
                    'country' => 'US',
                    'value' => '19',
                    'type' => 'fixed',
                    'name' => 'VAT',
                ],
            ])
        ];

        $data = [
            [
                'country' => 'IN',
                'min_order_value' => 49,
                'free_shipping_threshold' => 499,
                'shipping_charge' => 99,
                'tax_rate' => 18,
                'tax_name' => 'GST',
                'tax_type' => 'percentage'
            ],
            [
                'country' => 'US',
                'min_order_value' => 1.99,
                'free_shipping_threshold' => 7.99,
                'shipping_charge' => 0.99,
                'tax_rate' => 19,
                'tax_name' => 'VAT',
                'tax_type' => 'fixed'
            ]
        ];

        DB::table('cart_settings')->insert($data);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cart_settings');
    }
};
