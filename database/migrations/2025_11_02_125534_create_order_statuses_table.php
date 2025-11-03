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
        Schema::create('order_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('slug', 100)->unique();
            $table->string('title', 150);
            $table->text('description')->nullable();
            $table->string('class', 255)->nullable();
            $table->text('icon')->nullable();
            $table->string('category', 50)->default('Other')->index();
            $table->unsignedSmallInteger('position')->default(1);
            $table->tinyInteger('status')->default(1)->comment('1 active, 0 inactive');
            $table->boolean('is_default')->default(false)->comment('Default status for this type');
            $table->boolean('is_final')->default(false)->comment('Final status that cannot be changed');

            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });

        $colorCombos = [
            'basic' => 'bg-gray-900 text-white',
            'success' => 'bg-green-800 text-white',
            'danger' => 'bg-red-900 text-red-300',
            'warning' => 'bg-yellow-400 text-yellow-700',
        ];

        $icon = [
            'block' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M480-80q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm0-80q54 0 104-17.5t92-50.5L228-676q-33 42-50.5 92T160-480q0 134 93 227t227 93Zm252-124q33-42 50.5-92T800-480q0-134-93-227t-227-93q-54 0-104 17.5T284-732l448 448ZM480-480Z"/></svg>',

            'times' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="m256-200-56-56 224-224-224-224 56-56 224 224 224-224 56 56-224 224 224 224-56 56-224-224-224 224Z"/></svg>',

            'check' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M382-240 154-468l57-57 171 171 367-367 57 57-424 424Z"/></svg>',
        ];

        $data = [
            // Initial
            ['slug' => 'pending', 'title' => 'Pending', 'description' => 'Order placed and awaiting processing.', 'class' => $colorCombos['basic'], 'icon' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="m612-292 56-56-148-148v-184h-80v216l172 172ZM480-80q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm0-400Zm0 320q133 0 226.5-93.5T800-480q0-133-93.5-226.5T480-800q-133 0-226.5 93.5T160-480q0 133 93.5 226.5T480-160Z"/></svg>', 'category' => 'Initial', 'position' => 1, 'is_default' => false, 'is_final' => false],

            // Confirmed
            ['slug' => 'confirm', 'title' => 'Confirm', 'description' => 'Order confirmed and ready for processing.', 'class' => $colorCombos['success'], 'icon' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M480-480Zm280-160q-50 0-85-35t-35-85q0-50 35-85t85-35q50 0 85 35t35 85q0 50 35 85t85 35ZM480-80q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q28 0 55.5 4t54.5 12q-11 17-18 36.5T562-788q-20-6-40.5-9t-41.5-3q-134 0-227 93t-93 227q0 134 93 227t227 93q134 0 227-93t93-227q0-21-3-41.5t-9-40.5q20-3 39.5-10t36.5-18q8 27 12 54.5t4 55.5q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm-57-216 273-273q-20-7-37.5-17.5T625-611L424-410 310-522l-56 56 169 170Z"/></svg>', 'category' => 'Confirmed', 'position' => 2, 'is_default' => false, 'is_final' => false],

            ['slug' => 'flag', 'title' => 'Flag', 'description' => 'Order looks suspicious and marked as flagged.', 'class' => $colorCombos['danger'], 'icon' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M200-120v-680h360l16 80h224v400H520l-16-80H280v280h-80Zm300-440Zm86 160h134v-240H510l-16-80H280v240h290l16 80Z"/></svg>', 'category' => 'Confirmed', 'position' => 3, 'is_default' => false, 'is_final' => false],

            ['slug' => 'processing', 'title' => 'Processing', 'description' => 'Order is being processed for shipment.', 'class' => $colorCombos['basic'], 'icon' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M480-80q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm0-80q134 0 227-93t93-227H480v-320q-134 0-227 93t-93 227q0 134 93 227t227 93Z"/></svg>', 'category' => 'Confirmed', 'position' => 4, 'is_default' => false, 'is_final' => false],

            ['slug' => 'ready_to_ship', 'title' => 'Ready to Ship', 'description' => 'Order is ready for shipment.', 'class' => $colorCombos['basic'], 'icon' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M480-480Zm280-160q-50 0-85-35t-35-85q0-50 35-85t85-35q50 0 85 35t35 85q0 50 35 85t85 35ZM480-80q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q28 0 55.5 4t54.5 12q-11 17-18 36.5T562-788q-20-6-40.5-9t-41.5-3q-134 0-227 93t-93 227q0 134 93 227t227 93q134 0 227-93t93-227q0-21-3-41.5t-9-40.5q20-3 39.5-10t36.5-18q8 27 12 54.5t4 55.5q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm-57-216 273-273q-20-7-37.5-17.5T625-611L424-410 310-522l-56 56 169 170Z"/></svg>', 'category' => 'Confirmed', 'position' => 5, 'is_default' => false, 'is_final' => false],

            // Shipping
            ['slug' => 'shipping_started', 'title' => 'Shipping Started', 'description' => 'Order has been shipped.', 'class' => $colorCombos['basic'], 'icon' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M240-160q-50 0-85-35t-35-85H40v-440q0-33 23.5-56.5T120-800h560v160h120l120 160v200h-80q0 50-35 85t-85 35q-50 0-85-35t-35-85H360q0 50-35 85t-85 35Zm0-80q17 0 28.5-11.5T280-280q0-17-11.5-28.5T240-320q-17 0-28.5 11.5T200-280q0 17 11.5 28.5T240-240ZM120-360h32q17-18 39-29t49-11q27 0 49 11t39 29h272v-360H120v360Zm600 120q17 0 28.5-11.5T760-280q0-17-11.5-28.5T720-320q-17 0-28.5 11.5T680-280q0 17 11.5 28.5T720-240Zm-40-200h170l-90-120h-80v120ZM360-540Z"/></svg>', 'category' => 'Shipping', 'position' => 6, 'is_default' => false, 'is_final' => false],

            ['slug' => 'shipping_completed', 'title' => 'Shipping Completed', 'description' => 'Order has reached near customer location.', 'class' => $colorCombos['basic'], 'icon' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M240-160q-50 0-85-35t-35-85H40v-440q0-33 23.5-56.5T120-800h560v160h120l120 160v200h-80q0 50-35 85t-85 35q-50 0-85-35t-35-85H360q0 50-35 85t-85 35Zm0-80q17 0 28.5-11.5T280-280q0-17-11.5-28.5T240-320q-17 0-28.5 11.5T200-280q0 17 11.5 28.5T240-240ZM120-360h32q17-18 39-29t49-11q27 0 49 11t39 29h272v-360H120v360Zm600 120q17 0 28.5-11.5T760-280q0-17-11.5-28.5T720-320q-17 0-28.5 11.5T680-280q0 17 11.5 28.5T720-240Zm-40-200h170l-90-120h-80v120ZM360-540Z"/></svg>', 'category' => 'Shipping', 'position' => 7, 'is_default' => false, 'is_final' => false],

            ['slug' => 'shipping_failed', 'title' => 'Shipping Failed', 'description' => 'Shipping process failed.', 'class' => $colorCombos['danger'], 'icon' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M240-160q-50 0-85-35t-35-85H40v-440q0-33 23.5-56.5T120-800h560v160h120l120 160v200h-80q0 50-35 85t-85 35q-50 0-85-35t-35-85H360q0 50-35 85t-85 35Zm0-80q17 0 28.5-11.5T280-280q0-17-11.5-28.5T240-320q-17 0-28.5 11.5T200-280q0 17 11.5 28.5T240-240ZM120-360h32q17-18 39-29t49-11q27 0 49 11t39 29h272v-360H120v360Zm600 120q17 0 28.5-11.5T760-280q0-17-11.5-28.5T720-320q-17 0-28.5 11.5T680-280q0 17 11.5 28.5T720-240Zm-40-200h170l-90-120h-80v120ZM360-540Z"/></svg>', 'category' => 'Shipping', 'position' => 8, 'is_default' => false, 'is_final' => false],

            ['slug' => 'out_for_delivery', 'title' => 'Out for Delivery', 'description' => 'Order is out for delivery.', 'class' => $colorCombos['warning'], 'icon' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M240-160q-50 0-85-35t-35-85H40v-440q0-33 23.5-56.5T120-800h560v160h120l120 160v200h-80q0 50-35 85t-85 35q-50 0-85-35t-35-85H360q0 50-35 85t-85 35Zm0-80q17 0 28.5-11.5T280-280q0-17-11.5-28.5T240-320q-17 0-28.5 11.5T200-280q0 17 11.5 28.5T240-240ZM120-360h32q17-18 39-29t49-11q27 0 49 11t39 29h272v-360H120v360Zm600 120q17 0 28.5-11.5T760-280q0-17-11.5-28.5T720-320q-17 0-28.5 11.5T680-280q0 17 11.5 28.5T720-240Zm-40-200h170l-90-120h-80v120ZM360-540Z"/></svg>', 'category' => 'Shipping', 'position' => 9, 'is_default' => false, 'is_final' => false],

            ['slug' => 'delivery_failed', 'title' => 'Delivery Failed', 'description' => 'Delivery attempt failed.', 'class' => $colorCombos['danger'], 'icon' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M240-160q-50 0-85-35t-35-85H40v-440q0-33 23.5-56.5T120-800h560v160h120l120 160v200h-80q0 50-35 85t-85 35q-50 0-85-35t-35-85H360q0 50-35 85t-85 35Zm0-80q17 0 28.5-11.5T280-280q0-17-11.5-28.5T240-320q-17 0-28.5 11.5T200-280q0 17 11.5 28.5T240-240ZM120-360h32q17-18 39-29t49-11q27 0 49 11t39 29h272v-360H120v360Zm600 120q17 0 28.5-11.5T760-280q0-17-11.5-28.5T720-320q-17 0-28.5 11.5T680-280q0 17 11.5 28.5T720-240Zm-40-200h170l-90-120h-80v120ZM360-540Z"/></svg>', 'category' => 'Shipping', 'position' => 10, 'is_default' => false, 'is_final' => false],

            // Finalized
            ['slug' => 'delivered', 'title' => 'Delivered', 'description' => 'Order successfully delivered to customer.', 'class' => $colorCombos['success'], 'icon' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M382-240 154-468l57-57 171 171 367-367 57 57-424 424Z"/></svg>', 'category' => 'Finalized', 'position' => 11, 'is_default' => false, 'is_final' => true],

            ['slug' => 'cancelled', 'title' => 'Cancelled', 'description' => 'Order has been cancelled by customer.', 'class' => $colorCombos['danger'], 'icon' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="m336-280 144-144 144 144 56-56-144-144 144-144-56-56-144 144-144-144-56 56 144 144-144 144 56 56ZM480-80q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm0-400Zm0 320q133 0 226.5-93.5T800-480q0-133-93.5-226.5T480-800q-133 0-226.5 93.5T160-480q0 133 93.5 226.5T480-160Z"/></svg>', 'category' => 'Finalized', 'position' => 12, 'is_default' => false, 'is_final' => true],

            // Returns
            ['slug' => 'return_requested', 'title' => 'Return Requested', 'description' => 'Customer has requested a return.', 'class' => $colorCombos['warning'], 'icon' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M574-618q-12-30-35.5-47T482-682q-18 0-35 5t-31 19l-58-58q14-14 38-25.5t44-14.5v-84h80v82q45 9 79 36.5t51 71.5l-76 32ZM792-56 608-240q-15 15-41 24.5T520-204v84h-80v-86q-56-14-93.5-51T292-350l80-32q12 42 40.5 72t75.5 30q18 0 33-4.5t29-13.5L56-792l56-56 736 736-56 56Z"/></svg>', 'category' => 'Returns', 'position' => 13, 'is_default' => false, 'is_final' => false],

            ['slug' => 'return_cancelled', 'title' => 'Return Cancelled', 'description' => 'Return request has been cancelled.', 'class' => $colorCombos['success'], 'icon' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M480-480Zm280-160q-50 0-85-35t-35-85q0-50 35-85t85-35q50 0 85 35t35 85q0 50-35 85t-85 35ZM480-80q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q28 0 55.5 4t54.5 12q-11 17-18 36.5T562-788q-20-6-40.5-9t-41.5-3q-134 0-227 93t-93 227q0 134 93 227t227 93q134 0 227-93t93-227q0-21-3-41.5t-9-40.5q20-3 39.5-10t36.5-18q8 27 12 54.5t4 55.5q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm-57-216 273-273q-20-7-37.5-17.5T625-611L424-410 310-522l-56 56 169 170Z"/></svg>', 'category' => 'Returns', 'position' => 14, 'is_default' => false, 'is_final' => false],

            ['slug' => 'returned', 'title' => 'Returned', 'description' => 'Order has been returned by customer.', 'class' => $colorCombos['danger'], 'icon' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M574-618q-12-30-35.5-47T482-682q-18 0-35 5t-31 19l-58-58q14-14 38-25.5t44-14.5v-84h80v82q45 9 79 36.5t51 71.5l-76 32ZM792-56 608-240q-15 15-41 24.5T520-204v84h-80v-86q-56-14-93.5-51T292-350l80-32q12 42 40.5 72t75.5 30q18 0 33-4.5t29-13.5L56-792l56-56 736 736-56 56Z"/></svg>', 'category' => 'Returns', 'position' => 15, 'is_default' => false, 'is_final' => true],

            ['slug' => 'refunded', 'title' => 'Refunded', 'description' => 'Payment has been refunded to customer.', 'class' => $colorCombos['danger'], 'icon' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M574-618q-12-30-35.5-47T482-682q-18 0-35 5t-31 19l-58-58q14-14 38-25.5t44-14.5v-84h80v82q45 9 79 36.5t51 71.5l-76 32ZM792-56 608-240q-15 15-41 24.5T520-204v84h-80v-86q-56-14-93.5-51T292-350l80-32q12 42 40.5 72t75.5 30q18 0 33-4.5t29-13.5L56-792l56-56 736 736-56 56Z"/></svg>', 'category' => 'Returns', 'position' => 16, 'is_default' => false, 'is_final' => true],

            // Other
            ['slug' => 'on_hold', 'title' => 'On Hold', 'description' => 'Order placed on hold temporarily.', 'class' => $colorCombos['basic'], 'icon' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M480-480v-400q0-17 11.5-28.5T520-920q17 0 28.5 11.5T560-880v400h-80Zm-160 0v-360q0-17 11.5-28.5T360-880q17 0 28.5 11.5T400-840v360h-80ZM500-40q-142 0-241-99t-99-241v-380q0-17 11.5-28.5T200-800q17 0 28.5 11.5T240-760v380q0 109 75.5 184.5T500-120q109 0 184.5-75.5T760-380v-140q-17 0-28.5 11.5T720-480v160H600q-33 0-56.5 23.5T520-240v40h-80v-40q0-66 47-113t113-47h40v-400q0-17 11.5-28.5T680-840q17 0 28.5 11.5T720-800v207q10-3 19.5-5t20.5-2h80v220q0 142-99 241T500-40Zm40-320Z"/></svg>', 'category' => 'Other', 'position' => 17, 'is_default' => false, 'is_final' => false],
        ];

        DB::table('order_statuses')->insert($data);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_statuses');
    }
};
