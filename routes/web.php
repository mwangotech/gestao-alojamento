<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PaisController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\QuartoController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ReservaController;
use App\Http\Controllers\ServicoController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PagamentoController;
use App\Http\Controllers\ProvinciaController;
use App\Http\Controllers\ComodidadeController;

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
            $route->get('/', [DashboardController::class, 'index']);
            $route->get('me',  [AuthController::class, 'me'])->name('me');
            $route->get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
            $route->get('dashboardReservasPorEstados', [DashboardController::class, 'dashboardReservasPorEstados']);
            $route->get('dashboardFaturacaoSemanal', [DashboardController::class, 'dashboardFaturacaoSemanal']);
            $route->get('dashboardFaturacaoMensal', [DashboardController::class, 'dashboardFaturacaoMensal']);
            $route->get('getAnalisysPeriods', [DashboardController::class, 'getAnalisysPeriods']);
            

            $route->get('relatorio-pagamentos', [PagamentoController::class, 'index'])->name('relatorio-pagamentos');
            $route->get('download-pagamentos', [PagamentoController::class, 'downloadPagamentos'])->name('download-pagamentos');
            
            $route->resource('perfis', PerfilController::class)->parameters(['perfis' => 'perfil']);
            $route->resource('utilizadores', UtilizadorController::class)->parameters(['utilizadores' => 'utilizador']);
            $route->resource('menus', MenuController::class)->parameters(['menus' => 'menu']);
            $route->resource('prestadores', PrestadorController::class)->parameters(['prestadores' => 'prestador']);
            $route->resource('disponibilidades', DisponibilidadeController::class)->parameters(['disponibilidades' => 'disponibilidade']);
            
            $route->resource('reservas', ReservaController::class)->parameters(['reservas' => 'reserva']);
            $route->post('add_historico_reserva', [ReservaController::class, 'add_historico_reserva']);
            $route->post('add_pagamento_reserva', [ReservaController::class, 'add_pagamento_reserva']);
            $route->get('download-fatura/{id}', [ReservaController::class, 'downloadFatura'])->name('download-fatura');

            $route->resource('paises', PaisController::class)->parameters(['paises' => 'pais']);
            $route->resource('provincias', ProvinciaController::class)->parameters(['provincias' => 'provincia']);
            $route->get('pais_autocomplete', [PaisController::class, 'autocomplete']);
            $route->get('provincia_autocomplete', [ProvinciaController::class, 'autocomplete']);
            $route->resource('comodidades', ComodidadeController::class)->parameters(['comodidades' => 'comodidade']);
            $route->get('comodidade_autocomplete', [ComodidadeController::class, 'autocomplete']);
            $route->resource('servicos', ServicoController::class)->parameters(['servicos' => 'servico']);
            $route->get('servico_autocomplete', [ServicoController::class, 'autocomplete']);
            $route->resource('quartos', QuartoController::class)->parameters(['quartos' => 'quarto']);
            $route->post('pesquisa_quarto', [QuartoController::class, 'pesquisa_quarto']);
            $route->resource('clientes', ClienteController::class)->parameters(['clientes' => 'cliente']);
            $route->post('cadastro_quarto', [ClienteController::class, 'cadastro_quarto']);
            $route->post('pesquisa_cliente', [ClienteController::class, 'pesquisa_cliente']);
            $route->get('/logout', 'AuthController@logout')->name('logout');
        }
    );
});
