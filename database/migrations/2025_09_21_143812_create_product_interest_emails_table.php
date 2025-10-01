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
        Schema::create('product_interest_emails', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('products')->cascadeOnDelete();
            $table->foreignId('product_variation_id')->nullable()->constrained('product_variations')->cascadeOnDelete();
            $table->string('email', 80);
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable()->comment('User browser info');
            $table->timestamp('subscribed_at')->useCurrent();
            $table->timestamp('unsubscribed_at')->nullable();
            $table->tinyInteger('subscription_count')->default(1);
            $table->string('unsubscribe_token', 64)->nullable()->unique()->comment('For unsubscribe links');
            $table->string('source')->nullable()->comment('Where the subscription came from');
            $table->json('meta')->nullable()->comment('Additional metadata');

            $table->timestamps();
            $table->softDeletes();

            $table->index('email');
            $table->index('subscribed_at');
            // $table->unique(['product_id', 'product_variation_id', 'email']);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_interest_emails');
    }
};
