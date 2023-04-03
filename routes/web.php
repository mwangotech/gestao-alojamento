<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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
Route::group(['namespace' => 'App\Http\Controllers'], function () {
    Route::group(
        [
            'middleware' => ['guest'],
        ],
        function ($auth_guest) {
            $auth_guest
                ->get('/login', 'AuthController@login')
                ->name('login.show');
            $auth_guest
                ->post('/login', 'AuthController@authenticate')
                ->name('login.perform');
        }
    );
    Route::group(
        [
            'middleware' => ['auth'],
        ],
        function ($route) {
            $route->get('/', function () {
                return view('index');
            });
            $route
                ->post('/logout', 'AuthController@logout')
                ->name('logout.perform');
        }
    );
});
