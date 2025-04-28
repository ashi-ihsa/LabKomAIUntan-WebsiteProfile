<?php

namespace App\Providers;

use App\Services\AuthorService;
use App\Services\Impl\UserServiceImpl;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class AuthorServiceProvider extends ServiceProvider implements DeferrableProvider
{
    public array $singletons = [
        AuthorService::class => UserServiceImpl::class
    ];

    public function provides(): array
    {
        return [AuthorService::class];
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
