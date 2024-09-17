<?php

use App\Http\Controllers\Api\ApiRestaurantController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\Api\GraphController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('restaurants', [ApiRestaurantController::class, 'apiIndex']);

Route::get('restaurants/{slug}', [ApiRestaurantController::class, 'show']);

Route::get('types', [ApiRestaurantController::class, 'getTypes']);

Route::get('/payment/token', [PaymentController::class, 'generateToken']);
Route::post('/payment/process', [PaymentController::class, 'processPayment']);

Route::get('/graph', [GraphController::class, 'index']);
