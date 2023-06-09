<?php

namespace App\Http\Controllers;

use App\Models\Prestador;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Services\PrestadorService;
use App\Http\Requests\PrestadorRequest;
use Illuminate\Http\RedirectResponse;

class PrestadorController extends Controller
{
    private $service;
    public function __construct(PrestadorService $_Service)
    {
       $this->service = $_Service;
    }

    /**

    * Display a listing of the resource.

    */
    public function index(Request $request): View
    {
        $prestadores = $this->service->list();

        $breadcrumbs = array(
            ['name'=> 'Dashboard','url' => route('dashboard'),'active' => 0],
            ['name'=> 'Prestador','url' => '','active' => 1]
        );
        return view('pages.prestador.index',compact('prestadores','breadcrumbs'))->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
 
    * Show the form for creating a new resource.

    */
    public function create(): View
    {
        $breadcrumbs = array(
            ['name'=> 'Dashboard','url' => route('dashboard'),'active' => 0],
            ['name'=> 'Prestador','url' => route('prestadores.index'),'active' => 0],
            ['name'=> 'Novo','url' => '','active' => 1]
        );
        return view('pages.prestador.create',compact('breadcrumbs'));
    }

    /**
 
    * Store a newly created resource in storage.

    */
    public function store(PrestadorRequest $request): RedirectResponse
    {        
        Prestador::create($request->all());

        return redirect()->route('prestadores.index')->with('success','Prestador criado com sucesso.');
    }

    /**
    * Show the form for editing the specified resource.
    */
    public function edit(Prestador $prestador): View
    {
        $breadcrumbs = array(
            ['name'=> 'Dashboard','url' => route('dashboard'),'active' => 0],
            ['name'=> 'Prestador','url' => route('prestadores.index'),'active' => 0],
            ['name'=> 'Editar','url' => '','active' => 1]
        );
        return view('pages.prestador.edit',compact('prestador','breadcrumbs'));
    }

    /** 
    * Update the specified resource in storage.
    */
    public function update(PrestadorRequest $request, Prestador $prestador): RedirectResponse
    { 
        $prestador->update($request->all());

        return redirect()->route('prestadores.index')->with('success','Prestador atualizado com sucesso.');
    }



    /**
    * Remove the specified resource from storage.
    */
    public function destroy(Prestador $prestador): RedirectResponse
    {
        $prestador->delete();

        return redirect()->route('prestadores.index')->with('success','Prestador eliminado com sucesso!');
    }
}
