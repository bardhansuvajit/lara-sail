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
        Schema::create('product_highlight_lists', function (Blueprint $table) {
            $table->id();

			$table->unsignedBigInteger('product_id');
			$table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');

			$table->unsignedBigInteger('product_variation_id')->nullable();
			$table->foreign('product_variation_id')->references('id')->on('product_variations')->onDelete('set null');

			// Highlight details
			$table->text('icon');
			$table->text('title');
			$table->text('description')->nullable();

            $table->integer('position')->default(1);

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
        Schema::dropIfExists('product_highlight_lists');
    }
};
