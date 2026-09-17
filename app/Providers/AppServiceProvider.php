<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Services\Breed\Contracts\BreedProviderInterface;
use App\Services\Breed\TheDogApiService;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(
            BreedProviderInterface::class,
            TheDogApiService::class
        );
    }

    public function boot(): void
    {
        //
    }
}