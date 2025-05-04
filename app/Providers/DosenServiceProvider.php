<?php

namespace App\Providers;

use App\Services\DosenService;
use App\Services\Impl\DosenServiceImpl;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class DosenServiceProvider extends ServiceProvider implements DeferrableProvider
{
    public array $singletons =[
        DosenService::class => DosenServiceImpl::class
    ];

    public function provides()
    {
        return [DosenService::class];
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
