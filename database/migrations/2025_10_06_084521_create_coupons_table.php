<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('country_code', 2)->default('IN');

            // Basic info
            $table->string('code')->unique();
            $table->string('name');
            $table->text('description')->nullable();

            // Discount
            $table->enum('discount_type', ['percentage', 'fixed', 'free_shipping'])->default('percentage');
            $table->decimal('value', 10, 2)->nullable();
            $table->decimal('max_discount_amount', 10, 2)->nullable();

            // Cart data
            $table->decimal('min_cart_value', 10, 2)->nullable();
            $table->integer('usage_limit')->nullable();
            $table->integer('usage_per_user')->nullable();
            $table->integer('used_count')->default(0);
            $table->date('starts_at');
            $table->date('expires_at');

            $table->boolean('show_in_frontend')->default(true);

            $table->integer('position')->default(1);
            $table->tinyInteger('status')->default(1);
            $table->softDeletes();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));

            // Better indexes for performance
            $table->index(['country_code', 'status', 'show_in_frontend']);
            $table->index(['starts_at', 'expires_at']);
            $table->index(['code', 'status']);
        });

        $data = [
            // IN Coupons
            [
                'country_code' => 'IN',
                'code' => 'welcome20',
                'name' => 'Welcome Discount',
                'description' => '20% off for new customers',
                'discount_type' => 'percentage',
                'value' => 20.00,
                'max_discount_amount' => 2000.00,
                'min_cart_value' => 10000.00,
                'usage_limit' => 99,
                'usage_per_user' => 1,
                'starts_at' => now(),
                'expires_at' => now()->addMonths(6),
            ],
            [
                'country_code' => 'IN',
                'code' => 'freeshipin',
                'name' => 'Free Shipping Offer',
                'description' => 'Get free shipping on all orders above ₹499',
                'discount_type' => 'free_shipping',
                'value' => null,
                'max_discount_amount' => null,
                'min_cart_value' => 499.00,
                'usage_limit' => 200,
                'usage_per_user' => 2,
                'starts_at' => now(),
                'expires_at' => now()->addMonths(12),
            ],
            [
                'country_code' => 'IN',
                'code' => 'festive50',
                'name' => 'Festive Season Offer',
                'description' => 'Flat ₹500 off on orders above ₹2500',
                'discount_type' => 'fixed',
                'value' => 500.00,
                'max_discount_amount' => 500.00,
                'min_cart_value' => 2500.00,
                'usage_limit' => 500,
                'usage_per_user' => 1,
                'starts_at' => now(),
                'expires_at' => now()->addMonths(6),
            ],

            // US Coupons
            [
                'country_code' => 'US',
                'code' => 'welcome999',
                'name' => 'Welcome Discount',
                'description' => '$9.99 off only for new customers',
                'discount_type' => 'fixed',
                'value' => 9.99,
                'max_discount_amount' => 9.99,
                'min_cart_value' => 120.00,
                'usage_limit' => 99,
                'usage_per_user' => 1,
                'starts_at' => now(),
                'expires_at' => now()->addMonths(6),
            ],
            [
                'country_code' => 'US',
                'code' => 'freeshipus',
                'name' => 'Free Shipping Deal',
                'description' => 'Free shipping for orders above $50',
                'discount_type' => 'free_shipping',
                'value' => null,
                'max_discount_amount' => null,
                'min_cart_value' => 50.00,
                'usage_limit' => 300,
                'usage_per_user' => 3,
                'starts_at' => now(),
                'expires_at' => now()->addMonths(6),
            ],
            [
                'country_code' => 'US',
                'code' => 'spring15',
                'name' => 'Spring Sale',
                'description' => '15% off on all products during Spring Sale',
                'discount_type' => 'percentage',
                'value' => 15.00,
                'max_discount_amount' => 50.00,
                'min_cart_value' => 80.00,
                'usage_limit' => 200,
                'usage_per_user' => 2,
                'starts_at' => now(),
                'expires_at' => now()->addMonths(6),
            ],
        ];

        DB::table('coupons')->insert($data);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coupons');
    }
};
