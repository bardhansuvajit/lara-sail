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
            $table->boolean('notify_by_email')->default(false);
            $table->boolean('show_in_frontend')->default(true);

            $table->text('icon');
            $table->string('bg_tailwind_classes');
            $table->string('title_frontend');
            $table->string('title_tailwind_classes');
            $table->text('description_frontend');
            $table->string('description_tailwind_classes');

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
                'notify_by_email' => false,
                'show_in_frontend' => true,
                'icon' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>',
                'title_frontend' => 'In Stock',
                'description_frontend' => 'This product is ready to ship',
                'bg_tailwind_classes' => 'bg-green-100 dark:bg-green-900',
                'title_tailwind_classes' => 'text-green-700 dark:text-green-400 font-semibold',
                'description_tailwind_classes' => 'text-green-600 dark:text-green-300',
                'position' => 1
            ],
            [
                'title' => 'Archived',
                'slug' => 'archived',
                'allow_order' => false,
                'notify_by_email' => false,
                'show_in_frontend' => true,
                'icon' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2M3 12l6.414 6.414a2 2 0 001.414.586H19a2 2 0 002-2V7a2 2 0 00-2-2h-8.172a2 2 0 00-1.414.586L3 12z" /></svg>',
                'title_frontend' => 'Discontinued',
                'description_frontend' => 'This product is no longer available',
                'bg_tailwind_classes' => 'bg-gray-100 dark:bg-gray-800',
                'title_tailwind_classes' => 'text-gray-700 dark:text-gray-300 font-semibold',
                'description_tailwind_classes' => 'text-gray-500 dark:text-gray-400',
                'position' => 2
            ],
            [
                'title' => 'Coming Soon',
                'slug' => 'coming-soon',
                'allow_order' => false,
                'notify_by_email' => true,
                'show_in_frontend' => true,
                'icon' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>',
                'title_frontend' => 'Coming Soon',
                'description_frontend' => 'Pre-order now for early delivery',
                'bg_tailwind_classes' => 'bg-blue-100 dark:bg-blue-900',
                'title_tailwind_classes' => 'text-blue-700 dark:text-blue-400 font-semibold',
                'description_tailwind_classes' => 'text-blue-600 dark:text-blue-300',
                'position' => 3
            ],
            [
                'title' => 'Draft',
                'slug' => 'draft',
                'allow_order' => false,
                'notify_by_email' => false,
                'show_in_frontend' => false,
                'icon' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>',
                'title_frontend' => 'Unavailable',
                'description_frontend' => 'This product will be available soon',
                'bg_tailwind_classes' => 'bg-yellow-100 dark:bg-yellow-900',
                'title_tailwind_classes' => 'text-yellow-700 dark:text-yellow-400 font-semibold',
                'description_tailwind_classes' => 'text-yellow-600 dark:text-yellow-300',
                'position' => 4
            ],
            [
                'title' => 'Limited',
                'slug' => 'limited',
                'allow_order' => true,
                'notify_by_email' => false,
                'show_in_frontend' => true,
                'icon' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4a2 2 0 00-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>',
                'title_frontend' => 'Limited Stock',
                'description_frontend' => 'Hurry! Only a few items left',
                'bg_tailwind_classes' => 'bg-orange-100 dark:bg-orange-900',
                'title_tailwind_classes' => 'text-orange-700 dark:text-orange-400 font-semibold',
                'description_tailwind_classes' => 'text-orange-600 dark:text-orange-300',
                'position' => 5
            ],
            [
                'title' => 'Out of Stock',
                'slug' => 'out-of-stock',
                'allow_order' => false,
                'notify_by_email' => true,
                'show_in_frontend' => true,
                'icon' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>',
                'title_frontend' => 'Out of Stock',
                'description_frontend' => 'This product is currently sold out',
                'bg_tailwind_classes' => 'bg-red-100 dark:bg-red-900',
                'title_tailwind_classes' => 'text-red-700 dark:text-red-400 font-semibold',
                'description_tailwind_classes' => 'text-red-600 dark:text-red-300',
                'position' => 6
            ],
            [
                'title' => 'Pending',
                'slug' => 'pending',
                'allow_order' => false,
                'notify_by_email' => false,
                'show_in_frontend' => false,
                'icon' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>',
                'title_frontend' => 'Unavailable',
                'description_frontend' => 'This product is pending approval',
                'bg_tailwind_classes' => 'bg-purple-100 dark:bg-purple-900',
                'title_tailwind_classes' => 'text-purple-700 dark:text-purple-400 font-semibold',
                'description_tailwind_classes' => 'text-purple-600 dark:text-purple-300',
                'position' => 7
            ],
            [
                'title' => 'Unavailable',
                'slug' => 'unavailable',
                'allow_order' => false,
                'notify_by_email' => true,
                'show_in_frontend' => true,
                'icon' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>',
                'title_frontend' => 'Temporarily Unavailable',
                'description_frontend' => 'This product is currently out of stock',
                'bg_tailwind_classes' => 'bg-gray-200 dark:bg-gray-700',
                'title_tailwind_classes' => 'text-gray-800 dark:text-gray-200 font-semibold',
                'description_tailwind_classes' => 'text-gray-600 dark:text-gray-400',
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
