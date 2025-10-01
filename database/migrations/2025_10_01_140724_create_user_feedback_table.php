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
        Schema::create('user_feedback', function (Blueprint $table) {
            $table->id();
            $table->string('category')->default('basic_feedback')->comment('Feedback Category');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->nullable()->index();
            $table->string('country_code', 2)->default(FAILSAFE['country']);
            $table->string('primary_phone_no')->nullable()->index();

            $table->text('message')->nullable();
            $table->text('page')->nullable();

            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable()->comment('User browser info');

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_feedback');
    }
};
