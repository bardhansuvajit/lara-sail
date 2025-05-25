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

        $data = [
            [
                'country_code' => 'IN',
                'method' => 'cod',
                'title' => 'Pay on Delivery',
                'description' => 'Pay when you receive your order',
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
