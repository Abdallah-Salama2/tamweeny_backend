<?php

namespace App\Services\Product;

use App\Models\Product;
use App\Services\Product\Interfaces\ProductOfferInterface;
use Illuminate\Database\Eloquent\Collection;

class ProductOfferService implements ProductOfferInterface
{

    public function getProductsOnOffer(): Collection {
        return Product::with('productPricing', 'category')
            ->whereHas('productPricing', function ($query) {
                $query->whereColumn('base_price', '>', 'selling_price');
            })
            ->get();
    }
}
