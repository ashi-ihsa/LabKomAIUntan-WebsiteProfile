<?php

namespace App\Providers;

use App\Services\Impl\TentangServiceImpl;
use App\Services\TentangService;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class TentangServiceProvider extends ServiceProvider implements DeferrableProvider
{
    public array $singletons=[
        TentangService::class => TentangServiceImpl::class
    ];

    public function provides(): array
    {
        return [TentangService::class];
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
