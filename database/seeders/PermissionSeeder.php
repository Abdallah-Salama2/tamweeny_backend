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
            'can-add-products',
            'can-list-products',
            'can-edit-products',
            'can-delete-products1',
            'can-delete-products2',
            'can-list-offers',
            'can-add-offer-to-products',
            'can-delete-offer-from-products',
            'can-add-user',
            'can-list-users',
            'can-list-deliveries',
            'can-list-suppliers',
            'can-view-user-order',
            'can-view-stores',
            'can-view-favorites',
            'can-addOrRemove-favorites',
            'can-list-orders',
            'can-deliver-orders',
            'can-assign-orders',
            'can-export-activity'
        ];

        foreach ($permissions as $permissionName) {
            $permission = \Spatie\Permission\Models\Permission::create(['name' => $permissionName]);
            $adminRole->givePermissionTo($permission);

            if (in_array($permissionName, ['can-list-offers', 'can-list-products', 'can-delete-products2', 'can-add-offer-to-products', 'can-delete-offer-from-products', 'can-list-deliveries',
                'can-view-user-order', 'can-list-orders', 'can-assign-orders',
            ])) {
                $supplier->givePermissionTo($permission);
            } elseif (in_array($permissionName, ['can-list-offers', 'can-list-products', 'can-view-favorites', 'can-addOrRemove-favorites',
                'can-list-orders',
            ])) {
                $supplier->givePermissionTo($permission);
            }
        }
    }
}
