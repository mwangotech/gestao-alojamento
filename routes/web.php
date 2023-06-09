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
            'middleware' => ['web','guest'],
        ],
        function ($auth_guest) {
            $auth_guest->get('/login', 'AuthController@login')->name('login');
            $auth_guest->post('/login', 'AuthController@authenticate')->name('login');
        }
    );
    Route::group(
        [
            'middleware' => ['web','auth'],
        ],
        function ($route) {
            $route->get('/', function () {
                return view('index');
            });
            $route->get('me',  [AuthController::class, 'me'])->name('me');
            $route->get('dashboard', function () { return view('index');})->name('dashboard');
            $route->resource('perfis', PerfilController::class)->parameters(['perfis' => 'perfil']);
            $route->resource('utilizadores', UtilizadorController::class)->parameters(['utilizadores' => 'utilizador']);
            $route->resource('menus', MenuController::class)->parameters(['menus' => 'menu']);
            $route->resource('comodidades', ComodidadeController::class)->parameters(['comodidades' => 'comodidade']);
            $route->resource('servicos', ServicoController::class)->parameters(['servicos' => 'servico']);
            $route->resource('quartos', QuartoController::class)->parameters(['quartos' => 'quarto']);
            $route->resource('prestadores', PrestadorController::class)->parameters(['prestadores' => 'prestador']);
            $route->get('/logout', 'AuthController@logout')->name('logout');
        }
    );
});
