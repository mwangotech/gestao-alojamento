<?php

namespace App\Http\Controllers;

use App\Models\Comodidade;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Services\ComodidadeService;
use App\Http\Requests\ComodidadeRequest;
use Illuminate\Http\RedirectResponse;

class ComodidadeController extends Controller
{
    private $service;
    public function __construct(ComodidadeService $_Service)
    {
       $this->service = $_Service;
    }

    /**

    * Display a listing of the resource.

    */
    public function index(Request $request): View
    {
        $comodidades = $this->service->list();

        $breadcrumbs = array(
            ['name'=> 'Dashboard','url' => route('dashboard'),'active' => 0],
            ['name'=> 'Comodidade','url' => '','active' => 1]
        );
        return view('pages.comodidade.index',compact('comodidades','breadcrumbs'))->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
 
    * Show the form for creating a new resource.

    */
    public function create(): View
    {
        $breadcrumbs = array(
            ['name'=> 'Dashboard','url' => route('dashboard'),'active' => 0],
            ['name'=> 'Comodidade','url' => route('comodidades.index'),'active' => 0],
            ['name'=> 'Novo','url' => '','active' => 1]
        );
        return view('pages.comodidade.create',compact('breadcrumbs'));
    }

    /**
 
    * Store a newly created resource in storage.

    */
    public function store(ComodidadeRequest $request): RedirectResponse
    {        
        Comodidade::create($request->all());

        return redirect()->route('comodidades.index')->with('success','Comodidade criado com sucesso.');
    }

    /**
    * Show the form for editing the specified resource.
    */
    public function edit(Comodidade $comodidade): View
    {
        $breadcrumbs = array(
            ['name'=> 'Dashboard','url' => route('dashboard'),'active' => 0],
            ['name'=> 'Comodidade','url' => route('comodidades.index'),'active' => 0],
            ['name'=> 'Editar','url' => '','active' => 1]
        );
        return view('pages.comodidade.edit',compact('comodidade','breadcrumbs'));
    }

    /** 
    * Update the specified resource in storage.
    */
    public function update(ComodidadeRequest $request, Comodidade $comodidade): RedirectResponse
    { 
        $comodidade->update($request->all());

        return redirect()->route('comodidades.index')->with('success','Comodidade atualizado com sucesso.');
    }



    /**
    * Remove the specified resource from storage.
    */
    public function destroy(Comodidade $comodidade): RedirectResponse
    {
        $comodidade->delete();

        return redirect()->route('comodidades.index')->with('success','Comodidade eliminado com sucesso!');
    }
}
