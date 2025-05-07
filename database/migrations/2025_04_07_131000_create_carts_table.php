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
        Schema::create('carts', function (Blueprint $table) {
            $table->id();

            // User identification
            $table->string('device_id')->nullable()->index();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            // Currency information
            $table->char('currency_code', 3)->default(FD['failSafeCurrency']);

            // Cart totals
            $table->unsignedInteger('total_items')->default(0);     // SUM(quantity)
            $table->decimal('sub_total', 12, 4)->default(0);        // SUM(price * quantity)
            $table->decimal('total', 12, 4)->default(0);            // sub_total + adjustments

            // Discount information
            $table->unsignedBigInteger('coupon_code_id')->nullable();
            $table->string('coupon_code')->nullable();
            $table->decimal('discount_amount', 12, 4)->default(0);
            $table->string('discount_type', 30)->nullable()->comment('amount/ percent');

            // Shipping
            $table->unsignedBigInteger('shipping_method_id')->nullable();
            $table->decimal('shipping_cost', 12, 4)->default(0);

            // tax
            $table->decimal('tax_amount', 12, 4)->default(0);
            $table->string('tax_type', 30)->nullable()->comment('amount/ percent');
            $table->text('tax_details')->nullable();

            // Abandoned cart tracking
            $table->timestamp('last_activity_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('abandoned_at')->nullable();
            $table->boolean('is_abandoned')->default(0);
            $table->unsignedInteger('reminder_count')->default(0);

            // Conversion tracking
            $table->timestamp('converted_to_order_at')->nullable();
            $table->unsignedBigInteger('order_id')->nullable();

            // status/ timestamp
            $table->tinyInteger('status')->default(1);
            $table->softDeletes();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));

            // Indexes
            $table->index(['user_id', 'device_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};
