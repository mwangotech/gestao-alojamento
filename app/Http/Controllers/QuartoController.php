<?php

namespace App\Http\Controllers;

use App\Models\Quarto;
use App\Models\Servico;
use Illuminate\View\View;
use App\Models\Comodidade;
use App\Models\EstadoQuarto;
use Illuminate\Http\Request;
use App\Services\QuartoService;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\QuartoRequest;
use Illuminate\Http\RedirectResponse;

class QuartoController extends Controller
{
    private $service;
    public function __construct(QuartoService $_Service)
    {
       $this->service = $_Service;
    }

    /**

    * Display a listing of the resource.

    */
    public function index(Request $request): View
    {
        $quartos = $this->service->list();

        $breadcrumbs = array(
            ['name'=> 'Dashboard','url' => route('dashboard'),'active' => 0],
            ['name'=> 'Quarto','url' => '','active' => 1]
        );
        return view('pages.quarto.index',compact('quartos','breadcrumbs'))->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
 
    * Show the form for creating a new resource.

    */
    public function create(): View
    {
        $estados = EstadoQuarto::where('estado', 1)->get();
        $breadcrumbs = array(
            ['name'=> 'Dashboard','url' => route('dashboard'),'active' => 0],
            ['name'=> 'Quarto','url' => route('quartos.index'),'active' => 0],
            ['name'=> 'Novo','url' => '','active' => 1]
        );
        return view('pages.quarto.create',compact('breadcrumbs', 'estados'));
    }

    /**
 
    * Store a newly created resource in storage.

    */
    public function store(QuartoRequest $request): RedirectResponse
    {        
        $data = $request->all();
        DB::transaction(function () use ($data) {
            $quarto = Quarto::create($data);

            if(count($data["quarto_comodidade"])) {
                $quarto->comodidades()->sync($data["quarto_comodidade"]);
            }
            if(count($data["quarto_servico"])) {
                $quarto->servicos()->sync($data["quarto_servico"]);
            }
        });

        return redirect()->route('quartos.index')->with('success','Quarto criado com sucesso.');
    }

    /**
    * Show the form for editing the specified resource.
    */
    public function edit(Quarto $quarto): View
    {
        $estados = EstadoQuarto::where('estado', 1)->get();
        $breadcrumbs = array(
            ['name'=> 'Dashboard','url' => route('dashboard'),'active' => 0],
            ['name'=> 'Quarto','url' => route('quartos.index'),'active' => 0],
            ['name'=> 'Editar','url' => '','active' => 1]
        );
        $servicos = $quarto->servicos;
        $comodidades = $quarto->comodidades;
        return view('pages.quarto.edit',compact('quarto','breadcrumbs','estados','servicos','comodidades'));
    }

    /** 
    * Update the specified resource in storage.
    */
    public function update(QuartoRequest $request, Quarto $quarto): RedirectResponse
    { 
        $data = $request->all();
        DB::transaction(function () use ($quarto, $data) {
            $quarto->update($data);

            if(count($data["quarto_comodidade"])) {
                $quarto->comodidades()->sync($data["quarto_comodidade"]);
            }
            if(count($data["quarto_servico"])) {
                $quarto->servicos()->sync($data["quarto_servico"]);
            }
        });
        return redirect()->route('quartos.index')->with('success','Quarto atualizado com sucesso.');
    }



    /**
    * Remove the specified resource from storage.
    */
    public function destroy(Quarto $quarto): RedirectResponse
    {
        $quarto->delete();

        return redirect()->route('quartos.index')->with('success','Quarto eliminado com sucesso!');
    }
}
