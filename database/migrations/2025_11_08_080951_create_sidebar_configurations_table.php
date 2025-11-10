<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sidebar_configurations', function (Blueprint $table) {
            $table->id();
            $table->string('company_category_key');
            $table->json('sidebar_items');
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->unique('company_category_key');
        });

        $configurations = [
            [
                'company_category_key' => 'core-commerce',
                'sidebar_items' => json_encode($this->getCoreCommerceSidebar()),
                'is_active' => true
            ],
            [
                'company_category_key' => 'travel',
                'sidebar_items' => json_encode($this->getTravelSidebar()),
                'is_active' => true
            ],
            [
                'company_category_key' => 'entertainment',
                'sidebar_items' => json_encode($this->getEntertainmentSidebar()),
                'is_active' => true
            ],
            [
                'company_category_key' => 'food-beverage',
                'sidebar_items' => json_encode($this->getEntertainmentSidebar()),
                'is_active' => true
            ],
            [
                'company_category_key' => 'fin-tech',
                'sidebar_items' => json_encode($this->getEntertainmentSidebar()),
                'is_active' => true
            ],
            [
                'company_category_key' => 'ed-tech',
                'sidebar_items' => json_encode($this->getEdTechSidebar()),
                'is_active' => true
            ],
            [
                'company_category_key' => 'health-wellness',
                'sidebar_items' => json_encode($this->getEntertainmentSidebar()),
                'is_active' => true
            ],
            [
                'company_category_key' => 'special',
                'sidebar_items' => json_encode($this->getEntertainmentSidebar()),
                'is_active' => true
            ]
        ];

        DB::table('sidebar_configurations')->insert($configurations);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sidebar_configurations');
    }

    /**
     * private functions to insert into database
     */
    private function getCoreCommerceSidebar()
    {
        return [
            [
                'type' => 'single',
                'title' => 'Dashboard',
                'route' => 'admin.dashboard.index',
                'icon' => 'dashboard',
                'permission' => 'view_dashboard'
            ],
            [
                'type' => 'single',
                'title' => 'Users',
                'route' => 'admin.user.index',
                'icon' => 'users',
                'permission' => 'manage_users'
            ],
            [
                'type' => 'single',
                'title' => 'Orders',
                'route' => 'admin.order.index',
                'icon' => 'orders',
                'permission' => 'manage_orders'
            ],
            [
                'type' => 'dropdown',
                'title' => 'Products',
                'icon' => 'products',
                'permission' => 'manage_products',
                'children' => [
                    [
                        'title' => 'Listings',
                        'route' => 'admin.product.listing.index',
                        'icon' => 'listings',
                        'permission' => 'manage_products'
                    ],
                    [
                        'title' => 'Category',
                        'route' => 'admin.product.category.index',
                        'icon' => 'category',
                        'permission' => 'manage_categories'
                    ],
                    [
                        'title' => 'Collection',
                        'route' => 'admin.product.collection.index',
                        'icon' => 'collection',
                        'permission' => 'manage_collections'
                    ],
                    [
                        'title' => 'Feature',
                        'route' => 'admin.product.feature.index',
                        'icon' => 'feature',
                        'permission' => 'manage_features'
                    ],
                    [
                        'title' => 'Review',
                        'route' => 'admin.product.review.index',
                        'icon' => 'review',
                        'permission' => 'manage_reviews'
                    ],
                    [
                        'title' => 'Variation',
                        'route' => 'admin.product.variation.attribute.index',
                        'icon' => 'variation',
                        'permission' => 'manage_variations'
                    ],
                    [
                        'title' => 'Coupon',
                        'route' => 'admin.product.coupon.index',
                        'icon' => 'coupon',
                        'permission' => 'manage_coupons'
                    ]
                ]
            ],
            [
                'type' => 'dropdown',
                'title' => 'Master',
                'icon' => 'master',
                'permission' => 'manage_master',
                'children' => [
                    [
                        'title' => 'Country',
                        'route' => 'admin.master.country.index',
                        'icon' => 'country',
                        'permission' => 'manage_countries'
                    ],
                    [
                        'title' => 'State',
                        'route' => 'admin.master.state.index',
                        'icon' => 'state',
                        'permission' => 'manage_states'
                    ],
                    [
                        'title' => 'City',
                        'route' => 'admin.master.city.index',
                        'icon' => 'city',
                        'permission' => 'manage_cities'
                    ]
                ]
            ],
            [
                'type' => 'dropdown',
                'title' => 'Website',
                'icon' => 'website',
                'permission' => 'manage_website',
                'children' => [
                    [
                        'title' => 'Banner',
                        'route' => 'admin.website.banner.index',
                        'icon' => 'banner',
                        'permission' => 'manage_banners'
                    ],
                    [
                        'title' => 'Advertisement',
                        'route' => 'admin.website.advertisement.index',
                        'params' => 'homepage',
                        'icon' => 'advertisement',
                        'permission' => 'manage_advertisements'
                    ],
                    [
                        'title' => 'Newsletter Email',
                        'route' => 'admin.website.newsletter.email.index',
                        'icon' => 'newsletter',
                        'permission' => 'manage_newsletters'
                    ],
                    [
                        'title' => 'Content Page',
                        'route' => 'admin.website.content.page.index',
                        'icon' => 'content',
                        'permission' => 'manage_content_pages'
                    ],
                    [
                        'title' => 'Social Media',
                        'route' => 'admin.website.social.media.index',
                        'icon' => 'social',
                        'permission' => 'manage_social_media'
                    ]
                ]
            ],
            // [
            //     'type' => 'dropdown',
            //     'title' => 'Role & Permission',
            //     'icon' => 'shield-toggle',
            //     'permission' => 'manage_roles',
            //     'children' => [
            //         [
            //             'title' => 'Roles',
            //             'route' => 'admin.roles.index',
            //             'icon' => 'passkey',
            //             'permission' => 'manage_roles'
            //         ],
            //         [
            //             'title' => 'Permissions',
            //             'route' => 'admin.permissions.index',
            //             'icon' => 'shield-check',
            //             'permission' => 'manage_permissions'
            //         ],
            //         [
            //             'title' => 'User Roles',
            //             'route' => 'admin.user.roles.index',
            //             'icon' => 'users-gear',
            //             'permission' => 'assign_roles'
            //         ]
            //     ]
            // ],
            [
                'type' => 'dropdown',
                'title' => 'Developer options',
                'icon' => 'developer',
                'permission' => 'access_developer',
                'children' => [
                    [
                        'title' => 'Trash',
                        'route' => 'admin.developer.trash.index',
                        'icon' => 'trash',
                        'permission' => 'manage_trash'
                    ],
                    [
                        'title' => 'Settings',
                        'route' => 'admin.application.settings.index',
                        'params' => 'basic',
                        'icon' => 'settings',
                        'permission' => 'manage_settings'
                    ]
                ]
            ]
        ];
    }

    private function getTravelSidebar()
    {
        return [
            [
                'type' => 'single',
                'title' => 'Dashboard',
                'route' => 'admin.dashboard.index',
                'icon' => 'dashboard',
                'permission' => 'view_dashboard'
            ],
            [
                'type' => 'single',
                'title' => 'Leads',
                'route' => 'admin.user.index',
                'icon' => 'users',
                'permission' => 'manage_users'
            ],
            [
                'type' => 'single',
                'title' => 'Bookings',
                'route' => 'admin.order.index',
                'icon' => 'orders',
                'permission' => 'manage_orders'
            ],
            [
                'type' => 'dropdown',
                'title' => 'Master',
                'icon' => 'master',
                'permission' => 'manage_master',
                'children' => [
                    [
                        'title' => 'Country',
                        'route' => 'admin.master.country.index',
                        'icon' => 'country',
                        'permission' => 'manage_countries'
                    ],
                    [
                        'title' => 'State',
                        'route' => 'admin.master.state.index',
                        'icon' => 'state',
                        'permission' => 'manage_states'
                    ],
                    [
                        'title' => 'City',
                        'route' => 'admin.master.city.index',
                        'icon' => 'city',
                        'permission' => 'manage_cities'
                    ]
                ]
            ],
            [
                'type' => 'dropdown',
                'title' => 'Website',
                'icon' => 'website',
                'permission' => 'manage_website',
                'children' => [
                    [
                        'title' => 'Banner',
                        'route' => 'admin.website.banner.index',
                        'icon' => 'banner',
                        'permission' => 'manage_banners'
                    ],
                    [
                        'title' => 'Advertisement',
                        'route' => 'admin.website.advertisement.index',
                        'params' => 'homepage',
                        'icon' => 'advertisement',
                        'permission' => 'manage_advertisements'
                    ],
                    [
                        'title' => 'Newsletter Email',
                        'route' => 'admin.website.newsletter.email.index',
                        'icon' => 'newsletter',
                        'permission' => 'manage_newsletters'
                    ],
                    [
                        'title' => 'Content Page',
                        'route' => 'admin.website.content.page.index',
                        'icon' => 'content',
                        'permission' => 'manage_content_pages'
                    ],
                    [
                        'title' => 'Social Media',
                        'route' => 'admin.website.social.media.index',
                        'icon' => 'social',
                        'permission' => 'manage_social_media'
                    ]
                ]
            ],
            [
                'type' => 'dropdown',
                'title' => 'Developer options',
                'icon' => 'developer',
                'permission' => 'access_developer',
                'children' => [
                    [
                        'title' => 'Trash',
                        'route' => 'admin.developer.trash.index',
                        'icon' => 'trash',
                        'permission' => 'manage_trash'
                    ],
                    [
                        'title' => 'Settings',
                        'route' => 'admin.application.settings.index',
                        'params' => 'basic',
                        'icon' => 'settings',
                        'permission' => 'manage_settings'
                    ]
                ]
            ]
        ];
    }

    private function getEntertainmentSidebar()
    {
        return [
            [
                'type' => 'single',
                'title' => 'Dashboard',
                'route' => 'admin.dashboard.index',
                'icon' => 'dashboard',
                'permission' => 'view_dashboard'
            ],
            [
                'type' => 'single',
                'title' => 'Attendees',
                'route' => 'admin.user.index',
                'icon' => 'users',
                'permission' => 'manage_users'
            ],
            [
                'type' => 'single',
                'title' => 'Ticket Sales',
                'route' => 'admin.ticket.sales.index',
                'icon' => 'orders',
                'permission' => 'manage_ticket_sales'
            ],
            [
                'type' => 'dropdown',
                'title' => 'Events',
                'icon' => 'events',
                'permission' => 'manage_events',
                'children' => [
                    [
                        'title' => 'Event Management',
                        'route' => 'admin.events.index',
                        'icon' => 'listings',
                        'permission' => 'manage_events'
                    ],
                    [
                        'title' => 'Venues',
                        'route' => 'admin.venues.index',
                        'icon' => 'category',
                        'permission' => 'manage_venues'
                    ],
                    [
                        'title' => 'Ticket Types',
                        'route' => 'admin.ticket.types.index',
                        'icon' => 'coupon',
                        'permission' => 'manage_ticket_types'
                    ]
                ]
            ],
        ];
    }

    private function getEdTechSidebar()
    {
        return [
            [
                'type' => 'single',
                'title' => 'Dashboard',
                'route' => 'admin.dashboard.index',
                'icon' => 'dashboard',
                'permission' => 'view_dashboard'
            ],
            [
                'type' => 'single',
                'title' => 'Users',
                'route' => 'admin.user.index',
                'icon' => 'users',
                'permission' => 'manage_users'
            ],
            [
                'type' => 'single',
                'title' => 'Orders',
                'route' => 'admin.order.index',
                'icon' => 'orders',
                'permission' => 'manage_orders'
            ],
            [
                'type' => 'dropdown',
                'title' => 'Study Material',
                'icon' => 'products',
                'permission' => 'manage_products',
                'children' => [
                    [
                        'title' => 'Listings',
                        'route' => 'admin.product.listing.index',
                        'icon' => 'listings',
                        'permission' => 'manage_products'
                    ],
                    [
                        'title' => 'Category',
                        'route' => 'admin.product.category.index',
                        'icon' => 'category',
                        'permission' => 'manage_categories'
                    ],
                    [
                        'title' => 'Collection',
                        'route' => 'admin.product.collection.index',
                        'icon' => 'collection',
                        'permission' => 'manage_collections'
                    ],
                    [
                        'title' => 'Feature',
                        'route' => 'admin.product.feature.index',
                        'icon' => 'feature',
                        'permission' => 'manage_features'
                    ],
                    [
                        'title' => 'Review',
                        'route' => 'admin.product.review.index',
                        'icon' => 'review',
                        'permission' => 'manage_reviews'
                    ],
                    [
                        'title' => 'Variation',
                        'route' => 'admin.product.variation.attribute.index',
                        'icon' => 'variation',
                        'permission' => 'manage_variations'
                    ],
                    [
                        'title' => 'Coupon',
                        'route' => 'admin.product.coupon.index',
                        'icon' => 'coupon',
                        'permission' => 'manage_coupons'
                    ]
                ]
            ],
            [
                'type' => 'dropdown',
                'title' => 'Master',
                'icon' => 'master',
                'permission' => 'manage_master',
                'children' => [
                    [
                        'title' => 'Class',
                        'route' => 'admin.school.class.index',
                        'icon' => 'class',
                        'permission' => 'manage_classes'
                    ],
                    [
                        'title' => 'Subject',
                        'route' => 'admin.school.subject.index',
                        'icon' => 'subject',
                        'permission' => 'manage_subjects'
                    ],
                    [
                        'title' => 'School',
                        'route' => 'admin.school.listing.index',
                        'icon' => 'school',
                        'permission' => 'manage_schools'
                    ],
                    [
                        'title' => 'Country',
                        'route' => 'admin.master.country.index',
                        'icon' => 'country',
                        'permission' => 'manage_countries'
                    ],
                    [
                        'title' => 'State',
                        'route' => 'admin.master.state.index',
                        'icon' => 'state',
                        'permission' => 'manage_states'
                    ],
                    [
                        'title' => 'City',
                        'route' => 'admin.master.city.index',
                        'icon' => 'city',
                        'permission' => 'manage_cities'
                    ]
                ]
            ],
            [
                'type' => 'dropdown',
                'title' => 'Website',
                'icon' => 'website',
                'permission' => 'manage_website',
                'children' => [
                    [
                        'title' => 'Banner',
                        'route' => 'admin.website.banner.index',
                        'icon' => 'banner',
                        'permission' => 'manage_banners'
                    ],
                    [
                        'title' => 'Advertisement',
                        'route' => 'admin.website.advertisement.index',
                        'params' => 'homepage',
                        'icon' => 'advertisement',
                        'permission' => 'manage_advertisements'
                    ],
                    [
                        'title' => 'Newsletter Email',
                        'route' => 'admin.website.newsletter.email.index',
                        'icon' => 'newsletter',
                        'permission' => 'manage_newsletters'
                    ],
                    [
                        'title' => 'Content Page',
                        'route' => 'admin.website.content.page.index',
                        'icon' => 'content',
                        'permission' => 'manage_content_pages'
                    ],
                    [
                        'title' => 'Social Media',
                        'route' => 'admin.website.social.media.index',
                        'icon' => 'social',
                        'permission' => 'manage_social_media'
                    ]
                ]
            ],
            // [
            //     'type' => 'dropdown',
            //     'title' => 'Role & Permission',
            //     'icon' => 'shield-toggle',
            //     'permission' => 'manage_roles',
            //     'children' => [
            //         [
            //             'title' => 'Roles',
            //             'route' => 'admin.roles.index',
            //             'icon' => 'passkey',
            //             'permission' => 'manage_roles'
            //         ],
            //         [
            //             'title' => 'Permissions',
            //             'route' => 'admin.permissions.index',
            //             'icon' => 'shield-check',
            //             'permission' => 'manage_permissions'
            //         ],
            //         [
            //             'title' => 'User Roles',
            //             'route' => 'admin.user.roles.index',
            //             'icon' => 'users-gear',
            //             'permission' => 'assign_roles'
            //         ]
            //     ]
            // ],
            [
                'type' => 'dropdown',
                'title' => 'Developer options',
                'icon' => 'developer',
                'permission' => 'access_developer',
                'children' => [
                    [
                        'title' => 'Trash',
                        'route' => 'admin.developer.trash.index',
                        'icon' => 'trash',
                        'permission' => 'manage_trash'
                    ],
                    [
                        'title' => 'Settings',
                        'route' => 'admin.application.settings.index',
                        'params' => 'basic',
                        'icon' => 'settings',
                        'permission' => 'manage_settings'
                    ]
                ]
            ]
        ];
    }
};