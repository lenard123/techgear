<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Auth\AdminGuard;
use Illuminate\Support\Facades\Auth;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        App\Models\Cart::class => App\Policies\CartPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Auth::extend('admin', function ($app, $name, array $config) {

            $provider = Auth::createUserProvider($config['provider']);

            return new AdminGuard(
                $name, 
                $provider,
                app()->make('session.store')
            );
        });
    }
}
