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
        Schema::create('product_files', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('product_id')->nullable();
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');

            $table->text('file_path')->nullable();
            $table->text('file_size')->nullable();
            $table->text('file_name')->nullable();
            $table->text('file_type')->nullable();

            // Additions:
            $table->string('original_name')->nullable(); // Original upload name
            $table->string('mime_type')->nullable(); // More specific than file_type
            $table->string('disk')->default('public'); // Storage disk used
            $table->string('extension')->nullable(); // File extension

            // For organization and ordering:
            $table->integer('sort_order')->default(0); // For ordering files
            $table->boolean('is_active')->default(true); // To soft delete/hide files

            $table->text('description')->nullable(); // File description
            $table->integer('download_count')->default(0); // Usage tracking

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_files');
    }
};
