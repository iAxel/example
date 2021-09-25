<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\LogoutController;

use App\Http\Controllers\Api\User\Controller as UserController;
use App\Http\Controllers\Api\Role\Controller as RoleController;
use App\Http\Controllers\Api\Policy\Controller as PolicyController;

Route::group(['prefix' => 'api'], function () {
    Route::group(['prefix' => 'auth'], function () {
        Route::post('login', LoginController::class)->name('login');
        Route::post('logout', LogoutController::class)->name('logout');
    });

    Route::group(['middleware' => 'auth:api'], function () {
        Route::group(['as' => 'users.', 'prefix' => 'users'], function () {
            Route::get('/', [UserController::class, 'index'])->name('index');
            Route::post('/', [UserController::class, 'create'])->name('create');
            Route::get('{id}', [UserController::class, 'show'])->name('show');
            Route::put('{id}', [UserController::class, 'update'])->name('update');
            Route::delete('{id}', [UserController::class, 'delete'])->name('delete');
        });

        Route::group(['as' => 'roles.', 'prefix' => 'roles'], function () {
            Route::get('/', [RoleController::class, 'index'])->name('index');
            Route::post('/', [RoleController::class, 'create'])->name('create');
            Route::get('{id}', [RoleController::class, 'show'])->name('show');
            Route::put('{id}', [RoleController::class, 'update'])->name('update');
            Route::delete('{id}', [RoleController::class, 'delete'])->name('delete');
        });

        Route::group(['as' => 'policies.', 'prefix' => 'policies'], function () {
            Route::get('/', [PolicyController::class, 'index'])->name('index');
            Route::get('{id}', [PolicyController::class, 'show'])->name('show');
        });
    });
});
