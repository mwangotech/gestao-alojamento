<?php

namespace App\Http\Controllers;

use App\Models\Provincia;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Services\ProvinciaService;
use App\Http\Requests\ProvinciaRequest;
use Illuminate\Http\RedirectResponse;

class ProvinciaController extends Controller
{
    private $service;
    public function __construct(ProvinciaService $_Service)
    {
       $this->service = $_Service;
    }

    /**

    * Display a listing of the resource.

    */
    public function index(Request $request): View
    {
        $provincias = $this->service->list();

        $breadcrumbs = array(
            ['name'=> 'Dashboard','url' => route('dashboard'),'active' => 0],
            ['name'=> 'Provincia','url' => '','active' => 1]
        );
        return view('pages.provincia.index',compact('provincias','breadcrumbs'))->with('i', ($request->input('page', 1) - 1) * 5);
    }

    public function autocomplete(Request $request)
    {
        return $this->service->autocomplete($request);
    }
    
    /**
 
    * Show the form for creating a new resource.

    */
    public function create(): View
    {
        $breadcrumbs = array(
            ['name'=> 'Dashboard','url' => route('dashboard'),'active' => 0],
            ['name'=> 'Provincia','url' => route('provincias.index'),'active' => 0],
            ['name'=> 'Novo','url' => '','active' => 1]
        );
        return view('pages.provincia.create',compact('breadcrumbs'));
    }

    /**
 
    * Store a newly created resource in storage.

    */
    public function store(ProvinciaRequest $request): RedirectResponse
    {        
        Provincia::create($request->all());

        return redirect()->route('provincias.index')->with('success','Provincia criado com sucesso.');
    }

    /**
    * Show the form for editing the specified resource.
    */
    public function edit(Provincia $provincia): View
    {
        $breadcrumbs = array(
            ['name'=> 'Dashboard','url' => route('dashboard'),'active' => 0],
            ['name'=> 'Provincia','url' => route('provincias.index'),'active' => 0],
            ['name'=> 'Editar','url' => '','active' => 1]
        );
        return view('pages.provincia.edit',compact('provincia','breadcrumbs'));
    }

    /** 
    * Update the specified resource in storage.
    */
    public function update(ProvinciaRequest $request, Provincia $provincia): RedirectResponse
    { 
        $provincia->update($request->all());

        return redirect()->route('provincias.index')->with('success','Provincia atualizado com sucesso.');
    }



    /**
    * Remove the specified resource from storage.
    */
    public function destroy(Provincia $provincia): RedirectResponse
    {
        $provincia->delete();

        return redirect()->route('provincias.index')->with('success','Provincia eliminado com sucesso!');
    }
}
