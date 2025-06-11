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
            $table->boolean('allow_preorder')->default(false);
            $table->boolean('allow_order')->default(false);
            $table->string('availability_message')->nullable();
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
                'allow_preorder' => false,
                'allow_order' => true,
                'availability_message' => 'In Stock',
                'description' => 'Product is available for purchase',
                'title_frontend' => 'Available',
                'description_frontend' => 'This product is ready to ship',
                'position' => 1
            ],
            [
                'title' => 'Draft',
                'slug' => 'draft',
                'allow_preorder' => false,
                'allow_order' => false,
                'availability_message' => 'Coming Soon',
                'description' => 'Product is in draft mode and not visible to customers',
                'title_frontend' => 'Coming Soon',
                'description_frontend' => 'This product will be available soon',
                'position' => 2
            ],
            [
                'title' => 'Unavailable',
                'slug' => 'unavailable',
                'allow_preorder' => false,
                'allow_order' => false,
                'availability_message' => 'Out of Stock',
                'description' => 'Product is temporarily unavailable',
                'title_frontend' => 'Temporarily Unavailable',
                'description_frontend' => 'This product is currently out of stock',
                'position' => 3
            ],
            [
                'title' => 'Archived',
                'slug' => 'archived',
                'allow_preorder' => false,
                'allow_order' => false,
                'availability_message' => 'Discontinued',
                'description' => 'Product is no longer available',
                'title_frontend' => 'Discontinued',
                'description_frontend' => 'This product is no longer available',
                'position' => 4
            ],
            [
                'title' => 'Pending',
                'slug' => 'pending',
                'allow_preorder' => false,
                'allow_order' => false,
                'availability_message' => 'Pending Approval',
                'description' => 'Product is pending approval',
                'title_frontend' => 'Coming Soon',
                'description_frontend' => 'This product is pending approval',
                'position' => 5
            ],
            [
                'title' => 'Limited',
                'slug' => 'limited',
                'allow_preorder' => false,
                'allow_order' => true,
                'availability_message' => 'Limited Stock',
                'description' => 'Product has limited availability',
                'title_frontend' => 'Limited Stock',
                'description_frontend' => 'Hurry! Only a few items left',
                'position' => 6
            ],
            [
                'title' => 'Coming Soon',
                'slug' => 'coming-soon',
                'allow_preorder' => true,
                'allow_order' => false,
                'availability_message' => 'Pre-order Available',
                'description' => 'Product will be available soon',
                'title_frontend' => 'Coming Soon',
                'description_frontend' => 'Pre-order now for early delivery',
                'position' => 7
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
