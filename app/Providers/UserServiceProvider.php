<?php

namespace App\Providers;

use App\Interfaces\Auth\AuthInterface;
use App\Interfaces\Transaction\TransactionInterface;
use App\Interfaces\User\UserInterface;
use App\Services\Auth\AuthService;
use App\Services\Transaction\TransactionService;
use App\Services\User\UserServices;
use Illuminate\Support\ServiceProvider;

class UserServiceProvider extends ServiceProvider
{
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
        $this->app->bind(UserInterface::class, UserServices::class);
        $this->app->bind(AuthInterface::class, AuthService::class);
        $this->app->bind(TransactionInterface::class, TransactionService::class);

    }
}
