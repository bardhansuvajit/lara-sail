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
            $table->string('product_name');
            $table->string('product_sku')->nullable();
            $table->text('product_description')->nullable();
            $table->string('product_image')->nullable();

            // Pricing
            $table->decimal('mrp', 12, 2);
            $table->decimal('price', 12, 2);
            $table->decimal('discount_amount', 12, 2)->default(0);
            $table->string('discount_type', 30)->nullable();

            // Quantity
            $table->unsignedInteger('quantity');
            $table->decimal('total', 12, 2);

            // Tax
            $table->decimal('tax_amount', 12, 2)->default(0);
            $table->string('tax_type', 30)->nullable();
            $table->text('tax_details')->nullable();

            // Status
            $table->string('status')->default('pending');
            $table->text('status_notes')->nullable();

            // Metadata
            $table->text('custom_fields')->nullable();

            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));

            // Indexes
            $table->index('order_id');
            $table->index('product_id');
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
