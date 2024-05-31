<?php

namespace App\Services\Product;

use App\Models\Product;
use App\Services\Product\Interfaces\ProductRecommendationInterface;

class ProductRecommendationService implements ProductRecommendationInterface
{

    public function getRecommendedProducts()
    {
        // TODO: Implement getRecommendedProducts() method.
        return Product::with('productPricing', 'category')
            ->orderByDesc('order_count')
            ->orderByDesc('favorite_count')
            ->take(2)
            ->get();
    }
}
