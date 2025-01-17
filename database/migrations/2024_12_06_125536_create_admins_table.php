<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('phone_country_code', 20);
            $table->string('phone_no')->unique();
            $table->unsignedBigInteger('gender_id')->default(1);
            $table->timestamp('email_verified_at')->nullable();

            $table->string('username');
            $table->string('password');

            $table->string('profile_picture_s')->nullable();
            $table->string('profile_picture_m')->nullable();
            $table->string('profile_picture_l')->nullable();

            $table->string('alt_phone_country_code', 20)->nullable();
            $table->string('alt_phone_no')->unique()->nullable();

            $table->rememberToken();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
        });

        $data = [
            'first_name'            => 'Test',
            'last_name'             => 'Test',
            'email'                 => 'admin@admin.com',
            'phone_country_code'    => '+91',
            'phone_no'              => '9876543210',
            'username'              => 'admin@admin.com',
            'password'              => Hash::make('secret'),
            'profile_picture_s'     => 'default/skeleton/default-male.png',
            'profile_picture_m'     => 'default/skeleton/default-male.png',
            'profile_picture_l'     => 'default/skeleton/default-male.png',
        ];

        DB::table('admins')->insert($data);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admins');
    }
};
