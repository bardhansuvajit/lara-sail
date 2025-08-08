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
        Schema::create('content_pages', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('title');
            $table->longText('content')->nullable();
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->json('sections')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        $data = [
            ['slug' => 'support', 'title' => 'Support'],
            ['slug' => 'terms-and-conditions', 'title' => 'Terms and Conditions'],
            ['slug' => 'privacy-policy', 'title' => 'Privacy Policy'],
            ['slug' => 'return-policy', 'title' => 'Return Policy'],
            ['slug' => 'refund-policy', 'title' => 'Refund Policy'],
        ];

        DB::table('content_pages')->insert($data);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('content_pages');
    }
};
