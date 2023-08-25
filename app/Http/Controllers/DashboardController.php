<?php

namespace App\Http\Controllers;

use App\Models\Pagamento;
use App\Models\Reserva;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Services\DashboardService;
use Illuminate\Http\RedirectResponse;

class DashboardController extends Controller
{
    private $service;
    public function __construct(DashboardService $_Service)
    {
       $this->service = $_Service;
    }

    /**

    * Display a listing of the resource.

    */
    public function index(Request $request): View
    {
        $checkinCurso = Reserva::where('idEstadoReserva', 2)->count() ?? 0;

        $reservasPendente = Reserva::where('idEstadoReserva', 1)->count() ?? 0;

        $totalAdultos = Reserva::where('idEstadoReserva', 2)->sum('totalAdulto') ?? 0;
        $totalCrianca = Reserva::where('idEstadoReserva', 2)->sum('totalCrianca') ?? 0;
        $totalHospedes = $totalAdultos+$totalCrianca;
        
        $totalFaturacao = Reserva::whereDate('dataInicio', '>=', date('Y-m-01'))->whereDate('dataInicio', '<=', date('Y-m-t'))->sum('valor');

        $totalFaturacaoRecebido = Pagamento::whereDate('dataPagamento', '>=', date('Y-m-01'))->whereDate('dataPagamento', '<=', date('Y-m-t'))->sum('montante');

        $totalFaturacaoEmFalta = $totalFaturacao - $totalFaturacaoRecebido;
        $breadcrumbs = array(
            ['name'=> 'Dashboard','url' => '','active' => 1]
        );
        return view('index',compact('checkinCurso','reservasPendente','totalHospedes','totalFaturacaoRecebido','totalFaturacaoEmFalta','breadcrumbs'));
    }
    
    public function dashboardReservasPorEstados(Request $request)
    {
        return $this->service->dashboardReservasPorEstados($request);
    }
    
    public function dashboardFaturacaoSemanal(Request $request)
    {
        return $this->service->dashboardFaturacaoSemanal($request);
    }
    
    public function dashboardFaturacaoMensal(Request $request)
    {
        return $this->service->dashboardFaturacaoMensal($request);
    }
}
