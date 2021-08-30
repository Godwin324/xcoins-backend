<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\{
    UserController,
    AuthController,
    ExchangeRateController
};


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::group([
    'middleware' => 'api',
], function ($router) {
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('user-profile', [UserController::class, 'profile'])->name('profile');

});
Route::post('register', [UserController::class, 'register'])->name('register');
Route::post('login', [AuthController::class, 'login'])->name('login');
Route::get('exchange-rate', [ExchangeRateController::class, 'getExchangeRate'])->name('exchange.rate');
