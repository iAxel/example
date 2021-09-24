<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

final class RouteServiceProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function boot(): void
    {
        $this->routes(function () {
            Route::group(['as' => 'api.'], base_path('routes/api.php'));
            Route::group(['as' => 'main.'], base_path('routes/main.php'));
        });
    }
}
