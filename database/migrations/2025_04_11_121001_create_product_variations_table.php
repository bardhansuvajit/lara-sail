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
        Schema::create('product_variations', function (Blueprint $table) {
            $table->id();

            // Product relationship
            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');

            // Variation identifiers
            $table->string('sku')->unique()->nullable();
            $table->string('barcode')->unique()->nullable();

            // Inventory management
            $table->unsignedInteger('stock_quantity')->default(0);
            $table->boolean('track_quantity')->default(1);
            $table->boolean('allow_backorders')->default(0);        // alow keep selling even when out of stock
            $table->unsignedInteger('sold_count')->default(0);
            $table->unsignedInteger('in_cart_count')->default(0);

            // Pricing
            $table->decimal('price_adjustment', 12, 2)->default(0.00)->comment('Fixed amount or percentage');
            $table->enum('adjustment_type', ['fixed', 'percentage'])->default('fixed')->comment('Apply to base price from product_pricing');

            // Shipping
            $table->decimal('weight_adjustment', 8, 2)->default(0.00);
            $table->decimal('height_adjustment', 8, 2)->default(0.00);
            $table->decimal('width_adjustment', 8, 2)->default(0.00);
            $table->decimal('length_adjustment', 8, 2)->default(0.00);
            $table->enum('weight_unit', ['g', 'kg', 'lb', 'oz'])->default('g');
            $table->enum('dimension_unit', ['mm', 'cm', 'm', 'in', 'ft'])->default('cm');

            // Default
            $table->boolean('is_default')->default(0);

            // Status/ Timestamp
            $table->tinyInteger('status')->default(1);
            $table->softDeletes();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_variations');
    }
};
