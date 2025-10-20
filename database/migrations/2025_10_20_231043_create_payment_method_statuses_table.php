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
            $table->string('slug', 100);
            $table->string('title', 150);
            $table->text('description')->nullable();
            $table->string('class', 255)->nullable(); // tailwind classes
            $table->unsignedSmallInteger('position')->default(1);
            $table->tinyInteger('status')->default(1)->comment('1 active, 0 inactive');

            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });

        $data = [
            ['type' => 'cod','slug' => 'unpaid','title' => 'Unpaid','description' => 'Order placed but awaiting customer payment.','class' => 'bg-gray-100 text-gray-700','position' => 1],
            ['type'=>'cod','slug'=>'customer_payment_complete','title'=>'Payment Complete by Customer','description'=>'Customer marked payment as completed, awaiting verification.','class'=>'bg-blue-100 text-blue-700','position'=>2],
            ['type'=>'cod','slug'=>'customer_payment_incomplete','title'=>'Payment Incomplete by Customer','description'=>'Customer started but did not complete payment.','class'=>'bg-yellow-100 text-yellow-700','position'=>3],
            ['type'=>'cod','slug'=>'customer_payment_received','title'=>'Payment Received','description'=>'Payment successfully received and verified.','class'=>'bg-green-100 text-green-700','position'=>4],
            ['type'=>'cod','slug'=>'customer_payment_not_received','title'=>'Payment Not Received','description'=>'Payment was not received or failed verification.','class'=>'bg-red-100 text-red-700','position'=>5],
            ['type'=>'cod','slug'=>'payment_settled_return_closed','title'=>'Payment Settled — Return Window Closed','description'=>'Payment fully settled and return window has expired.','class'=>'bg-emerald-100 text-emerald-700','position'=>6],
            ['type'=>'cod','slug'=>'payment_failed_full_refund','title'=>'Payment Settlement Failed — Full Refund Issued','description'=>'Settlement failed, full amount refunded to customer.','class'=>'bg-red-100 text-red-700','position'=>7],
            ['type'=>'cod','slug'=>'payment_failed_partial_refund','title'=>'Payment Settlement Failed — Partial Refund Issued','description'=>'Settlement failed, partial amount refunded to customer.','class'=>'bg-orange-100 text-orange-700','position'=>8],

            ['type'=>'prepaid','slug'=>'pending_payment','title'=>'Pending Payment','description'=>'Order placed but payment not yet initiated or confirmed.','class'=>'bg-gray-100 text-gray-700','position'=>1],
            ['type'=>'prepaid','slug'=>'payment_initiated','title'=>'Payment Initiated','description'=>'Customer started the payment process with selected gateway.','class'=>'bg-blue-100 text-blue-700','position'=>2],
            ['type'=>'prepaid','slug'=>'payment_processing','title'=>'Payment Processing','description'=>'Payment is being processed by the payment gateway.','class'=>'bg-yellow-100 text-yellow-700','position'=>3],
            ['type'=>'prepaid','slug'=>'payment_successful','title'=>'Payment Successful','description'=>'Payment completed and verified successfully.','class'=>'bg-green-100 text-green-700','position'=>4],
            ['type'=>'prepaid','slug'=>'payment_failed','title'=>'Payment Failed','description'=>'Payment attempt failed due to gateway or customer issue.','class'=>'bg-red-100 text-red-700','position'=>5],
            ['type'=>'prepaid','slug'=>'payment_captured','title'=>'Payment Captured','description'=>'Payment captured by Payment Gateway.','class'=>'bg-lime-100 text-lime-700','position'=>6],
            ['type'=>'prepaid','slug'=>'payment_refunded_full','title'=>'Payment Refunded (Full)','description'=>'Full payment refunded to the customer.','class'=>'bg-orange-100 text-orange-700','position'=>7],
            ['type'=>'prepaid','slug'=>'payment_refunded_partial','title'=>'Payment Refunded (Partial)','description'=>'Partial payment refunded to the customer.','class'=>'bg-amber-100 text-amber-700','position'=>8],
            ['type'=>'prepaid','slug'=>'payment_disputed','title'=>'Payment Disputed','description'=>'Customer raised a dispute or chargeback on this payment.','class'=>'bg-purple-100 text-purple-700','position'=>9],
            ['type'=>'prepaid','slug'=>'payment_settled_return_closed','title'=>'Payment Settled — Return Window Closed','description'=>'Payment fully settled, return window expired.','class'=>'bg-emerald-100 text-emerald-700','position'=>10],
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
