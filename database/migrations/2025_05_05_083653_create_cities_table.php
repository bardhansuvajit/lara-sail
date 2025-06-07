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
        Schema::create('cities', function (Blueprint $table) {
            $table->id();

            $table->string('country_code', 2);
            $table->string('state_code', 2);

            $table->string('name');
            $table->string('district')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('latitude', 75)->nullable();
            $table->string('longitude', 75)->nullable();

            $table->string('language')->nullable()->comment('comma separated');
            $table->boolean('shipping_availability')->default(1);
            $table->boolean('cash_on_delivery_availability')->default(0);

            $table->tinyInteger('status')->default(1)->comment('1:active, 0: inactive');
            $table->softDeletes();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));

            $table->index(['status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cities');
    }
};
