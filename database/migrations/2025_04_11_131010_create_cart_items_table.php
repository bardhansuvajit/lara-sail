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
		Schema::create('cart_items', function (Blueprint $table) {
			$table->id();

			// Relationships
			$table->unsignedBigInteger('cart_id');
			$table->foreign('cart_id')->references('id')->on('carts')->onDelete('cascade');

			$table->unsignedBigInteger('product_id');
			$table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');

			$table->unsignedBigInteger('product_variation_id')->nullable();
			$table->foreign('product_variation_id')->references('id')->on('product_variations')->onDelete('set null');

			// Item details
			$table->string('product_title');
			$table->string('variation_attributes')->nullable(); // e.g. "Color: Red, Size: Large"
			$table->string('sku');
			$table->decimal('selling_price', 12, 2);
			$table->decimal('mrp', 12, 2)->default(0.00);
			$table->unsignedInteger('quantity');
			$table->decimal('total', 12, 4);

			// Inventory tracking
			$table->boolean('is_available')->default(1);
			$table->text('availability_message')->nullable(); // e.g. In stock (10+ available)/ Only 2 left!/ Releases on 2024-09-01/ Available for in-store pickup only

			// Custom options
			$table->json('options')->nullable(); // e.g. Product-Variant Specific
			$table->json('custom_fields')->nullable(); // e.g. Business-Specific Data

			// status/ timestamp
			$table->tinyInteger('status')->default(1);
			$table->softDeletes();
			$table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));

			// Indexes
			$table->index(['cart_id', 'product_id']);
		});

		/*
		$optionsSample = json_encode({
			"size": "XL",
			"color": {
			  "name": "Midnight Blue",
			  "hex": "#191970"
			},
			"engraving": {
			  "text": "Happy Birthday!",
			  "font": "Arial"
			},
			"warranty": "3-year extended",
			"gift_wrapping": {
			  "style": "Premium",
			  "message": "To Mom, With Love"
			}
		});

		$custom_fieldsSample = json_encode({
			"inventory": {
			  "source_warehouse": "WEST-12",
			  "allocated_stock_id": "STK-8842"
			},
			"pricing": {
			  "original_msrp": 199.99,
			  "cost_price": 89.50
			},
			"logistics": {
			  "special_handling": true,
			  "requires_adult_signature": false
			},
			"subscription": {
			  "billing_cycle": "monthly",
			  "next_charge_date": "2024-07-15"
			}
		});
		*/
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('cart_items');
	}
};
