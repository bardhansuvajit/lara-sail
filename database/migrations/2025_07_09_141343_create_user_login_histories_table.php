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
        Schema::create('user_login_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('token', 64)->unique()->index();
            $table->enum('platform', ['ios', 'android', 'web', 'mobile_web', 'tablet'])->default('web');
            $table->string('device_type', 100)->nullable(); // smartphone, tablet, desktop, etc.
            $table->string('device_brand', 100)->nullable();
            $table->string('device_model', 100)->nullable();
            $table->string('os_name', 50)->nullable(); // Windows, iOS, Android, etc.
            $table->string('os_version', 50)->nullable();
            $table->string('app_version', 50)->nullable();
            $table->string('browser', 100)->nullable(); // Chrome, Safari, etc.
            $table->string('browser_version', 50)->nullable();
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            $table->string('ip_address', 45)->nullable();
            $table->string('city')->nullable();
            $table->string('country')->nullable();
            $table->boolean('is_active')->default(true);
            $table->json('user_agent')->nullable();
            $table->json('payload')->nullable();
            $table->timestamp('login_at')->useCurrent();
            $table->timestamp('last_activity_at')->useCurrent();
            $table->timestamp('expires_at')->nullable();
            $table->enum('logout_reason', ['user', 'timeout', 'system', 'security', 'multiple_login', 'user_manual', 'user_manual_all'])->nullable();
            $table->timestamp('logout_at')->nullable();

            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));

            $table->index(['user_id', 'is_active']);
            $table->index(['platform', 'login_at']);
            $table->index('last_activity_at');


            /*
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('token', 64)->unique()->index();
            $table->enum('platform', ['ios', 'android', 'web'])->default('web');
            $table->string('device_brand', 100)->nullable();
            $table->string('os_version', 50)->nullable();
            $table->string('device_model', 100)->nullable();
            $table->string('app_version', 50)->nullable();
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            $table->string('ip_address', 45)->nullable();
            $table->boolean('is_active')->default(true);

            $table->json('payload')->nullable();

            $table->timestamp('login_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('last_activity_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('expires_at')->nullable();
            $table->string('logout_reason', 100)->nullable();

            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));

            $table->index(['user_id', 'is_active']);
            */
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_login_histories');
    }
};
