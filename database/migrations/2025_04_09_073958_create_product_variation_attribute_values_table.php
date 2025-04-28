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
        Schema::create('product_variation_attribute_values', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('attribute_id');
            $table->foreign('attribute_id')->references('id')->on('product_variation_attributes')->onDelete('cascade');

            $table->string('title'); // "Red", "8GB"
            $table->string('slug')->unique(); // "red", "8gb"
            $table->json('meta')->nullable(); // { hex: "#FF0000", image: "red.jpg" }

            // Type
            // `size`/ other attributes have different values based on Category. 
            // e.g. Type 1 has values for T-shirt | Type 2 has values for Mens Shoes | Type 3 has values for Kids Shoes
            $table->tinyInteger('type')->default(1);

            // Description/ Tags
            $table->text('short_description')->nullable();
            $table->longText('long_description')->nullable();
            $table->text('tags')->nullable();

            $table->integer('position')->default(1);

            // Status/ Timestamp
            $table->tinyInteger('status')->default(1);
            $table->softDeletes();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));

            $table->index('title');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_variation_attribute_values');
    }
};
