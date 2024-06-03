<?php

namespace App\Services\Product;

use App\Interfaces\Product\ProductRecommendationInterface;
use App\Models\Product;

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
