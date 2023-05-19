<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PerfilController;

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
            $auth_guest->get('/login', 'AuthController@login')->name('login');
            $auth_guest->post('/login', 'AuthController@authenticate')->name('login');
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
            $route->get('dashboard', function () {
                return view('index');
            })->name('dashboard');
            $route->resource('perfis', PerfilController::class);
            $route->get('/logout', 'AuthController@logout')->name('logout');
        }
    );
});
