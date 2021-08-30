<?php

use App\Models\ExchangeRate;
use TCG\Voyager\Facades\Voyager;
use App\Events\ExchangeRateUpdated;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

Route::get('/test', function(){
broadcast(new ExchangeRateUpdated(ExchangeRate::first()));
});