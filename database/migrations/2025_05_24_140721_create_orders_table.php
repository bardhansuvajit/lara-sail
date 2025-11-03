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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            // Order identification
            $table->string('order_number')->unique();

            // Customer information
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->string('device_id')->nullable()->index();
            $table->string('email')->nullable();
            $table->string('phone_no');

            // Currency information
            $table->string('country_code', 2)->default(FAILSAFE['country']);
            $table->char('currency_code', 3)->default(FAILSAFE['currency_code']);
            $table->string('currency_symbol', 20)->default(FAILSAFE['currency_icon']);

            // Order totals
            $table->unsignedInteger('total_items');
            $table->decimal('mrp', 12, 2);
            $table->decimal('sub_total', 12, 2);
            $table->decimal('total', 12, 2);

            // Discount information
            $table->unsignedBigInteger('coupon_code_id')->nullable();
            $table->string('coupon_code')->nullable();
            $table->decimal('coupon_discount_amount', 12, 2)->default(0);
            $table->json('coupon_meta')->nullable();

            // Shipping information
            $table->unsignedBigInteger('shipping_method_id')->nullable();
            $table->string('shipping_method_name')->nullable();
            $table->decimal('shipping_cost', 12, 2);
            $table->text('shipping_address')->nullable();

            // Billing information
            $table->text('billing_address')->nullable();
            $table->boolean('same_as_shipping')->default(true);

            // Tax information
            $table->decimal('tax_amount', 12, 2)->default(0);
            $table->string('tax_type', 30)->nullable();
            $table->text('tax_details')->nullable();

            // Payment information
            $table->integer('payment_method_id')->nullable();
            $table->string('payment_method', 15)->nullable();
            $table->string('payment_method_desc', 20)->nullable();
            $table->decimal('payment_method_charge', 12, 2)->default(0);
            $table->decimal('payment_method_discount', 12, 2)->default(0);
            $table->string('payment_status')->default('pending');
            $table->string('transaction_id')->nullable();
            $table->text('payment_details')->nullable();

            // Order status
            $table->string('status')->default('pending');
            $table->text('status_notes')->nullable();

            // Tracking
            $table->timestamp('paid_at')->nullable();
            $table->timestamp('processed_at')->nullable();
            $table->timestamp('shipped_at')->nullable();
            $table->timestamp('delivered_at')->nullable();
            $table->timestamp('cancelled_at')->nullable();
            $table->text('cancellation_reason')->nullable();

            // Metadata
            $table->text('notes')->nullable();
            $table->text('custom_fields')->nullable();
            $table->json('cart_meta')->nullable();

            // Timestamps
            $table->softDeletes();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));

            // Indexes
            $table->index(['user_id', 'device_id']);
            $table->index('order_number');
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
