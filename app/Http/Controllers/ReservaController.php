<?php

namespace App\Http\Controllers;

use App\Models\Quarto;
use App\Models\Reserva;
use App\Models\Servico;
use Illuminate\View\View;
use App\Models\Comodidade;
use App\Models\TipoQuarto;
use Illuminate\Http\Request;
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
 
    * Show the form for creating a new resource.

    */
    public function create(): View
    {
        $tipos = TipoQuarto::where('estado', 1)->get();
        $comodidades = Comodidade::where('estado', 1)->get();
        $servicos = Servico::where('estado', 1)->get();
        $quartosTest = Quarto::all();

        //dd($quartosTest);
        $breadcrumbs = array(
            ['name'=> 'Dashboard','url' => route('dashboard'),'active' => 0],
            ['name'=> 'Reserva','url' => route('reservas.index'),'active' => 0],
            ['name'=> 'Novo','url' => '','active' => 1]
        );
        return view('pages.reserva.create',compact('breadcrumbs','tipos','comodidades','servicos','quartosTest'));
    }

    /**
 
    * Store a newly created resource in storage.

    */
    public function store(ReservaRequest $request): RedirectResponse
    {        
        $data = $request->all();
        DB::transaction(function () use ($data) {
            $reserva = Reserva::create($data);

            if(count($data["reserva_comodidade"])) {
                $reserva->comodidades()->sync($data["reserva_comodidade"]);
            }
            if(count($data["reserva_servico"])) {
                $reserva->servicos()->sync($data["reserva_servico"]);
            }
        });

        return redirect()->route('reservas.index')->with('success','Reserva criado com sucesso.');
    }

}
