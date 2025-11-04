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
            'gray' => 'bg-gray-200 text-gray-700',
            'green' => 'bg-green-200 text-green-700',
            'green-dark' => 'bg-green-700 text-white',
            'red' => 'bg-red-200 text-red-700',
            'yellow' => 'bg-yellow-200 text-yellow-700',
            'blue' => 'bg-blue-200 text-blue-700',
        ];

        $icon = [
            'block' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M480-80q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm0-80q54 0 104-17.5t92-50.5L228-676q-33 42-50.5 92T160-480q0 134 93 227t227 93Zm252-124q33-42 50.5-92T800-480q0-134-93-227t-227-93q-54 0-104 17.5T284-732l448 448ZM480-480Z"/></svg>',

            'times' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="m256-200-56-56 224-224-224-224 56-56 224 224 224-224 56 56-224 224 224 224-56 56-224-224-224 224Z"/></svg>',

            'check' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M382-240 154-468l57-57 171 171 367-367 57 57-424 424Z"/></svg>',
        ];

        $data = [
            // Initial
            ['slug' => 'pending', 'title' => 'Pending', 'description' => 'Order placed and awaiting processing.', 'class' => $colorCombos['gray'], 'icon' => $icon['block'], 'category' => 'Initial', 'position' => 1, 'is_default' => false, 'is_final' => false],

            // Confirmed
            ['slug' => 'confirm', 'title' => 'Confirm', 'description' => 'Order confirmed and ready for processing.', 'class' => $colorCombos['green'], 'icon' => $icon['check'], 'category' => 'Confirmed', 'position' => 2, 'is_default' => false, 'is_final' => false],

            ['slug' => 'flag', 'title' => 'Flag', 'description' => 'Order looks suspicious and marked as flagged.', 'class' => $colorCombos['red'], 'icon' => $icon['times'], 'category' => 'Confirmed', 'position' => 3, 'is_default' => false, 'is_final' => false],

            ['slug' => 'processing', 'title' => 'Processing', 'description' => 'Order is being processed for shipment.', 'class' => $colorCombos['gray'], 'icon' => $icon['check'], 'category' => 'Confirmed', 'position' => 4, 'is_default' => false, 'is_final' => false],

            ['slug' => 'ready_to_ship', 'title' => 'Ready to Ship', 'description' => 'Order is ready for shipment.', 'class' => $colorCombos['gray'], 'icon' => $icon['check'], 'category' => 'Confirmed', 'position' => 5, 'is_default' => false, 'is_final' => false],

            // Shipping
            ['slug' => 'shipping_started', 'title' => 'Shipping Started', 'description' => 'Order has been shipped.', 'class' => $colorCombos['gray'], 'icon' => $icon['check'], 'category' => 'Shipping', 'position' => 6, 'is_default' => false, 'is_final' => false],

            ['slug' => 'shipping_completed', 'title' => 'Shipping Completed', 'description' => 'Order has reached near customer location.', 'class' => $colorCombos['gray'], 'icon' => $icon['check'], 'category' => 'Shipping', 'position' => 7, 'is_default' => false, 'is_final' => false],

            ['slug' => 'shipping_failed', 'title' => 'Shipping Failed', 'description' => 'Shipping process failed.', 'class' => $colorCombos['red'], 'icon' => $icon['block'], 'category' => 'Shipping', 'position' => 8, 'is_default' => false, 'is_final' => false],

            ['slug' => 'out_for_delivery', 'title' => 'Out for Delivery', 'description' => 'Order is out for delivery.', 'class' => $colorCombos['yellow'], 'icon' => $icon['check'], 'category' => 'Shipping', 'position' => 9, 'is_default' => false, 'is_final' => false],

            ['slug' => 'delivery_failed', 'title' => 'Delivery Failed', 'description' => 'Delivery attempt failed.', 'class' => $colorCombos['red'], 'icon' => $icon['block'], 'category' => 'Shipping', 'position' => 10, 'is_default' => false, 'is_final' => false],

            // Finalized
            ['slug' => 'delivered', 'title' => 'Delivered', 'description' => 'Order successfully delivered to customer.', 'class' => $colorCombos['green-dark'], 'icon' => $icon['check'], 'category' => 'Finalized', 'position' => 11, 'is_default' => false, 'is_final' => true],

            ['slug' => 'cancelled', 'title' => 'Cancelled', 'description' => 'Order has been cancelled by customer.', 'class' => $colorCombos['red'], 'icon' => $icon['block'], 'category' => 'Finalized', 'position' => 12, 'is_default' => false, 'is_final' => true],

            // Returns
            ['slug' => 'return_requested', 'title' => 'Return Requested', 'description' => 'Customer has requested a return.', 'class' => $colorCombos['yellow'], 'icon' => $icon['times'], 'category' => 'Returns', 'position' => 13, 'is_default' => false, 'is_final' => false],

            ['slug' => 'return_cancelled', 'title' => 'Return Cancelled', 'description' => 'Return request has been cancelled.', 'class' => $colorCombos['green'], 'icon' => $icon['check'], 'category' => 'Returns', 'position' => 14, 'is_default' => false, 'is_final' => false],

            ['slug' => 'returned', 'title' => 'Returned', 'description' => 'Order has been returned by customer.', 'class' => $colorCombos['red'], 'icon' => $icon['block'], 'category' => 'Returns', 'position' => 15, 'is_default' => false, 'is_final' => true],

            ['slug' => 'refunded', 'title' => 'Refunded', 'description' => 'Payment has been refunded to customer.', 'class' => $colorCombos['red'], 'icon' => $icon['block'], 'category' => 'Returns', 'position' => 16, 'is_default' => false, 'is_final' => true],

            // Other
            ['slug' => 'on_hold', 'title' => 'On Hold', 'description' => 'Order placed on hold temporarily.', 'class' => $colorCombos['gray'], 'icon' => $icon['times'], 'category' => 'Other', 'position' => 17, 'is_default' => false, 'is_final' => false],
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
