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
        Schema::create('product_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            // $table->boolean('allow_preorder')->default(false);
            $table->boolean('allow_order')->default(false);
            $table->text('description')->nullable();
            $table->string('title_frontend')->nullable();
            $table->text('description_frontend')->nullable();

            $table->unsignedSmallInteger('position')->default(1);
            $table->tinyInteger('status')->default(1)->comment('1: active, 0: inactive');

            $table->softDeletes();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });

        $data = [
            [
                'title' => 'Active',
                'slug' => 'active',
                'allow_order' => true,
                'description' => 'Product is available for purchase',
                'title_frontend' => 'In Stock',
                'description_frontend' => 'This product is ready to ship',
                'position' => 1
            ],
            [
                'title' => 'Archived',
                'slug' => 'archived',
                'allow_order' => false,
                'description' => 'Product is no longer available',
                'title_frontend' => 'Discontinued',
                'description_frontend' => 'This product is no longer available',
                'position' => 2
            ],
            [
                'title' => 'Coming Soon',
                'slug' => 'coming-soon',
                'allow_order' => false,
                'description' => 'Product will be available soon',
                'title_frontend' => 'Coming Soon',
                'description_frontend' => 'Pre-order now for early delivery',
                'position' => 3
            ],
            [
                'title' => 'Draft',
                'slug' => 'draft',
                'allow_order' => false,
                'description' => 'Product is in draft mode and not visible to customers',
                'title_frontend' => 'Unavailable',
                'description_frontend' => 'This product will be available soon',
                'position' => 4
            ],
            [
                'title' => 'Limited',
                'slug' => 'limited',
                'allow_order' => true,
                'description' => 'Product has limited availability',
                'title_frontend' => 'Limited Stock',
                'description_frontend' => 'Hurry! Only a few items left',
                'position' => 5
            ],
            [
                'title' => 'Out of Stock',
                'slug' => 'out-of-stock',
                'allow_order' => false,
                'description' => 'Product is sold out. Currently out of stock',
                'title_frontend' => 'Out of Stock',
                'description_frontend' => 'This product is currently sold out',
                'position' => 6
            ],
            [
                'title' => 'Pending',
                'slug' => 'pending',
                'allow_order' => false,
                'description' => 'Product is pending approval',
                'title_frontend' => 'Unavailable',
                'description_frontend' => 'This product is pending approval',
                'position' => 7
            ],
            [
                'title' => 'Unavailable',
                'slug' => 'unavailable',
                'allow_order' => false,
                'description' => 'Product is temporarily unavailable',
                'title_frontend' => 'Temporarily Unavailable',
                'description_frontend' => 'This product is currently out of stock',
                'position' => 8
            ],
        ];

        DB::table('product_statuses')->insert($data);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_statuses');
    }
};
