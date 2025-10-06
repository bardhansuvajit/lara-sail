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
            $table->dateTime('starts_at');
            $table->dateTime('expires_at');

            $table->boolean('show_in_frontend')->default(true);

            $table->integer('position')->default(1);
            $table->tinyInteger('status')->default(1);
            $table->softDeletes();
            $table->timestamps();

            // Better indexes for performance
            $table->index(['country_code', 'status', 'show_in_frontend']);
            $table->index(['starts_at', 'expires_at']);
            $table->index(['code', 'status']);
        });

        $data = [
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
                'expires_at' => now()->addMonths(6)
            ],
            [
                'country_code' => 'US',
                'code' => 'welcome999',
                'name' => 'Welcome Discount',
                'description' => '9.99$ off only for new customers',
                'discount_type' => 'fixed',
                'value' => 9.99,
                'max_discount_amount' => 9.99,
                'min_cart_value' => 120.00,
                'usage_limit' => 99,
                'usage_per_user' => 1,
                'starts_at' => now(),
                'expires_at' => now()->addMonths(6)
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
