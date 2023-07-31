<?php

namespace App\Http\Controllers;

use App\Models\Reserva;
use Illuminate\View\View;
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
        $breadcrumbs = array(
            ['name'=> 'Dashboard','url' => route('dashboard'),'active' => 0],
            ['name'=> 'Reserva','url' => route('reservas.index'),'active' => 0],
            ['name'=> 'Novo','url' => '','active' => 1]
        );
        return view('pages.reserva.create',compact('breadcrumbs'));
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