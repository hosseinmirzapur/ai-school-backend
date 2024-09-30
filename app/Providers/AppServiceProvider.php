<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use Laravel\Passport\Passport;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // ignoring default routes defined by passport internally
        Passport::ignoreRoutes();
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // only hashed client secrets will be stored in database
        Passport::hashClientSecrets();

        // passport tokens expire in 15 days
        Passport::tokensExpireIn(now()->addDays(15));

        // Globally set $guarded variable false
        Model::isUnguarded();
    }
}
