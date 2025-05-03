<?php

namespace App\Providers;

use App\Services\Impl\TagServiceImpl;
use App\Services\TagService;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\Arr;
use Illuminate\Support\ServiceProvider;

class TagServiceProvider extends ServiceProvider implements DeferrableProvider
{
    public array $singletons = [
        TagService::class => TagServiceImpl::class
    ];

    public function provides(): array
    {
        return[TagService::class];
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
