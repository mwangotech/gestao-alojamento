<?php

namespace App\Http\Controllers;

use DateTime;
use Exception;
use App\Models\Quarto;
use App\Models\Cliente;
use App\Models\Reserva;
use App\Models\Servico;
use Illuminate\View\View;
use App\Models\Comodidade;
use App\Models\TipoQuarto;
use Illuminate\Http\Request;
use App\Models\EstadoReserva;
use App\Models\MetodoPagamento;
use App\Models\HistoricoReserva;
use App\Services\ReservaService;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ReservaRequest;
use Illuminate\Http\RedirectResponse;

class ReservaController extends Controller
{
    private $service;
    public function __construct(ReservaService $_Service)
    {
       $this->service = $_Service;
    }

    /**

    * Display a listing of the resource.

    */
    public function index(Request $request): View
    {
        $reservas = $this->service->list();

        $breadcrumbs = array(
            ['name'=> 'Dashboard','url' => route('dashboard'),'active' => 0],
            ['name'=> 'Reserva','url' => '','active' => 1]
        );
        return view('pages.reserva.index',compact('breadcrumbs','reservas'))->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
    * Display the specified resource.
    */
    public function show(Reserva $reserva): View
    {
        $mPagamentos = MetodoPagamento::where('estado', 1)->get();
        $estados = EstadoReserva::where('estado', 1)->get();
        $cliente = Cliente::find($reserva->idCliente);
        $quarto = Quarto::find($reserva->idQuarto);
        $historicos = HistoricoReserva::where('idReserva', $reserva->id)->orderBy('created_at', 'DESC')->get();
        $breadcrumbs = array(
            ['name'=> 'Dashboard','url' => route('dashboard'),'active' => 0],
            ['name'=> 'Reserva','url' => route('reservas.index'),'active' => 0],
            ['name'=> 'Detalhes','url' => '','active' => 1]
        );
        return view('pages.reserva.show', compact('reserva','breadcrumbs','cliente','quarto','historicos','estados','mPagamentos'));
    }
    
    public function add_historico_reserva(Request $request)
    {
        $idReserva = $request->input('idReserva') ?? null;
        if($idReserva) {
            try {
                $data = $request->all();
                $sucesso = DB::transaction(function() use($idReserva, $data) {
                    $data['idUtilizador'] =auth()->user()->id;
                    $reserva = Reserva::find($idReserva);
                    if($reserva->idEstadoReserva != $data['idEstadoReserva']) {
                        $reserva->idEstadoReserva = $data['idEstadoReserva'];

                        if($reserva->idEstadoReserva == 2) {
                            $reserva->checkin = date('Y-m-d H:i:s');
                            $reserva->checkout = null;
                        } 
                        else if($reserva->idEstadoReserva == 3) {
                            $reserva->checkout = date('Y-m-d H:i:s');
                        } else {
                            $reserva->checkin = null;
                            $reserva->checkout = null;
                        }
                        $reserva->save();
                    }
                    
                    HistoricoReserva::create($data);
                   return true;
                });
            } catch(Exception $e) {
                //print_r($e);die();
                $sucesso = false;
            }
        } else {
            $sucesso = false;
        }
        $historicos = HistoricoReserva::where('idReserva', $idReserva)->orderBy('created_at', 'DESC')->get();
        $content = array(
            'success' => $sucesso,
            'data' => view('pages.reserva.listaHistorico',compact('historicos'))->render()
        );
        return response()->json($content, 200);
    }
    
    /**
 
    * Show the form for creating a new resource.

    */
    public function create(): View
    {
        $tipos = TipoQuarto::where('estado', 1)->get();
        $mPagamentos = MetodoPagamento::where('estado', 1)->get();
        $comodidades = Comodidade::where('estado', 1)->get();
        $servicos = Servico::where('estado', 1)->get();

        //dd($quartosTest);
        $breadcrumbs = array(
            ['name'=> 'Dashboard','url' => route('dashboard'),'active' => 0],
            ['name'=> 'Reserva','url' => route('reservas.index'),'active' => 0],
            ['name'=> 'Novo','url' => '','active' => 1]
        );
        return view('pages.reserva.create',compact('breadcrumbs','tipos','mPagamentos','comodidades','servicos'));
    }

    /**
 
    * Store a newly created resource in storage.

    */

    public function store(ReservaRequest $request): RedirectResponse
    {        
        $data = $request->all();
        //dd($data);
        $res = DB::transaction(function () use ($data) {
            $data["dataInicio"] = DateTime::createFromFormat('d/m/Y', $data["dataInicio"])->format('Y-m-d');
            $data["dataFim"] = DateTime::createFromFormat('d/m/Y', $data["dataFim"])->format('Y-m-d');
            $data["idUtilizador"] = auth()->user()->id;
            $reserva = Reserva::create($data);

            /*if(count($data["reserva_comodidade"])) {
                $reserva->comodidades()->sync($data["reserva_comodidade"]);
            }
            if(count($data["reserva_servico"])) {
                $reserva->servicos()->sync($data["reserva_servico"]);
            }*/
            return $reserva;
        });

        return redirect()->route('reservas.show', $res->id)->with('success','Reserva criada com sucesso.');
    }
}
