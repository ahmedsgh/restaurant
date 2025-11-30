<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Define all permissions grouped by module
        $permissions = [
            // Dashboard/Statistics
            'view_dashboard',
            'view_statistics',
            
            // Categories
            'view_categories',
            'create_categories',
            'edit_categories',
            'delete_categories',
            
            // Products
            'view_products',
            'create_products',
            'edit_products',
            'delete_products',
            
            // Orders
            'view_orders',
            'create_orders',
            'edit_orders',
            'delete_orders',
            'update_order_status',
            
            // Reservations
            'view_reservations',
            'create_reservations',
            'edit_reservations',
            'delete_reservations',
            'update_reservation_status',
            
            // Users
            'view_users',
            'create_users',
            'edit_users',
            'delete_users',
            
            // Roles & Permissions
            'view_roles',
            'create_roles',
            'edit_roles',
            'delete_roles',
            'assign_permissions',
        ];

        // Create permissions
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Create Super Admin role with all permissions
        $superAdmin = Role::firstOrCreate(['name' => 'Super Admin']);
        $superAdmin->givePermissionTo(Permission::all());

        // Create Admin role with most permissions (except role management)
        $admin = Role::firstOrCreate(['name' => 'Admin']);
        $admin->givePermissionTo([
            'view_dashboard',
            'view_statistics',
            'view_categories',
            'create_categories',
            'edit_categories',
            'delete_categories',
            'view_products',
            'create_products',
            'edit_products',
            'delete_products',
            'view_orders',
            'create_orders',
            'edit_orders',
            'delete_orders',
            'update_order_status',
            'view_reservations',
            'create_reservations',
            'edit_reservations',
            'delete_reservations',
            'update_reservation_status',
            'view_users',
            'create_users',
            'edit_users',
        ]);

        // Create Manager role
        $manager = Role::firstOrCreate(['name' => 'Manager']);
        $manager->givePermissionTo([
            'view_dashboard',
            'view_statistics',
            'view_categories',
            'view_products',
            'view_orders',
            'edit_orders',
            'update_order_status',
            'view_reservations',
            'edit_reservations',
            'update_reservation_status',
        ]);

        // Create Staff role (limited access)
        $staff = Role::firstOrCreate(['name' => 'Staff']);
        $staff->givePermissionTo([
            'view_dashboard',
            'view_orders',
            'update_order_status',
            'view_reservations',
            'update_reservation_status',
        ]);

        // Assign Super Admin role to first user if exists
        $firstUser = \App\Models\User::first();
        if ($firstUser && !$firstUser->hasAnyRole(Role::all())) {
            $firstUser->assignRole('Super Admin');
        }
    }
}
