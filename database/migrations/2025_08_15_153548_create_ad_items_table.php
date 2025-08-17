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
            [
                'ad_section_id' => 2,
                'country_code' => 'IN',
                'title' => 'Trusted marketplace',
                'subtitle' => 'Secure payments, verified sellers and fast support.',

                'image_s' => 'default/ad/safe.png',
                'image_m' => 'default/ad/safe.png',
                'image_l' => 'default/ad/safe.png',

                'cta_primary_text' => 'See our Collections',
                'cta_primary_url' => '/collection',
                'cta_secondary_text' => 'See more',
                'cta_secondary_url' => '/about-us',

                'meta' => json_encode([])
            ],
            [
                'ad_section_id' => 3,
                'country_code' => 'IN',
                'title' => 'Save <span class="text-indigo-600 dark:text-indigo-400">₹500</span> today — pre-order the new iMac 27”',
                'subtitle' => 'Reserve your iMac now to lock in exclusive launch pricing, priority shipping and a complimentary 1-year warranty extension.',

                'image_s' => 'default/ad/imac.jpg',
                'image_m' => 'default/ad/imac.jpg',
                'image_l' => 'default/ad/imac.jpg',

                'cta_primary_text' => 'Pre-order Now',
                'cta_primary_url' => '/apple-macbook-air-m4',
                'cta_secondary_text' => 'Learn more',
                'cta_secondary_url' => '/collection',

                'meta' => json_encode([
                    'tags' => [
                        'tag1' => [
                            'svg' => '<svg viewBox="0 0 24 24" fill="currentColor" stroke="currentColor" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 2L3 14h7l-1 8 10-12h-7l1-8z"/></svg>',
                            'title' => 'Limited time offer',
                        ],
                        'tag2' => [
                            'svg' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M296.08-188.08q-45.89 0-77.16-32.11-31.27-32.12-30.27-77.89H95.08l12.49-55.96h99.9q13.58-22.84 37.07-36.42 23.49-13.58 51.56-13.58 28.26 0 51.79 13.58 23.53 13.58 37.27 36.42h172.87l84.43-361.92h-438l2.11-9.53q3.93-20.32 19.73-33.38 15.79-13.05 37.16-13.05h449.16l-33.58 143.84h101.69l113.11 150.7-35.69 179.3h-54.69q.81 45.77-30.64 77.89-31.45 32.11-77.34 32.11t-77.09-32.11q-31.2-32.12-30.39-77.89H404.04q.81 45.77-30.64 77.89-31.44 32.11-77.32 32.11Zm339.04-250.96H829l4.73-24.77-81.54-108.31h-86.11l-30.96 133.08Zm.69-249.34 6.65-27.58-84.3 361.92 6.65-27.58 32.04-138.88 38.96-167.88ZM52.35-437.58l14.06-55.96h189.24l-14.05 55.96H52.35Zm79.69-138.88 14.19-55.96h229.12l-14.2 55.96H132.04Zm163.97 332.42q21.8 0 36.93-15.09 15.14-15.09 15.14-36.88 0-21.8-15.12-36.93-15.12-15.14-36.76-15.14-21.89 0-37.03 15.12-15.13 15.12-15.13 36.76 0 21.89 15.09 37.03 15.09 15.13 36.88 15.13Zm399.43 0q21.79 0 36.93-15.09 15.13-15.09 15.13-36.88 0-21.8-15.12-36.93-15.11-15.14-36.76-15.14-21.89 0-37.02 15.12-15.14 15.12-15.14 36.76 0 21.89 15.09 37.03 15.09 15.13 36.89 15.13Z"/></svg>',
                            'title' => 'Free delivery on orders ₹999+',
                        ],
                    ],
                    'pricing' => [
                        'sell' => '₹ 1,29,900',
                        'mrp' => '₹ 1,30,400',
                        'sale_text' => 'You save ₹500',
                    ],
                    'highlights' => [
                        'offer1' => [
                            'svg' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M280-160q-50 0-85-35t-35-85H60l18-80h113q17-19 40-29.5t49-10.5q26 0 49 10.5t40 29.5h167l84-360H182l4-17q6-28 27.5-45.5T264-800h456l-37 160h117l120 160-40 200h-80q0 50-35 85t-85 35q-50 0-85-35t-35-85H400q0 50-35 85t-85 35Zm357-280h193l4-21-74-99h-95l-28 120Zm-19-273 2-7-84 360 2-7 34-146 46-200ZM20-427l20-80h220l-20 80H20Zm80-146 20-80h260l-20 80H100Zm180 333q17 0 28.5-11.5T320-280q0-17-11.5-28.5T280-320q-17 0-28.5 11.5T240-280q0 17 11.5 28.5T280-240Zm400 0q17 0 28.5-11.5T720-280q0-17-11.5-28.5T680-320q-17 0-28.5 11.5T640-280q0 17 11.5 28.5T680-240Z"/></svg>',
                            'title' => 'Fast & insured delivery',
                        ],
                        'offer2' => [
                            'svg' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M480-480Zm0 400q-139-35-229.5-159.5T160-516v-244l320-120 320 120v244q0 10-.5 20t-1.5 20q-9-2-18.5-3t-19.5-1q-11 0-21 1t-21 3q1-10 1.5-19.5t.5-20.5v-189l-240-90-240 90v189q0 121 68 220t172 132q21-7 41-17t39-23v94q-19 10-39 17.5T480-80Zm194 0q-14 0-24-10t-10-24v-132q0-14 10-24t24-10h6v-40q0-33 23.5-56.5T760-400q33 0 56.5 23.5T840-320v40h6q14 0 24 10t10 24v132q0 14-10 24t-24 10H674Zm46-200h80v-40q0-17-11.5-28.5T760-360q-17 0-28.5 11.5T720-320v40Z"/></svg>',
                            'title' => '1-year warranty + free extended support',
                        ],
                        'offer3' => [
                            'svg' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M440-122q-121-15-200.5-105.5T160-440q0-66 26-126.5T260-672l57 57q-38 34-57.5 79T240-440q0 88 56 155.5T440-202v80Zm80 0v-80q87-16 143.5-83T720-440q0-100-70-170t-170-70h-3l44 44-56 56-140-140 140-140 56 56-44 44h3q134 0 227 93t93 227q0 121-79.5 211.5T520-122Z"/></svg>',
                            'title' => '30-day easy returns',
                        ],
                    ]
                ]),
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
