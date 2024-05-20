<?php

namespace Database\Seeders;

use App\Http\Controllers\Api\ProductController;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            PermissionSeeder::class,
            UserSeeder::class,
            DelieveryEmailSeeder::class,
            CategoriesTableSeeder::class,
            StoresTableSeeder::class,
            ProductsTableSeeder::class,
            ProductsPricingsTableSeeder::class,
//            OrderSeeder::class,
            // Add more seeders here if needed
        ]);
        $productController = new ProductController();
        $productController->fillStoreProductsTable();
    }
}
