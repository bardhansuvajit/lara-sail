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
        Schema::create('payment_method_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('type', 50)->index(); // e.g. 'cod', 'prepaid', 'wallet'
            $table->string('slug', 100)->unique();
            $table->string('title', 150);
            $table->text('description')->nullable();
            $table->string('class', 255)->nullable();
            $table->text('icon')->nullable();
            $table->string('category', 50)->default('Other')->index();
            $table->unsignedSmallInteger('position')->default(1);
            $table->tinyInteger('status')->default(1)->comment('1 active, 0 inactive');

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
            // COD — Initial
            ['type' => 'cod', 'slug' => 'unpaid', 'title' => 'Unpaid', 'description' => 'Order placed but awaiting customer payment.', 'class' => $colorCombos['gray'], 'icon' => $icon['block'], 'category' => 'Initial', 'position' => 1],

            // COD — Customer Action
            ['type' => 'cod', 'slug' => 'customer_payment_complete', 'title' => 'Payment Complete by Customer', 'description' => 'Customer marked payment as completed, awaiting verification.', 'class' => $colorCombos['green'], 'icon' => $icon['check'], 'category' => 'Customer Action', 'position' => 2],
            ['type' => 'cod', 'slug' => 'customer_payment_incomplete', 'title' => 'Payment Incomplete by Customer', 'description' => 'Customer started but did not complete payment.', 'class' => $colorCombos['red'], 'icon' => $icon['block'], 'category' => 'Customer Action', 'position' => 3],

            // COD — Verification
            ['type' => 'cod', 'slug' => 'customer_payment_received', 'title' => 'Payment Received', 'description' => 'Payment successfully received and verified.', 'class' => $colorCombos['green'], 'icon' => $icon['check'], 'category' => 'Verification', 'position' => 4],
            ['type' => 'cod', 'slug' => 'customer_payment_not_received', 'title' => 'Payment Not Received', 'description' => 'Payment was not received or failed verification.', 'class' => $colorCombos['red'], 'icon' => $icon['block'], 'category' => 'Verification', 'position' => 5],


            // PREPAID — Initial
            ['type' => 'prepaid', 'slug' => 'pending_payment', 'title' => 'Pending Payment', 'description' => 'Order placed but payment not yet initiated or confirmed.', 'class' => $colorCombos['gray'], 'icon' => $icon['check'], 'category' => 'Initial', 'position' => 1],

            // PREPAID — Processing
            ['type' => 'prepaid', 'slug' => 'payment_initiated', 'title' => 'Payment Initiated', 'description' => 'Customer started the payment process with selected gateway.', 'class' => $colorCombos['blue'], 'icon' => $icon['block'], 'category' => 'Processing', 'position' => 2],
            ['type' => 'prepaid', 'slug' => 'payment_processing', 'title' => 'Payment Processing', 'description' => 'Payment is being processed by the payment gateway.', 'class' => $colorCombos['yellow'], 'icon' => $icon['block'], 'category' => 'Processing', 'position' => 3],
            ['type' => 'prepaid', 'slug' => 'payment_process_discontinued', 'title' => 'Payment Process Discontinued', 'description' => 'Payment process was discontinued by the customer.', 'class' => $colorCombos['yellow'], 'icon' => $icon['block'], 'category' => 'Processing', 'position' => 4],

            // PREPAID — Completion
            ['type' => 'prepaid', 'slug' => 'payment_successful', 'title' => 'Payment Successful', 'description' => 'Payment completed and verified successfully.', 'class' => $colorCombos['green'], 'icon' => $icon['check'], 'category' => 'Completion', 'position' => 5],
            ['type' => 'prepaid', 'slug' => 'payment_failed', 'title' => 'Payment Failed', 'description' => 'Payment attempt failed due to gateway or customer issue.', 'class' => $colorCombos['red'], 'icon' => $icon['block'], 'category' => 'Completion', 'position' => 6],
            ['type' => 'prepaid', 'slug' => 'payment_captured', 'title' => 'Payment Captured', 'description' => 'Payment captured by Payment Gateway.', 'class' => $colorCombos['green'], 'icon' => $icon['check'], 'category' => 'Completion', 'position' => 7],


            // ALL — Settlement + Refund
            ['type' => 'all', 'slug' => 'payment_settled_return_closed', 'title' => 'Payment Settled — Return Window Closed', 'description' => 'Payment fully settled and return window has expired.', 'class' => $colorCombos['green-dark'], 'icon' => $icon['check'], 'category' => 'Settlement', 'position' => 8],
            ['type' => 'all', 'slug' => 'payment_failed_full_refund', 'title' => 'Payment Settlement Failed — Full Refund Issued', 'description' => 'Settlement failed, full amount refunded to customer.', 'class' => $colorCombos['red'], 'icon' => $icon['block'], 'category' => 'Refunds', 'position' => 9],
            ['type' => 'all', 'slug' => 'payment_failed_partial_refund', 'title' => 'Payment Settlement Failed — Partial Refund Issued', 'description' => 'Settlement failed, partial amount refunded to customer.', 'class' => $colorCombos['red'], 'icon' => $icon['block'], 'category' => 'Refunds', 'position' => 10],
        ];

        DB::table('payment_method_statuses')->insert($data);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_method_statuses');
    }
};
