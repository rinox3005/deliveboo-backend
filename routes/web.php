<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\User\DishController;
use App\Http\Controllers\User\OrderController;
use App\Http\Controllers\User\RestaurantController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect('/login');
});

Route::middleware(['auth', 'verified'])
    ->name('user.')
    ->prefix('user')
    ->group(
        function () {
            // user dashboard
            Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

            //restaurants
            Route::resource('restaurants', RestaurantController::class)->parameters([
                'restaurants' => 'restaurant:slug',
            ]);

            //dishes
            Route::resource('dishes', DishController::class)->parameters([
                'dishes' => 'dish:slug',
            ]);

            //orders
            Route::resource('orders', OrderController::class)->parameters([
                'orders' => 'order:slug',
            ]);
        }
    );

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
