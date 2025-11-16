<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions
        $permissions = [
            // CORE COMMERCE - starts
            // Dashboard
            'view_dashboard',

            // Users
            'manage_users',

            // Orders
            'manage_orders',

            // Products & related
            'manage_products',
            'manage_categories',
            'manage_collections',
            'manage_features',
            'manage_reviews',
            'manage_variations',
            'manage_coupons',
            'manage_files',

            // Master Data
            'manage_master',
            'manage_countries',
            'manage_states',
            'manage_cities',

            // Website
            'manage_website',
            'manage_banners',
            'manage_advertisements',
            'manage_newsletters',
            'manage_content_pages',
            'manage_social_media',

            // Developer
            'access_developer',
            'manage_trash',

            // Settings
            'manage_settings',
            // CORE COMMERCE - ends

            // ED TECH - starts
            'manage_classes',
            'manage_subjects',
            'manage_schools',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission, 'guard_name' => 'admin']);
        }

        // OPTIONAL: Create only Super Admin role if needed
        // $superAdmin = Role::create(['name' => 'Super Admin', 'guard_name' => 'admin']);
        // $superAdmin->givePermissionTo($permissions);

        // Assign role to admin user
        $adminUser = \App\Models\Admin::first();
        if ($adminUser) {
            // Method 1: Assign all permissions directly
            $adminUser->givePermissionTo($permissions);

            // Method 2: Or create a single role and assign
            // $adminRole = Role::create(['name' => 'Admin', 'guard_name' => 'admin']);
            // $adminRole->givePermissionTo($permissions);
            // $adminUser->assignRole('Admin');
        }
    }
}