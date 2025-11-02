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
        Schema::create('order_status_histories', function (Blueprint $table) {
            $table->id();

            // Order relationship
            $table->unsignedBigInteger('order_id');
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');

            // Status information
            $table->string('status'); // e.g., 'pending', 'confirmed', 'processing', 'shipped', 'delivered', 'cancelled'
            $table->string('previous_status')->nullable(); // Track previous status for better auditing
            $table->text('notes')->nullable();
            $table->boolean('show_in_frontend')->default(false);

            // Additional status metadata
            $table->json('metadata')->nullable(); // For storing additional data like tracking numbers, reasons, etc.

            // Actor information
            $table->enum('actor_type', ['user', 'admin', 'seller', 'system', 'customer'])->default('user');
            $table->unsignedBigInteger('actor_id')->nullable();

            // Icon + Tailwind classes
            $table->string('class', 255)->nullable();
            $table->text('icon')->nullable();

            // IP address + User agent for security/audit
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();

            $table->softDeletes();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));

            // Indexes
            $table->index('order_id');
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_status_histories');
    }
};
