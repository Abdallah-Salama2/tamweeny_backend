<?php

namespace App\Providers;

use App\Interfaces\CategoryFetcherInterface;
use App\Services\CategoryFetcherApiService;
use App\Services\CategoryFetcherWebService;
use App\Services\FileStorage\FileStorageService;
use App\Services\FileStorage\Interfaces\FileStorageInterface;
use App\Services\UserService;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Inertia\Inertia;

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
//        $this->app->bind('categoryFetcherWeb', CategoryFetcherWebService::class);
//        $this->app->bind('categoryFetcherApi', CategoryFetcherApiService::class);
//        $this->app->bind(CategoryFetcherInterface::class, CategoryFetcherWebService::class);
        $this->app->bind(CategoryFetcherInterface::class, CategoryFetcherApiService::class);


        /*$this->app: This is the service container instance. It is used to bind classes and interfaces to their implementations.
        singleton: This method ensures that only one instance of UserService is created and reused throughout the application.
        UserService::class: This is the class being bound as a singleton.
        function ($app): This is a closure that returns a new instance of UserService. The $app parameter is the service container itself, which can be used to resolve other dependencies if needed.*/

        $this->app->singleton(UserService::class, function ($app) {
            return new UserService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        Schema::defaultStringLength(191);
        JsonResource::withoutWrapping();
        Inertia::share([
            'flash' => function () {
                return [
                    'success' => session('success'),
                ];
            },
        ]);

    }
}
