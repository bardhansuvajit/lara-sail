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
        Schema::create('payment_methods', function (Blueprint $table) {
            $table->id();
            $table->char('country_code', 2);
            $table->string('method', 50); // Payment method key like 'cod', 'prepay', 'card'
            $table->string('title', 100); // Display name
            $table->text('description')->nullable();

            // After Order texts
            $table->text('after_order_title')->nullable();
            $table->text('after_order_description')->nullable();

            // Charge
            $table->string('charge_title', 100);
            $table->decimal('charge_amount', 10, 2)->default(0);
            $table->enum('charge_type', ['fixed', 'percentage'])->default('fixed');

            // Discount
            $table->string('discount_title', 100);
            $table->decimal('discount_amount', 10, 2)->default(0);
            $table->enum('discount_type', ['fixed', 'percentage'])->default('fixed');

            $table->unsignedSmallInteger('position')->default(1);
            $table->tinyInteger('status')->default(1)->comment('1:active, 0: inactive');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));

            // Indexes
            $table->index(['country_code', 'method']);
            $table->index(['country_code', 'status', 'position']);
        });

        /*
        $cash_payment_order_status = json_encode([
            [
                'title' => 'Unpaid',
                'slug' => 'unpaid',
                'description' => 'Order placed but awaiting customer payment.',
                'class' => 'bg-gray-100 text-gray-700'
            ],
            [
                'title' => 'Payment Complete by Customer',
                'slug' => 'customer_payment_complete',
                'description' => 'Customer marked payment as completed, awaiting verification.',
                'class' => 'bg-blue-100 text-blue-700'
            ],
            [
                'title' => 'Payment Incomplete by Customer',
                'slug' => 'customer_payment_incomplete',
                'description' => 'Customer started but did not complete payment.',
                'class' => 'bg-yellow-100 text-yellow-700'
            ],
            [
                'title' => 'Payment Received',
                'slug' => 'customer_payment_received',
                'description' => 'Payment successfully received and verified.',
                'class' => 'bg-green-100 text-green-700'
            ],
            [
                'title' => 'Payment Not Received',
                'slug' => 'customer_payment_not_received',
                'description' => 'Payment was not received or failed verification.',
                'class' => 'bg-red-100 text-red-700'
            ],
            [
                'title' => 'Payment Settled — Return Window Closed',
                'slug' => 'payment_settled_return_closed',
                'description' => 'Payment fully settled and return window has expired.',
                'class' => 'bg-emerald-100 text-emerald-700'
            ],
            [
                'title' => 'Payment Settlement Failed — Full Refund Issued',
                'slug' => 'payment_failed_full_refund',
                'description' => 'Settlement failed, full amount refunded to customer.',
                'class' => 'bg-red-100 text-red-700'
            ],
            [
                'title' => 'Payment Settlement Failed — Partial Refund Issued',
                'slug' => 'payment_failed_partial_refund',
                'description' => 'Settlement failed, partial amount refunded to customer.',
                'class' => 'bg-orange-100 text-orange-700'
            ],
        ]);

        $prepaid_payment_order_status = json_encode([
            [
                'title' => 'Pending Payment',
                'slug' => 'pending_payment',
                'description' => 'Order placed but payment not yet initiated or confirmed.',
                'class' => 'bg-gray-100 text-gray-700'
            ],
            [
                'title' => 'Payment Initiated',
                'slug' => 'payment_initiated',
                'description' => 'Customer started the payment process with selected gateway.',
                'class' => 'bg-blue-100 text-blue-700'
            ],
            [
                'title' => 'Payment Processing',
                'slug' => 'payment_processing',
                'description' => 'Payment is being processed by the payment gateway.',
                'class' => 'bg-yellow-100 text-yellow-700'
            ],
            [
                'title' => 'Payment Successful',
                'slug' => 'payment_successful',
                'description' => 'Payment completed and verified successfully.',
                'class' => 'bg-green-100 text-green-700'
            ],
            [
                'title' => 'Payment Failed',
                'slug' => 'payment_failed',
                'description' => 'Payment attempt failed due to gateway or customer issue.',
                'class' => 'bg-red-100 text-red-700'
            ],
            [
                'title' => 'Payment Captured',
                'slug' => 'payment_captured',
                'description' => 'Payment captured by Payment Gateway.',
                'class' => 'bg-lime-100 text-lime-700'
            ],
            [
                'title' => 'Payment Refunded (Full)',
                'slug' => 'payment_refunded_full',
                'description' => 'Full payment refunded to the customer.',
                'class' => 'bg-orange-100 text-orange-700'
            ],
            [
                'title' => 'Payment Refunded (Partial)',
                'slug' => 'payment_refunded_partial',
                'description' => 'Partial payment refunded to the customer.',
                'class' => 'bg-amber-100 text-amber-700'
            ],
            [
                'title' => 'Payment Disputed',
                'slug' => 'payment_disputed',
                'description' => 'Customer raised a dispute or chargeback on this payment.',
                'class' => 'bg-purple-100 text-purple-700'
            ],
            [
                'title' => 'Payment Settled — Return Window Closed',
                'slug' => 'payment_settled_return_closed',
                'description' => 'Payment fully settled, return window expired.',
                'class' => 'bg-emerald-100 text-emerald-700'
            ],
        ]);
        */

        $data = [
            [
                'country_code' => 'IN',
                'method' => 'cod',
                'title' => 'Pay on Delivery',
                'description' => 'Pay when you receive your order',

                'after_order_title' => 'Get Ready to Pay When It Arrives.',
                'after_order_description' => 'You&apos;ve chosen to pay on delivery—please ensure the payment is available when your package arrives. Need help? We&apos;re just a message away.',

                'charge_title' => 'COD Handling Fee',
                'charge_amount' => 99.99,
                'charge_type' => 'fixed',
                'discount_title' => 'No Discount',
                'discount_amount' => 0,
                'discount_type' => 'fixed',
                'position' => 1,
                'status' => 1
            ],
            [
                'country_code' => 'IN',
                'method' => 'prepaid',
                'title' => 'Online Payment',
                'description' => 'Pay securely using UPI, cards, or wallets',

                'after_order_title' => 'We&apos;re processing your order and will update you shortly.',
                'after_order_description' => 'Thank you for shopping with us. You can view your invoice and track your order from your account.',

                'charge_title' => 'No Fee',
                'charge_amount' => 0,
                'charge_type' => 'fixed',
                'discount_title' => 'UPI Discount',
                'discount_amount' => 2.5,
                'discount_type' => 'percentage',
                'position' => 2,
                'status' => 1
            ],
            [
                'country_code' => 'US',
                'method' => 'card',
                'title' => 'Credit Card',
                'description' => 'Visa, Mastercard, American Express',

                'after_order_title' => 'Everything looks good. Just sit tight while we get your items ready.',
                'after_order_description' => 'You&apos;ve chosen to pay on delivery—please ensure the payment is available when your package arrives. Need help? We&apos;re just a message away.',

                'charge_title' => 'Processing Fee',
                'charge_amount' => 2.9,
                'charge_type' => 'percentage',
                'discount_title' => 'No Discount',
                'discount_amount' => 0,
                'discount_type' => 'fixed',
                'position' => 1,
                'status' => 1
            ],
            [
                'country_code' => 'US',
                'method' => 'paypal',
                'title' => 'PayPal',
                'description' => 'Secure PayPal payment',

                'after_order_title' => 'Your transaction is complete and your order is being prepared.',
                'after_order_description' => 'Thank you for shopping with us. You can view your invoice and track your order from your account.',

                'charge_title' => 'Service Fee',
                'charge_amount' => 1.5,
                'charge_type' => 'percentage',
                'discount_title' => 'PayPal Cashback',
                'discount_amount' => 2,
                'discount_type' => 'percentage',
                'position' => 2,
                'status' => 1
            ]
        ];

        DB::table('payment_methods')->insert($data);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_methods');
    }
};
