<?php

namespace App\Services\Product\Interfaces;

interface ProductFetcherInterface
{
    public function getAllProducts(int $perPage = 8);
    public function findProductById($productId);
    public function findProductByName(string $productName);
}
