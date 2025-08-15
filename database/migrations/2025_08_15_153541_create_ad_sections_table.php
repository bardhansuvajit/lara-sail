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
        Schema::create('ad_sections', function (Blueprint $table) {
            $table->id();
            $table->string('page');
            $table->unsignedSmallInteger('position')->default(1);

            $table->string('name');
            $table->string('slug')->nullable()->unique();
            $table->enum('type', ['hero', 'promo_strip', 'trust', 'product_promo', 'banner', 'sponsored', 'raw_html', 'custom'])->default('banner');

            $table->tinyInteger('status')->default(1)->comment('1: active, 0: inactive');
            $table->timestamps();
        });

        $data = [
            [
                'page' => 'homepage',
                'position' => 1,
                'name' => 'Hero: Big Deal',
                'slug' => 'hero-big-deal',
                'type' => 'hero',
                'status' => 0,
            ],
            [
                'page' => 'homepage',
                'position' => 2,
                'name' => 'Trusted marketplace',
                'slug' => 'trusted-marketplace',
                'type' => 'trust',
                'status' => 0,
            ],
            [
                'page' => 'homepage',
                'position' => 3,
                'name' => 'Product Promo',
                'slug' => 'product-promo',
                'type' => 'product_promo',
                'status' => 0,
            ],

            [
                'page' => 'category',
                'position' => 1,
                'name' => 'Big Deal',
                'slug' => 'big-deal',
                'type' => 'banner',
                'status' => 0,
            ],
            [
                'page' => 'category',
                'position' => 2,
                'name' => 'Offer Ad 1',
                'slug' => 'offer-ad-1',
                'type' => 'sponsored',
                'status' => 0,
            ],
            [
                'page' => 'category',
                'position' => 3,
                'name' => 'Offer Ad 2',
                'slug' => 'offer-ad-2',
                'type' => 'sponsored',
                'status' => 0,
            ]
        ];

        DB::table('ad_sections')->insert($data);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ad_sections');
    }
};
