<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $adminRole = Role::where('name', 'admin')->first();
        $deliveryRole = Role::where('name', 'delivery')->first();
        $customerRole = Role::where('name', 'customer')->first();
        $supplier = Role::where('name', 'supplier')->first();

        $permissions = [
            'add-products',
            'list-products',
            'edit-products',
            'filter-products',
            'delete-products',
            'list-supplier-products',
            'add-supplier-product',
            'delete-supplier-product',
            'list-categories',
            'add-categories',
            'list-cards',
            'add-supplier',
            'add-deliveryGuy',
            'list-users',
            'list-deliveries',
            'list-suppliers',
            'view-user-orders',
            'list-stores',
            'view-favorites',
            'addOrRemove-favorites',
            'list-orders',
            'deliver-orders',
            'assign-orders',
            'ask_for_quantity_increase',
        ];

        foreach ($permissions as $permissionName) {
            $permission = \Spatie\Permission\Models\Permission::create(['name' => $permissionName]);
            if (in_array($permissionName, [
                'add-products',
                'list-products',
                'edit-products',
                'filter-products',
                'delete-products',
                'list-categories',
                'add-categories',
                'list-cards',
                'add-supplier',
                'add-deliveryGuy',
                'list-users',
                'list-deliveries',
                'list-suppliers',
                'view-user-orders',
                'list-stores',
                'list-orders',
            ])) {
                $adminRole->givePermissionTo($permission);
            }

            if (in_array($permissionName, [
                'list-products',
                'filter-products',
                'list-supplier-products',
                'add-supplier-product',
                'delete-supplier-product',
                'add-deliveryGuy',
                'list-users',
                'list-deliveries',
                'view-user-orders',
                'assign-orders',
                'ask_for_quantity_increase',
            ]
            )) {
                $supplier->givePermissionTo($permission);
            }
        }
    }
}
