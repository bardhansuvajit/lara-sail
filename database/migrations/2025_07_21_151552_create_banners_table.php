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
        Schema::create('banners', function (Blueprint $table) {
            $table->id();

            // For web banners
            $table->string('web_image_s_path')->nullable();
            $table->string('web_image_m_path')->nullable();
            $table->string('web_image_l_path')->nullable();
            $table->text('web_redirect_url')->nullable()->comment('URL to redirect when clicked on web');

            // For mobile app banners (React Native)
            $table->string('mobile_image_s_path')->nullable();
            $table->string('mobile_image_m_path')->nullable();
            $table->string('mobile_image_l_path')->nullable();
            $table->string('mobile_redirect_type')->nullable()->comment('Type of mobile redirect (screen/deep-link/url)');
            $table->text('mobile_redirect_target')->nullable()->comment('Target screen or URL for mobile');

            // Common fields
            $table->string('title')->nullable()->comment('Banner title for admin reference');
            $table->text('description')->nullable()->comment('Optional description');

            // Scheduling
            $table->timestamp('start_at')->nullable()->comment('When the banner should start appearing');
            $table->timestamp('end_at')->nullable()->comment('When the banner should stop appearing');

            // Tracking
            $table->integer('click_count')->default(0)->comment('Total clicks');
            $table->integer('impression_count')->default(0)->comment('Total impressions');

            $table->integer('position')->default(1);

            $table->tinyInteger('status')->default(0);
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
        Schema::dropIfExists('banners');
    }
};
