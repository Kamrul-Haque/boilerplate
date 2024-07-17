<?php

use App\Http\Controllers as Controllers;
use App\Http\Controllers\Admin as AdminControllers;
use Illuminate\Support\Facades\Route;

require __DIR__ . '/auth.php';

Route::get('auth/{provider}/redirect', [Controllers\AuthProviderController::class, 'redirectToProvider'])
     ->name('auth.provider.redirect');
Route::get('auth/{provider}/callback', [Controllers\AuthProviderController::class, 'handleProviderCallback'])
     ->name('auth.provider.callback');

Route::get('/', function () {
    return inertia('Home');
})->name('home');

Route::middleware('precognitive')->group(function () {
    Route::get('users/{user}/image', [AdminControllers\UserController::class, 'getImage'])->name('users.image');

    Route::middleware('auth')->group(function () {
        Route::get('dashboard', Controllers\DashboardController::class)
             ->name('dashboard');

        Route::get('profile', [Controllers\ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('profile', [Controllers\ProfileController::class, 'update'])->name('profile.update');
        Route::delete('profile', [Controllers\ProfileController::class, 'destroy'])->name('profile.destroy');

        Route::prefix('admin')->as('admin.')->group(function () {
            Route::get('dashboard', AdminControllers\DashboardController::class)
                 ->name('dashboard');

            Route::middleware('allow:SUPER_ADMIN,ADMIN')->group(function () {
                Route::resource('users', AdminControllers\UserController::class);
                Route::delete('users/{user}/deactivate', [AdminControllers\UserController::class, 'deactivate'])
                     ->name('users.deactivate');
                Route::put('users/{user}/restore', [AdminControllers\UserController::class, 'restore'])
                     ->name('users.restore');
            });

            Route::middleware('allow:SUPER_ADMIN')->group(function () {
                Route::resource('settings', AdminControllers\SettingController::class)->only('edit', 'update');
            });
        });
    });
});
