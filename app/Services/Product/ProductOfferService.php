<?php

namespace App\Services\Product;

use App\Interfaces\Product\ProductOfferInterface;
use App\Models\Product;
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
