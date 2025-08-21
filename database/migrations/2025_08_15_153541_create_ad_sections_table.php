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
            $table->string('pages');
            $table->unsignedSmallInteger('position')->default(1);

            $table->string('name');
            $table->string('slug')->nullable()->unique();
            $table->enum('type', ['hero', 'promo_strip', 'trust', 'product_promo', 'banner', 'sponsored', 'raw_html', 'custom'])->default('banner');

            $table->tinyInteger('status')->default(1)->comment('1: active, 0: inactive');
            $table->timestamps();
        });

        $data = [
            [
                'pages' => 'homepage',
                'position' => 1,
                'name' => 'Hero: Big Deal',
                'slug' => 'hero-big-deal',
                'type' => 'hero',
                'status' => 1,
            ],
            [
                'pages' => 'homepage, category',
                'position' => 2,
                'name' => 'Sign In',
                'slug' => 'sign-in',
                'type' => 'promo_strip',
                'status' => 1,
            ],
            [
                'pages' => 'homepage, category',
                'position' => 3,
                'name' => 'Trusted marketplace',
                'slug' => 'trusted-marketplace',
                'type' => 'trust',
                'status' => 1,
            ],
            [
                'pages' => 'homepage',
                'position' => 4,
                'name' => 'Product Promo',
                'slug' => 'product-promo',
                'type' => 'product_promo',
                'status' => 1,
            ],

            [
                'pages' => 'category',
                'position' => 5,
                'name' => 'Big Deal',
                'slug' => 'big-deal',
                'type' => 'banner',
                'status' => 1,
            ],
            [
                'pages' => 'category',
                'position' => 6,
                'name' => 'Offer Ad 1',
                'slug' => 'offer-ad-1',
                'type' => 'sponsored',
                'status' => 1,
            ],
            [
                'pages' => 'category',
                'position' => 7,
                'name' => 'Offer Ad 2',
                'slug' => 'offer-ad-2',
                'type' => 'sponsored',
                'status' => 1,
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
