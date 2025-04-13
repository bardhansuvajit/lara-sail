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
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            // Title
            $table->text('title');
            $table->text('slug');

            // Category/ Collection
            $table->bigInteger('category_id');
            $table->json('collection_ids');

            // Description
            $table->text('short_description')->nullable();
            $table->longText('long_description')->nullable();

            // Rating/ Review
            $table->decimal('average_rating', 2, 1)->default(0.0);
            $table->bigInteger('review_count')->default(0);

            // Identifiers
            $table->string('sku')->unique()->nullable();
            $table->string('barcode')->unique()->nullable();
            $table->boolean('has_variations')->default(false);

            // $table->text('sku')->nullable();
            // $table->bigInteger('quantity')->nullable();
            // $table->tinyInteger('sell_after_stock_expire')->default(0);

            // Inventory management
            $table->unsignedInteger('stock_quantity')->default(0);
            $table->boolean('track_quantity')->default(true);
            $table->boolean('allow_backorders')->default(false);        // alow keep selling even when out of stock
            $table->unsignedInteger('sold_count')->default(0);
            $table->unsignedInteger('in_cart_count')->default(0);

            // Shipping
            $table->decimal('weight', 10, 4)->default(0.00);
            $table->decimal('height', 10, 4)->default(0.00);
            $table->decimal('width', 10, 4)->default(0.00);
            $table->decimal('length', 10, 4)->default(0.00);
            $table->enum('weight_unit', ['g', 'kg', 'lb', 'oz'])->default('g');
            $table->enum('dimension_unit', ['mm', 'cm', 'm', 'in', 'ft'])->default('cm');

            // SEO
            $table->text('tags')->nullable();
            $table->text('meta_title')->nullable();
            $table->text('meta_desc')->nullable();

            // Type
            $table->string('type', 100);

            // Status/ Timestamp
            // $table->bigInteger('listing_by')->nullable();
            $table->tinyInteger('status')->default(0);
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
        Schema::dropIfExists('products');
    }
};
