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
        Schema::create('product_review_images', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('review_id')->nullable();
            $table->foreign('review_id')->references('id')->on('product_reviews')->onDelete('cascade');

            $table->string('image_s')->nullable();
            $table->string('image_m')->nullable();
            $table->string('image_l')->nullable();

            $table->string('alt_text')->nullable();

            $table->integer('position')->default(1);
            $table->tinyInteger('status')->comment('1: active, 0: inactive')->default(1);
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
        Schema::dropIfExists('product_review_images');
    }
};
