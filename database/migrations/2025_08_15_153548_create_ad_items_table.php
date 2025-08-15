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
        Schema::create('ad_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ad_section_id')->constrained('ad_sections')->cascadeOnDelete();
            $table->string('country_code', 2);
            $table->foreign('country_code')
                ->references('code') // assuming your countries table has a 'code' column
                ->on('countries')
                ->cascadeOnDelete();

            $table->string('title')->nullable();
            $table->text('subtitle')->nullable();

            $table->text('image_s')->nullable();
            $table->text('image_m')->nullable();
            $table->text('image_l')->nullable();

            $table->string('cta_primary_text')->nullable();
            $table->string('cta_primary_url')->nullable();
            $table->string('cta_secondary_text')->nullable();
            $table->string('cta_secondary_url')->nullable();

            $table->json('meta')->nullable();

            // timing control
            $table->timestamp('start_at')->nullable();
            $table->timestamp('end_at')->nullable();
            $table->tinyInteger('show_offer_ends_timing')->default(0);

            $table->tinyInteger('status')->default(1)->comment('1: active, 0: inactive');
            $table->softDeletes();
            $table->timestamps();
        });

        $data = [
            [
                'ad_section_id' => 1,
                'country_code' => 'IN',
                'title' => 'Huge Savings. Everyday essentials. Top brands.',
                'subtitle' => 'Curated deals, fast delivery and reliable customer service — everything you expect from a marketplace leader.',

                'image_s' => 'default/ad/big-deal.png',
                'image_m' => 'default/ad/big-deal.png',
                'image_l' => 'default/ad/big-deal.png',

                'cta_primary_text' => 'Shop Bestsellers',
                'cta_primary_url' => '/category',
                'cta_secondary_text' => 'See Deals',
                'cta_secondary_url' => '/collection',

                'meta' => json_encode([
                    'highlights' => [
                        'offer1' => [
                            'svg' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M300-520q-58 0-99-41t-41-99q0-58 41-99t99-41q58 0 99 41t41 99q0 58-41 99t-99 41Zm0-80q25 0 42.5-17.5T360-660q0-25-17.5-42.5T300-720q-25 0-42.5 17.5T240-660q0 25 17.5 42.5T300-600Zm360 440q-58 0-99-41t-41-99q0-58 41-99t99-41q58 0 99 41t41 99q0 58-41 99t-99 41Zm0-80q25 0 42.5-17.5T720-300q0-25-17.5-42.5T660-360q-25 0-42.5 17.5T600-300q0 25 17.5 42.5T660-240Zm-444 80-56-56 584-584 56 56-584 584Z"/></svg>',
                            'title' => 'Up to 70% off',
                            'description' => 'On select electronics',
                        ],
                        'offer2' => [
                            'svg' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="m691-150 139-138-42-42-97 95-39-39-42 43 81 81ZM240-600h480v-80H240v80ZM720-40q-83 0-141.5-58.5T520-240q0-83 58.5-141.5T720-440q83 0 141.5 58.5T920-240q0 83-58.5 141.5T720-40ZM120-80v-680q0-33 23.5-56.5T200-840h560q33 0 56.5 23.5T840-760v267q-19-9-39-15t-41-9v-243H200v562h243q5 31 15.5 59T486-86l-6 6-60-60-60 60-60-60-60 60-60-60-60 60Zm120-200h203q3-21 9-41t15-39H240v80Zm0-160h284q38-37 88.5-58.5T720-520H240v80Zm-40 242v-562 562Z"/></svg>',
                            'title' => 'Buy 1 Get 1',
                            'description' => 'On fashion picks',
                        ],
                        'offer3' => [
                            'svg' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M200-160v-80h64l79-263q8-26 29.5-41.5T420-560h120q26 0 47.5 15.5T617-503l79 263h64v80H200Zm148-80h264l-72-240H420l-72 240Zm92-400v-200h80v200h-80Zm238 99-57-57 142-141 56 56-141 142Zm42 181v-80h200v80H720ZM282-541 141-683l56-56 142 141-57 57ZM40-360v-80h200v80H40Zm440 120Z"/></svg>',
                            'title' => 'New arrivals',
                            'description' => 'Daily drops',
                        ],
                        'offer4' => [
                            'svg' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M280-160q-50 0-85-35t-35-85H60l18-80h113q17-19 40-29.5t49-10.5q26 0 49 10.5t40 29.5h167l84-360H262l17-80h441l-37 160h117l120 160-40 200h-80q0 50-35 85t-85 35q-50 0-85-35t-35-85H400q0 50-35 85t-85 35Zm357-280h193l4-21-74-99h-95l-28 120Zm-17-280-84 360 2-7 82-353ZM140-440v-120H40l140-200v120h100L140-440Zm140 200q17 0 28.5-11.5T320-280q0-17-11.5-28.5T280-320q-17 0-28.5 11.5T240-280q0 17 11.5 28.5T280-240Zm400 0q17 0 28.5-11.5T720-280q0-17-11.5-28.5T680-320q-17 0-28.5 11.5T640-280q0 17 11.5 28.5T680-240Z"/></svg>',
                            'title' => 'Free Shipping',
                            'description' => 'Over ₹999',
                        ],
                    ]
                ])
            ],
        ];

        DB::table('ad_items')->insert($data);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ad_items');
    }
};
