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
        Schema::create('developer_settings', function (Blueprint $table) {
            $table->id();

            $table->string('category', 100);
            $table->string('key', 200)->unique();
            $table->json('value');
            $table->text('description')->nullable();

            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
        });

        $image_validation = json_encode([
            'max_image_size' => '2000',
            'max_image_size_in_kb' => '2000 KB',
            'max_image_size_in_mb' => '2 MB',
            'image_upload_mimes_array' => ['jpg', 'jpeg', 'png', 'webp']
        ]);

        $file_upload = json_encode([
            'store_original_image' => true,
            'resize_image' => true,
            'image_thumbnail_height_array' => [100, 250, 500]
        ]);

        $product_type = json_encode([
            [
                'key' => 'core-commerce',
                'title' => 'Core Commerce',
                'children' => [
                    ['key' => 'physical-product', 'title' => 'Physical Product', 'description' => 'Tangible goods that require shipping'],
                    ['key' => 'digital-product', 'title' => 'Digital Product', 'description' => 'Downloadable files, software, or media'],
                    ['key' => 'service', 'title' => 'Service', 'description' => 'Intangible offerings like consulting or repairs'],
                    ['key' => 'subscription', 'title' => 'Subscription', 'description' => 'Recurring access to products/services'],
                ]
            ],
            [
                'key' => 'travel',
                'title' => 'Travel Industry',
                'children' => [
                    ['key' => 'hotel-booking', 'title' => 'Hotel Booking', 'description' => 'Accommodation reservations'],
                    ['key' => 'flight-ticket', 'title' => 'Flight Ticket', 'description' => 'Air travel bookings'],
                    ['key' => 'tour-package', 'title' => 'Tour Package', 'description' => 'Bundled travel experiences'],
                    ['key' => 'car-rental', 'title' => 'Car Rental', 'description' => 'Vehicle rental services'],
                    ['key' => 'cruise', 'title' => 'Cruise', 'description' => 'Sea voyage packages'],
                ]
            ],
            [
                'key' => 'entertainment',
                'title' => 'Event & Entertainment',
                'children' => [
                    ['key' => 'event-ticket', 'title' => 'Event Ticket', 'description' => 'Admission to concerts, shows, etc.'],
                    ['key' => 'movie-ticket', 'title' => 'Movie Ticket', 'description' => 'Cinema bookings'],
                    ['key' => 'theme-park', 'title' => 'Theme Park Ticket', 'description' => 'Amusement park admissions'],
                ]
            ],
            [
                'key' => 'food-beverage',
                'title' => 'Food & Beverage',
                'children' => [
                    ['key' => 'restaurant-booking', 'title' => 'Restaurant Booking', 'description' => 'Dining reservations'],
                    ['key' => 'food-delivery', 'title' => 'Food Delivery', 'description' => 'Prepared meal delivery'],
                    ['key' => 'grocery', 'title' => 'Grocery', 'description' => 'Supermarket/grocery items'],
                ]
            ],
            [
                'key' => 'fin-tech',
                'title' => 'Financial Technology',
                'children' => [
                    ['key' => 'insurance', 'title' => 'Insurance', 'description' => 'Insurance policy products'],
                    ['key' => 'loan', 'title' => 'Loan', 'description' => 'Financial lending products'],
                ]
            ],
            [
                'key' => 'ed-tech',
                'title' => 'Educational Technology',
                'children' => [
                    ['key' => 'online-course', 'title' => 'Online Course', 'description' => 'Digital educational programs'],
                    ['key' => 'ebook', 'title' => 'E-Book', 'description' => 'Digital books and publications'],
                    ['key' => 'workshop', 'title' => 'Workshop', 'description' => 'In-person training sessions'],
                ]
            ],
            [
                'key' => 'health-wellness',
                'title' => 'Health & Wellness',
                'children' => [
                    ['key' => 'medical-appointment', 'title' => 'Medical Appointment', 'description' => 'Healthcare service bookings'],
                    ['key' => 'fitness-class', 'title' => 'Fitness Class', 'description' => 'Exercise sessions'],
                    ['key' => 'spa-service', 'title' => 'Spa Service', 'description' => 'Beauty/wellness treatments'],
                ]
            ],
            [
                'key' => 'special',
                'title' => 'Custom & Special Cases',
                'children' => [
                    ['key' => 'bundle', 'title' => 'Product Bundle', 'description' => 'Grouped products sold together'],
                    ['key' => 'custom-made', 'title' => 'Custom Made', 'description' => 'Personalized/made-to-order items'],
                    ['key' => 'rental', 'title' => 'Rental', 'description' => 'Temporary usage of physical items'],
                    ['key' => 'membership', 'title' => 'Membership', 'description' => 'Access to exclusive benefits'],
                ]
            ]
        ]);

        $product_highlight_icons = json_encode([
            'icons' => [
                'check' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M382-240 154-468l57-57 171 171 367-367 57 57-424 424Z"/></svg>',

                'check-circle' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="m424-408-86-86q-11-11-28-11t-28 11q-11 11-11 28t11 28l114 114q12 12 28 12t28-12l226-226q11-11 11-28t-11-28q-11-11-28-11t-28 11L424-408Zm56 328q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm0-80q134 0 227-93t93-227q0-134-93-227t-227-93q-134 0-227 93t-93 227q0 134 93 227t227 93Zm0-320Z"/></svg>',

                'check-box' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="m424-424-86-86q-11-11-28-11t-28 11q-11 11-11 28t11 28l114 114q12 12 28 12t28-12l226-226q11-11 11-28t-11-28q-11-11-28-11t-28 11L424-424ZM200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h560q33 0 56.5 23.5T840-760v560q0 33-23.5 56.5T760-120H200Zm0-80h560v-560H200v560Zm0-560v560-560Z"/></svg>',

                'check-alt' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M480-80q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q48 0 93.5 11t87.5 32q15 8 19.5 24t-5.5 30q-10 14-26.5 18t-32.5-4q-32-15-66.5-23t-69.5-8q-133 0-226.5 93.5T160-480q0 133 93.5 226.5T480-160q133 0 226.5-93.5T800-480q0-8-.5-15.5T798-511q-2-17 6.5-32.5T830-564q16-5 30 3t16 24q2 14 3 28t1 29q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm-56-328 372-373q11-11 27.5-11.5T852-781q11 11 11 28t-11 28L452-324q-12 12-28 12t-28-12L282-438q-11-11-11-28t11-28q11-11 28-11t28 11l86 86Z"/></svg>',

                'done-all' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M70-438q-12-12-11.5-28T71-494q12-11 28-11.5t28 11.5l142 142 14 14 14 14q12 12 11.5 28T296-268q-12 11-28 11.5T240-268L70-438Zm424 85 340-340q12-12 28-11.5t28 12.5q11 12 11.5 28T890-636L522-268q-12 12-28 12t-28-12L296-438q-11-11-11-27.5t11-28.5q12-12 28.5-12t28.5 12l141 141Zm169-282L522-494q-11 11-27.5 11T466-494q-12-12-12-28.5t12-28.5l141-141q11-11 27.5-11t28.5 11q12 12 12 28.5T663-635Z"/></svg>',

                'check-outline' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="m381-240 424-424-57-56-368 367-169-170-57 57 227 226Zm-57 56L98-410q-12-12-17.5-26.5T75-466q0-15 5.5-30T98-523l56-56q12-12 26.5-18t30.5-6q16 0 30.5 6t26.5 18l113 113 310-311q11-12 26-17.5t30-5.5q15 0 30 5.5t27 16.5l57 56q12 12 18 26.5t6 30.5q0 16-5.5 30.5T862-608L438-184q-12 12-27 18t-30 6q-15 0-30-6t-27-18Z"/></svg>',

                'release-alert' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="m326-90-58-98-110-24q-15-3-24-15.5t-7-27.5l11-113-75-86q-10-11-10-26t10-26l75-86-11-113q-2-15 7-27.5t24-15.5l110-24 58-98q8-13 22-17.5t28 1.5l104 44 104-44q14-6 28-1.5t22 17.5l58 98 110 24q15 3 24 15.5t7 27.5l-11 113 75 86q10 11 10 26t-10 26l-75 86 11 113q2 15-7 27.5T802-212l-110 24-58 98q-8 13-22 17.5T584-74l-104-44-104 44q-14 6-28 1.5T326-90Zm52-72 102-44 104 44 56-96 110-26-10-112 74-84-74-86 10-112-110-24-58-96-102 44-104-44-56 96-110 24 10 112-74 86 74 84-10 114 110 24 58 96Zm102-318Zm0 200q17 0 28.5-11.5T520-320q0-17-11.5-28.5T480-360q-17 0-28.5 11.5T440-320q0 17 11.5 28.5T480-280Zm0-160q17 0 28.5-11.5T520-480v-160q0-17-11.5-28.5T480-680q-17 0-28.5 11.5T440-640v160q0 17 11.5 28.5T480-440Z"/></svg>',

                'trending-flat' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M727-440H160q-17 0-28.5-11.5T120-480q0-17 11.5-28.5T160-520h567l-55-56q-12-12-11.5-28t12.5-28q12-11 28.5-11.5T729-632l123 124q12 12 12 28t-12 28L728-328q-11 11-27.5 11T672-328q-12-12-12-28.5t12-28.5l55-55Z"/></svg>'
            ],
            'icons_classes' => 'w-3 h-3 text-green-600 dark:text-green-600'
        ]);

        $order_status = json_encode([
            [
                'title' => 'Pending',
                'slug' => 'pending',
                'description' => 'Order placed, awaiting confirmation or payment.',
                'class' => 'text-yellow-500 bg-yellow-100'
            ],
            [
                'title' => 'Confirmed',
                'slug' => 'confirmed',
                'description' => 'Order confirmed and payment verified.',
                'class' => 'text-blue-600 bg-blue-100'
            ],
            [
                'title' => 'Processing',
                'slug' => 'processing',
                'description' => 'Order is being prepared or packed.',
                'class' => 'text-indigo-600 bg-indigo-100'
            ],
            [
                'title' => 'Shipped',
                'slug' => 'shipped',
                'description' => 'Order has been shipped and is in transit.',
                'class' => 'text-purple-600 bg-purple-100'
            ],
            [
                'title' => 'Delivered',
                'slug' => 'delivered',
                'description' => 'Order delivered successfully to the customer.',
                'class' => 'text-green-600 bg-green-100'
            ],
            [
                'title' => 'Cancelled',
                'slug' => 'cancelled',
                'description' => 'Order was cancelled before fulfillment.',
                'class' => 'text-gray-600 bg-gray-200'
            ],
            [
                'title' => 'Returned',
                'slug' => 'returned',
                'description' => 'Customer returned the product after delivery.',
                'class' => 'text-orange-600 bg-orange-100'
            ],
            [
                'title' => 'Failed',
                'slug' => 'failed',
                'description' => 'Order failed due to payment or technical issues.',
                'class' => 'text-red-600 bg-red-100'
            ],
            [
                'title' => 'Refunded',
                'slug' => 'refunded',
                'description' => 'Amount refunded for the returned or failed order.',
                'class' => 'text-teal-600 bg-teal-100'
            ],
            [
                'title' => 'On Hold',
                'slug' => 'on-hold',
                'description' => 'Order processing is temporarily paused.',
                'class' => 'text-pink-600 bg-pink-100'
            ],
        ]);

        $data = [
            [
                'category' => 'file_upload',
                'key' => 'image_validation',
                'value' => $image_validation,
                'description' => '',
            ],
            [
                'category' => 'file_upload',
                'key' => 'file_upload',
                'value' => $file_upload,
                'description' => '',
            ],
            [
                'category' => 'product',
                'key' => 'product_type',
                'value' => $product_type,
                'description' => '',
            ],
            [
                'category' => 'product',
                'key' => 'product_highlight_icons',
                'value' => $product_highlight_icons,
                'description' => '',
            ],
            [
                'category' => 'order',
                'key' => 'order_status',
                'value' => $order_status,
                'description' => '',
            ]
        ];

        DB::table('developer_settings')->insert($data);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('developer_settings');
    }
};
