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
        Schema::create('ips', function (Blueprint $table) {
            $table->id();

            $table->string('ipv4', 100)->unique();
            $table->string('country_code', 5)->nullable();
            $table->string('state_code', 5)->nullable();
            $table->string('city', 100)->nullable();
            $table->string('zip', 20)->nullable();
            $table->string('currency_code', 5)->nullable();
            $table->text('resp')->nullable();

            $table->tinyInteger('status')->default(1);
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
        Schema::dropIfExists('ips');
    }
};
