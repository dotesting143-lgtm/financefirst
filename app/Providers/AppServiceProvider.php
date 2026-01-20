<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\Notifications\ResetPassword;
use App\Models\User;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Customise the reset URL to include 'username'
        ResetPassword::createUrlUsing(function (User $user, string $token) {
            return 'https://brokercloud.work/reset-password?token=' . $token . '&email=' . urlencode($user->email) . '&username=' . urlencode($user->username);
        });
    }
}