<?php

namespace App\Providers;

use App\Services\Impl\ArtikelServiceImpl;
use App\Services\ArtikelService;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class ArtikelServiceProvider extends ServiceProvider implements DeferrableProvider
{
    public array $singletons = [
        ArtikelService::class => ArtikelServiceImpl::class
    ];

    public function provides()
    {
        return [ArtikelService::class];
    }
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
