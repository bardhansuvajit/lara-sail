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
        Schema::table('product_variations', function (Blueprint $table) {
            // Media/ Image
            // $table->unsignedBigInteger('image_id')->nullable();
            $table->unsignedBigInteger('primary_image_id')->nullable()->comment('Main display image');
            $table->foreign('primary_image_id')->references('id')->on('product_images')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product_variations', function (Blueprint $table) {
            $table->dropColumn('primary_image_id');
        });
    }
};
