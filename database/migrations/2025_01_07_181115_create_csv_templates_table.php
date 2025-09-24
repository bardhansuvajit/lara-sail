<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('csv_templates', function (Blueprint $table) {
            $table->id();

            $table->string('model');
            $table->string('file_path');
            $table->text('description')->nullable();

            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
        });

        $data = [
            [
                'model' => 'Country',
                'file_path' => 'countries.csv',
                'description' => 'Countries',
            ],
            [
                'model' => 'ProductCategory',
                'file_path' => 'product_categories.csv',
                'description' => 'Product Categories',
            ],
            [
                'model' => 'ProductCollection',
                'file_path' => 'product_collections.csv',
                'description' => 'Product Collections',
            ],
            [
                'model' => 'Product',
                'file_path' => 'products.csv',
                'description' => 'Products',
            ],
            [
                'model' => 'ProductVariationAttribute',
                'file_path' => 'product_variation_attributes.csv',
                'description' => 'Product Variation Attributes',
            ],
            [
                'model' => 'ProductVariationAttributeValue',
                'file_path' => 'product_variation_attribute_values.csv',
                'description' => 'Product Variation Attribute Values',
            ],
            [
                'model' => 'State',
                'file_path' => 'states.csv',
                'description' => 'States',
            ],
            [
                'model' => 'City',
                'file_path' => 'cities.csv',
                'description' => 'Cities',
            ],
            [
                'model' => 'ProductReview',
                'file_path' => 'product_reviews.csv',
                'description' => 'Product Reviews',
            ]
        ];

        DB::table('csv_templates')->insert($data);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('csv_templates');
    }
};
