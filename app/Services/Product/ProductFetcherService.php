<?php

namespace App\Services\Product;

use App\Models\Product;
use App\Services\Product\Interfaces\ProductFetcherInterface;

class ProductFetcherService implements ProductFetcherInterface
{

    public function getAllProducts(int $perPage = 8)
    {
        // TODO: Implement getAllProducts() method.
        return Product::with(['productpricing', 'category']);

    }

    public function findProductById($productId)
    {
        // TODO: Implement findProductById() method.
        return Product::find($productId);

    }

    public function findProductByName(string $productName)
    {
        // TODO: Implement findProductByName() method.
        return Product::where('product_name', 'like', '%' . $productName . '%')->get();

    }
}
