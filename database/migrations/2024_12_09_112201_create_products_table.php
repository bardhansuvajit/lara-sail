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

            $table->text('title');
            $table->text('slug');

            $table->bigInteger('category_id');
            $table->json('collection_ids');

            $table->text('short_description')->nullable();
            $table->longText('long_description')->nullable();
            $table->text('tags')->nullable();

            $table->text('sku')->nullable();
            $table->bigInteger('quantity')->nullable();

            $table->text('meta_title')->nullable();
            $table->text('meta_desc')->nullable();

            // $table->bigInteger('listing_by')->nullable();
            $table->string('type', 100);
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
        Schema::dropIfExists('products');
    }
};
