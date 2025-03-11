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
        Schema::create('developer_settings', function (Blueprint $table) {
            $table->id();

            $table->string('category', 100);
            $table->string('key', 200)->unique();
            $table->longText('value');
            $table->text('description');

            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
        });

        $image_validation = json_encode([
            'max_image_size' => '2000',
            'max_image_size_in_kb' => '2000 KB',
            'max_image_size_in_mb' => '2 MB',
            'image_upload_mimes_array' => ['jpg', 'jpeg', 'png', 'webp']
        ]);

        $file_upload = json_encode([
            'store_original_image' => true,
            'resize_image' => true,
            'image_thumbnail_height_array' => [100, 250, 500]
        ]);

        $product_options = json_encode([
            'type' => ['physical product', 'service']
        ]);

        $data = [
            [
                'category' => 'file_upload',
                'key' => 'image_validation',
                'value' => $image_validation,
                'description' => '',
            ],
            [
                'category' => 'file_upload',
                'key' => 'file_upload',
                'value' => $file_upload,
                'description' => '',
            ],
            [
                'category' => 'product',
                'key' => 'product_options',
                'value' => $product_options,
                'description' => '',
            ],
        ];

        DB::table('developer_settings')->insert($data);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('developer_settings');
    }
};
