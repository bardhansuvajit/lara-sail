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
        Schema::create('product_pricings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id')->nullable();
            $table->foreign('product_id')->references('id')->on('products')->onDelete('SET NULL');

            $table->unsignedBigInteger('country_id')->nullable();
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('SET NULL');
            $table->string('currency_code', 3)->nullable();
            $table->string('currency_symbol', 20)->nullable();

            $table->decimal('selling_price', 12, 2);
            $table->decimal('mrp', 12, 2)->default(0.00);
            $table->tinyInteger('discount')->default(0)->comment('whole number percentage');
            $table->decimal('cost', 12, 2)->default(0.00);
            $table->decimal('profit', 12, 2)->default(0.00);
            $table->decimal('margin', 4, 2)->default(0.00)->comment('whole number percentage');

            $table->tinyInteger('status')->comment('1: active, 0: inactive')->default(1);
            $table->softDeletes();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_pricings');
    }
};
