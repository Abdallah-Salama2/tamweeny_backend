<?php

namespace App\Services\Product;

use App\Interfaces\Product\ProductFetcherInterface;
use App\Models\Product;

class ProductFetcherService implements ProductFetcherInterface
{

    public function getAllProducts()
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
