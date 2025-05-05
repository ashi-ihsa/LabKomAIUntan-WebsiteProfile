<?php

namespace App\Providers;

use App\Services\Impl\PublikasiServiceImpl;
use App\Services\PublikasiService;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class PublikasiServiceProvider extends ServiceProvider implements DeferrableProvider
{
    public array $singletons = [
        PublikasiService::class => PublikasiServiceImpl::class
    ];

    public function provides()
    {
        return [PublikasiService::class];
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
