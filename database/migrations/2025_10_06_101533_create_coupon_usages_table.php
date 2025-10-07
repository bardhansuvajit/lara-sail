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
        Schema::create('coupon_usages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('coupon_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('order_id')->constrained()->onDelete('cascade');

            $table->decimal('discount_amount', 10, 2);

            // Metadata
            $table->json('coupon_snapshot')->nullable(); // Store coupon details at time of use
            $table->string('ip_address', 45)->nullable();

            $table->softDeletes();
            $table->timestamps();

            $table->unique(['coupon_id', 'order_id']); // Prevent duplicate uses per order
            $table->index(['user_id', 'coupon_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coupon_usages');
    }
};
