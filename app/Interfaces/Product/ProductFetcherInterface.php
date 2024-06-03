<?php

namespace App\Interfaces\Product;

interface ProductFetcherInterface
{
    public function getAllProducts();
    public function findProductById($productId);
    public function findProductByName(string $productName);
}
