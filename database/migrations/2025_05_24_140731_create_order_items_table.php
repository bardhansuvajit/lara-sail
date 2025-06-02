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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();

            // Order relationship
            $table->unsignedBigInteger('order_id');
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');

            // Product information
			$table->unsignedBigInteger('product_id');
			$table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->unsignedBigInteger('product_variation_id')->nullable();
			$table->foreign('product_variation_id')->references('id')->on('product_variations')->onDelete('set null');
            $table->string('product_title');
			$table->string('variation_attributes')->nullable(); // e.g. "Color: Red, Size: Large"
            $table->string('product_sku');
			$table->text('product_url')->nullable();
			$table->text('product_url_with_variation')->nullable();

			$table->text('image_s')->nullable();
            $table->text('image_m')->nullable();
            $table->text('image_l')->nullable();

            // Pricing & Quantity
            $table->decimal('selling_price', 12, 2);
			$table->decimal('mrp', 12, 2)->default(0.00);
			$table->unsignedInteger('quantity');
			$table->decimal('total', 12, 2);

            // Tax
            $table->decimal('tax_amount', 12, 2)->default(0);
            $table->string('tax_type', 30)->nullable();
            $table->text('tax_details')->nullable();

            // Inventory tracking
			$table->text('cart_availability_message')->nullable(); // e.g. In stock (10+ available)/ Only 2 left!/ Releases on 2024-09-01/ Available for in-store pickup only

            // Status
            $table->string('status')->default('pending');
            $table->text('status_notes')->nullable();

            // Metadata
            $table->text('custom_fields')->nullable();

            $table->softDeletes();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));

            // Indexes
            $table->index(['order_id', 'product_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
