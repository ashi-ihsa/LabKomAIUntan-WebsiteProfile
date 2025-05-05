<?php

namespace App\Providers;

use App\Services\Impl\KerjasamaServiceImpl;
use App\Services\KerjasamaService;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class KerjasamaServiceProvider extends ServiceProvider implements DeferrableProvider
{
    public array $singletons = [
        KerjasamaService::class => KerjasamaServiceImpl::class
    ];

    public function provides()
    {
        return [KerjasamaService::class];
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
