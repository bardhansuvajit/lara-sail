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
                ->references('code')
                ->on('countries')
                ->cascadeOnDelete();

            $table->string('title')->nullable();
            $table->text('subtitle')->nullable();
            $table->text('url')->nullable();

            $table->text('image_s')->nullable();
            $table->text('image_m')->nullable();
            $table->text('image_l')->nullable();

            $table->string('cta_primary_text')->nullable();
            $table->string('cta_primary_url')->nullable();
            $table->string('cta_secondary_text')->nullable();
            $table->string('cta_secondary_url')->nullable();

            $table->json('meta')->nullable();

            // timing control
            // $table->timestamp('start_at')->nullable();
            // $table->timestamp('end_at')->nullable();
            // $table->tinyInteger('show_offer_ends_timing')->default(0);

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
                'url' => null,

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
                'title' => 'Sign in & save more',
                'subtitle' => 'Login to unlock personalised deals, faster checkout, wishlist sync, and early-bird access to flash sales.',
                'url' => null,

                'image_s' => null,
                'image_m' => null,
                'image_l' => null,

                'cta_primary_text' => 'Login Now',
                'cta_primary_url' => '/login',
                'cta_secondary_text' => 'Create Account',
                'cta_secondary_url' => '/register',

                'meta' => json_encode([
                    'tags' => [
                        'left' => [
                            'tag1' => [
                                'svg' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentcolor"><path d="M640-520q17 0 28.5-11.5T680-560q0-17-11.5-28.5T640-600q-17 0-28.5 11.5T600-560q0 17 11.5 28.5T640-520Zm-320-80h200v-80H320v80ZM180-120q-34-114-67-227.5T80-580q0-92 64-156t156-64h200q29-38 70.5-59t89.5-21q25 0 42.5 17.5T720-820q0 6-1.5 12t-3.5 11q-4 11-7.5 22.5T702-751l91 91h87v279l-113 37-67 224H480v-80h-80v80H180Zm60-80h80v-80h240v80h80l62-206 98-33v-141h-40L620-720q0-20 2.5-38.5T630-796q-29 8-51 27.5T547-720H300q-58 0-99 41t-41 99q0 98 27 191.5T240-200Zm240-298Z"/></svg>',
                                'title' => '₹150 OFF - First order'
                            ],
                            'tag2' => [
                                'svg' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentcolor"><path d="M480-80q-24 0-46-9t-39-26q-29-29-50-38t-63-9q-50 0-85-35t-35-85q0-42-9-63t-38-50q-17-17-26-39t-9-46q0-24 9-46t26-39q29-29 38-50t9-63q0-50 35-85t85-35q42 0 63-9t50-38q17-17 39-26t46-9q24 0 46 9t39 26q29 29 50 38t63 9q50 0 85 35t35 85q0 42 9 63t38 50q17 17 26 39t9 46q0 24-9 46t-26 39q-29 29-38 50t-9 63q0 50-35 85t-85 35q-42 0-63 9t-50 38q-17 17-39 26t-46 9Zm0-80q8 0 15.5-3.5T508-172q41-41 77-55.5t93-14.5q17 0 28.5-11.5T718-282q0-58 14.5-93.5T788-452q12-12 12-28t-12-28q-41-41-55.5-77T718-678q0-17-11.5-28.5T678-718q-58 0-93.5-14.5T508-788q-5-5-12.5-8.5T480-800q-8 0-15.5 3.5T452-788q-41 41-77 55.5T282-718q-17 0-28.5 11.5T242-678q0 58-14.5 93.5T172-508q-12 12-12 28t12 28q41 41 55.5 77t14.5 93q0 17 11.5 28.5T282-242q58 0 93.5 14.5T452-172q5 5 12.5 8.5T480-160Zm100-160q25 0 42.5-17.5T640-380q0-25-17.5-42.5T580-440q-25 0-42.5 17.5T520-380q0 25 17.5 42.5T580-320Zm-202-2 260-260-56-56-260 260 56 56Zm2-198q25 0 42.5-17.5T440-580q0-25-17.5-42.5T380-640q-25 0-42.5 17.5T320-580q0 25 17.5 42.5T380-520Zm100 40Z"/></svg>',
                                'title' => 'Exclusive deals'
                            ],
                        ],
                        'right' => [
                            'tag1' => [
                                'svg' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentcolor"><path d="M0-240v-63q0-43 44-70t116-27q13 0 25 .5t23 2.5q-14 21-21 44t-7 48v65H0Zm240 0v-65q0-32 17.5-58.5T307-410q32-20 76.5-30t96.5-10q53 0 97.5 10t76.5 30q32 20 49 46.5t17 58.5v65H240Zm540 0v-65q0-26-6.5-49T754-397q11-2 22.5-2.5t23.5-.5q72 0 116 26.5t44 70.5v63H780Zm-455-80h311q-10-20-55.5-35T480-370q-55 0-100.5 15T325-320ZM160-440q-33 0-56.5-23.5T80-520q0-34 23.5-57t56.5-23q34 0 57 23t23 57q0 33-23 56.5T160-440Zm640 0q-33 0-56.5-23.5T720-520q0-34 23.5-57t56.5-23q34 0 57 23t23 57q0 33-23 56.5T800-440Zm-320-40q-50 0-85-35t-35-85q0-51 35-85.5t85-34.5q51 0 85.5 34.5T600-600q0 50-34.5 85T480-480Zm0-80q17 0 28.5-11.5T520-600q0-17-11.5-28.5T480-640q-17 0-28.5 11.5T440-600q0 17 11.5 28.5T480-560Zm1 240Zm-1-280Z"/></svg>',
                                'title' => 'Trusted · 1M+ users'
                            ]
                        ],
                    ],
                    'highlights' => [
                        'offer1' => [
                            'svg' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentcolor"><path d="m280-80 160-300-320-40 480-460h80L520-580l320 40L360-80h-80Zm222-247 161-154-269-34 63-117-160 154 268 33-63 118Zm-22-153Z"/></svg>',
                            'title' => 'Faster checkout',
                        ],
                        'offer2' => [
                            'svg' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentcolor"><path d="M216-720h528l-34-40H250l-34 40Zm184 270 80-40 80 40v-190H400v190ZM200-120q-33 0-56.5-23.5T120-200v-499q0-14 4.5-27t13.5-24l50-61q11-14 27.5-21.5T250-840h460q18 0 34.5 7.5T772-811l50 61q9 11 13.5 24t4.5 27v139q-21 0-41.5 3T760-545v-95H640v205l-77 77-83-42-160 80v-320H200v440h280v80H200Zm440-520h120-120Zm-440 0h363-363Zm360 520v-123l221-220q9-9 20-13t22-4q12 0 23 4.5t20 13.5l37 37q8 9 12.5 20t4.5 22q0 11-4 22.5T903-340L683-120H560Zm300-263-37-37 37 37ZM620-180h38l121-122-18-19-19-18-122 121v38Zm141-141-19-18 37 37-18-19Z"/></svg>',
                            'title' => 'Personalised picks',
                        ],
                        'offer3' => [
                            'svg' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentcolor"><path d="M160-280v80h640v-80H160Zm0-440h88q-5-9-6.5-19t-1.5-21q0-50 35-85t85-35q30 0 55.5 15.5T460-826l20 26 20-26q18-24 44-39t56-15q50 0 85 35t35 85q0 11-1.5 21t-6.5 19h88q33 0 56.5 23.5T880-640v440q0 33-23.5 56.5T800-120H160q-33 0-56.5-23.5T80-200v-440q0-33 23.5-56.5T160-720Zm0 320h640v-240H596l84 114-64 46-136-184-136 184-64-46 82-114H160v240Zm200-320q17 0 28.5-11.5T400-760q0-17-11.5-28.5T360-800q-17 0-28.5 11.5T320-760q0 17 11.5 28.5T360-720Zm240 0q17 0 28.5-11.5T640-760q0-17-11.5-28.5T600-800q-17 0-28.5 11.5T560-760q0 17 11.5 28.5T600-720Z"/></svg>',
                            'title' => 'Exclusive coupons',
                        ],
                        'offer4' => [
                            'svg' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentcolor"><path d="M200-80q-33 0-56.5-23.5T120-160v-480q0-33 23.5-56.5T200-720h80q0-83 58.5-141.5T480-920q83 0 141.5 58.5T680-720h80q33 0 56.5 23.5T840-640v480q0 33-23.5 56.5T760-80H200Zm0-80h560v-480H200v480Zm280-240q83 0 141.5-58.5T680-600h-80q0 50-35 85t-85 35q-50 0-85-35t-35-85h-80q0 83 58.5 141.5T480-400ZM360-720h240q0-50-35-85t-85-35q-50 0-85 35t-35 85ZM200-160v-480 480Z"/></svg>',
                            'title' => 'Orders saved',
                        ],
                    ]
                ])
            ],
            [
                'ad_section_id' => 3,
                'country_code' => 'IN',
                'title' => 'Trusted marketplace',
                'subtitle' => 'Secure checkout, verified sellers and fast support — shop confidently. Enjoy easy returns and transparent seller ratings on every order.',
                'url' => '/login',

                'image_s' => 'default/ad/big-yellow.jpg',
                'image_m' => 'default/ad/big-yellow.jpg',
                'image_l' => 'default/ad/big-yellow.jpg',

                'cta_primary_text' => 'See our Collections',
                'cta_primary_url' => '/collection',
                'cta_secondary_text' => 'Why trust us',
                'cta_secondary_url' => '/about-us',

                'meta' => json_encode([
                    'tags' => [
                        'left' => [
                            'tag1' => [
                                'svg' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentcolor"><path d="m438-338 226-226-57-57-169 169-84-84-57 57 141 141Zm42 258q-139-35-229.5-159.5T160-516v-244l320-120 320 120v244q0 152-90.5 276.5T480-80Zm0-84q104-33 172-132t68-220v-189l-240-90-240 90v189q0 121 68 220t172 132Zm0-316Z"/></svg>',
                                'title' => 'Secure payments'
                            ],
                            'tag2' => [
                                'svg' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentcolor"><path d="m344-60-76-128-144-32 14-148-98-112 98-112-14-148 144-32 76-128 136 58 136-58 76 128 144 32-14 148 98 112-98 112 14 148-144 32-76 128-136-58-136 58Zm34-102 102-44 104 44 56-96 110-26-10-112 74-84-74-86 10-112-110-24-58-96-102 44-104-44-56 96-110 24 10 112-74 86 74 84-10 114 110 24 58 96Zm102-318Zm-42 142 226-226-56-58-170 170-86-84-56 56 142 142Z"/></svg>',
                                'title' => 'Verified sellers'
                            ],
                        ],
                        'right' => [
                            'tag1' => [
                                'svg' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentcolor"><path d="M0-240v-63q0-43 44-70t116-27q13 0 25 .5t23 2.5q-14 21-21 44t-7 48v65H0Zm240 0v-65q0-32 17.5-58.5T307-410q32-20 76.5-30t96.5-10q53 0 97.5 10t76.5 30q32 20 49 46.5t17 58.5v65H240Zm540 0v-65q0-26-6.5-49T754-397q11-2 22.5-2.5t23.5-.5q72 0 116 26.5t44 70.5v63H780Zm-455-80h311q-10-20-55.5-35T480-370q-55 0-100.5 15T325-320ZM160-440q-33 0-56.5-23.5T80-520q0-34 23.5-57t56.5-23q34 0 57 23t23 57q0 33-23 56.5T160-440Zm640 0q-33 0-56.5-23.5T720-520q0-34 23.5-57t56.5-23q34 0 57 23t23 57q0 33-23 56.5T800-440Zm-320-40q-50 0-85-35t-35-85q0-51 35-85.5t85-34.5q51 0 85.5 34.5T600-600q0 50-34.5 85T480-480Zm0-80q17 0 28.5-11.5T520-600q0-17-11.5-28.5T480-640q-17 0-28.5 11.5T440-600q0 17 11.5 28.5T480-560Zm1 240Zm-1-280Z"/></svg>',
                                'title' => 'Trusted · 1M+ users'
                            ]
                        ],
                    ],
                    'highlights' => [
                        'offer1' => [
                            'svg' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentcolor"><path d="m480-320 56-56-63-64h167v-80H473l63-64-56-56-160 160 160 160ZM200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h168q13-36 43.5-58t68.5-22q38 0 68.5 22t43.5 58h168q33 0 56.5 23.5T840-760v560q0 33-23.5 56.5T760-120H200Zm0-80h560v-560H200v560Zm280-590q13 0 21.5-8.5T510-820q0-13-8.5-21.5T480-850q-13 0-21.5 8.5T450-820q0 13 8.5 21.5T480-790ZM200-200v-560 560Z"/></svg>',
                            'title' => '7-day easy returns',
                        ],
                        'offer2' => [
                            'svg' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentcolor"><path d="M280-160q-50 0-85-35t-35-85H60l18-80h113q17-19 40-29.5t49-10.5q26 0 49 10.5t40 29.5h167l84-360H262l17-80h441l-37 160h117l120 160-40 200h-80q0 50-35 85t-85 35q-50 0-85-35t-35-85H400q0 50-35 85t-85 35Zm357-280h193l4-21-74-99h-95l-28 120Zm-17-280-84 360 2-7 82-353ZM140-440v-120H40l140-200v120h100L140-440Zm140 200q17 0 28.5-11.5T320-280q0-17-11.5-28.5T280-320q-17 0-28.5 11.5T240-280q0 17 11.5 28.5T280-240Zm400 0q17 0 28.5-11.5T720-280q0-17-11.5-28.5T680-320q-17 0-28.5 11.5T640-280q0 17 11.5 28.5T680-240Z"/></svg>',
                            'title' => 'Fast shipping',
                        ],
                        'offer3' => [
                            'svg' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentcolor"><path d="M440-120v-80h320v-284q0-117-81.5-198.5T480-764q-117 0-198.5 81.5T200-484v244h-40q-33 0-56.5-23.5T80-320v-80q0-21 10.5-39.5T120-469l3-53q8-68 39.5-126t79-101q47.5-43 109-67T480-840q68 0 129 24t109 66.5Q766-707 797-649t40 126l3 52q19 9 29.5 27t10.5 38v92q0 20-10.5 38T840-249v49q0 33-23.5 56.5T760-120H440Zm-80-280q-17 0-28.5-11.5T320-440q0-17 11.5-28.5T360-480q17 0 28.5 11.5T400-440q0 17-11.5 28.5T360-400Zm240 0q-17 0-28.5-11.5T560-440q0-17 11.5-28.5T600-480q17 0 28.5 11.5T640-440q0 17-11.5 28.5T600-400Zm-359-62q-7-106 64-182t177-76q89 0 156.5 56.5T720-519q-91-1-167.5-49T435-698q-16 80-67.5 142.5T241-462Z"/></svg>',
                            'title' => '24/7 support',
                        ],
                        'offer4' => [
                            'svg' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentcolor"><path d="M560-440q-50 0-85-35t-35-85q0-50 35-85t85-35q50 0 85 35t35 85q0 50-35 85t-85 35ZM280-320q-33 0-56.5-23.5T200-400v-320q0-33 23.5-56.5T280-800h560q33 0 56.5 23.5T920-720v320q0 33-23.5 56.5T840-320H280Zm80-80h400q0-33 23.5-56.5T840-480v-160q-33 0-56.5-23.5T760-720H360q0 33-23.5 56.5T280-640v160q33 0 56.5 23.5T360-400Zm440 240H120q-33 0-56.5-23.5T40-240v-440h80v440h680v80ZM280-400v-320 320Z"/></svg>',
                            'title' => 'Secure payments',
                        ],
                    ],
                    'bgImage' => 'default/ad/sale.jpg'
                ])
            ],
            [
                'ad_section_id' => 4,
                'country_code' => 'IN',
                'title' => 'Save <span class="text-indigo-600 dark:text-indigo-400">₹500</span> today — pre-order the new iMac 27”',
                'subtitle' => 'Reserve your iMac now to lock in exclusive launch pricing, priority shipping and a complimentary 1-year warranty extension.',
                'url' => null,

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
            [
                'ad_section_id' => 5,
                'country_code' => 'IN',
                'title' => 'Top Category Banner',
                'subtitle' => null,
                'url' => '/collection',

                'image_s' => 'default/ad/category-banner-ad.png',
                'image_m' => 'default/ad/category-banner-ad.png',
                'image_l' => 'default/ad/category-banner-ad.png',

                'cta_primary_text' => null,
                'cta_primary_url' => null,
                'cta_secondary_text' => null,
                'cta_secondary_url' => null,

                'meta' => json_encode([])
            ],
            [
                'ad_section_id' => 6,
                'country_code' => 'IN',
                'title' => 'Sponsored Ad 1',
                'subtitle' => null,
                'url' => '/collection',

                'image_s' => 'default/ad/sponsored-ad1.png',
                'image_m' => 'default/ad/sponsored-ad1.png',
                'image_l' => 'default/ad/sponsored-ad1.png',

                'cta_primary_text' => null,
                'cta_primary_url' => null,
                'cta_secondary_text' => null,
                'cta_secondary_url' => null,

                'meta' => json_encode([])
            ],
            [
                'ad_section_id' => 7,
                'country_code' => 'IN',
                'title' => 'Sponsored Ad 2',
                'subtitle' => null,
                'url' => '/collection',

                'image_s' => 'default/ad/sponsored-ad2.png',
                'image_m' => 'default/ad/sponsored-ad2.png',
                'image_l' => 'default/ad/sponsored-ad2.png',

                'cta_primary_text' => null,
                'cta_primary_url' => null,
                'cta_secondary_text' => null,
                'cta_secondary_url' => null,

                'meta' => json_encode([])
            ]
        ];

        // Setting Foreign key check to 0, 
        // BECAUSE, while fresh migration, countries table has no data, it will have data after DB SEED. HENCE throws ERROR
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('ad_items')->insert($data);
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ad_items');
    }
};
