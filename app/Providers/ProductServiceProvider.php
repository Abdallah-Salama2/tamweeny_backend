<?php

namespace App\Providers;

use App\Services\Product\Interfaces\ProductFetcherInterface;
use App\Services\Product\Interfaces\ProductOfferInterface;
use App\Services\Product\Interfaces\ProductRecommendationInterface;
use App\Services\Product\ProductFetcherService;
use App\Services\Product\ProductOfferService;
use App\Services\Product\ProductRecommendationService;
use Illuminate\Support\ServiceProvider;

class ProductServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(ProductFetcherInterface::class, ProductFetcherService::class);
        $this->app->bind(ProductRecommendationInterface::class, ProductRecommendationService::class);
        $this->app->bind(ProductOfferInterface::class, ProductOfferService::class);
    }

    public function boot()
    {
        //
    }
}
