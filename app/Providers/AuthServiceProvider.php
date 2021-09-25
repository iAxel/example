<?php

namespace App\Providers;

use App\Models\User;
use App\Models\Role;
use App\Models\Policy;

use App\Policies\UserPolicy;
use App\Policies\RolePolicy;
use App\Policies\PolicyPolicy;

use Illuminate\Support\Facades\Auth;

use App\Auth\TokenGuard;
use App\Auth\TokenProvider;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

final class AuthServiceProvider extends ServiceProvider
{
    /**
     * @var array
     */
    protected $policies = [
        User::class => UserPolicy::class,
        Role::class => RolePolicy::class,
        Policy::class => PolicyPolicy::class,
    ];

    /**
     * @return void
     */
    public function boot(): void
    {
        $this->registerGuards();

        $this->registerPolicies();
    }

    /**
     * @return void
     */
    private function registerGuards(): void
    {
        Auth::extend('olympus', function ($app, $name, $config) {
            $provider = $app->make(TokenProvider::class);

            $guard = new TokenGuard($provider, $app['request'], $config);

            $app->refresh('request', $guard, 'setRequest');

            return $guard;
        });
    }
}
