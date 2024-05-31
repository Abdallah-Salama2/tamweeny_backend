<?php

namespace App\Providers;

use App\Services\FileStorage\FileStorageService;
use App\Services\FileStorage\Interfaces\FileStorageInterface;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
        $loader = \Illuminate\Foundation\AliasLoader::getInstance();
        $loader->alias('Debugbar', \Barryvdh\Debugbar\Facades\Debugbar::class);

        $this->app->bind(FileStorageInterface::class, FileStorageService::class);

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        Schema::defaultStringLength(191);
        JsonResource::withoutWrapping();


    }
}
