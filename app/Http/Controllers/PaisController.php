<?php

namespace App\Http\Controllers;

use App\Models\Pais;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Services\PaisService;
use App\Http\Requests\PaisRequest;
use Illuminate\Http\RedirectResponse;

class PaisController extends Controller
{
    private $service;
    public function __construct(PaisService $_Service)
    {
       $this->service = $_Service;
    }

    /**

    * Display a listing of the resource.

    */
    public function index(Request $request): View
    {
        $paiss = $this->service->list();

        $breadcrumbs = array(
            ['name'=> 'Dashboard','url' => route('dashboard'),'active' => 0],
            ['name'=> 'Pais','url' => '','active' => 1]
        );
        return view('pages.pais.index',compact('paiss','breadcrumbs'))->with('i', ($request->input('page', 1) - 1) * 5);
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
            ['name'=> 'Pais','url' => route('paiss.index'),'active' => 0],
            ['name'=> 'Novo','url' => '','active' => 1]
        );
        return view('pages.pais.create',compact('breadcrumbs'));
    }

    /**
 
    * Store a newly created resource in storage.

    */
    public function store(PaisRequest $request): RedirectResponse
    {        
        Pais::create($request->all());

        return redirect()->route('paiss.index')->with('success','Pais criado com sucesso.');
    }

    /**
    * Show the form for editing the specified resource.
    */
    public function edit(Pais $pais): View
    {
        $breadcrumbs = array(
            ['name'=> 'Dashboard','url' => route('dashboard'),'active' => 0],
            ['name'=> 'Pais','url' => route('paiss.index'),'active' => 0],
            ['name'=> 'Editar','url' => '','active' => 1]
        );
        return view('pages.pais.edit',compact('pais','breadcrumbs'));
    }

    /** 
    * Update the specified resource in storage.
    */
    public function update(PaisRequest $request, Pais $pais): RedirectResponse
    { 
        $pais->update($request->all());

        return redirect()->route('paiss.index')->with('success','Pais atualizado com sucesso.');
    }



    /**
    * Remove the specified resource from storage.
    */
    public function destroy(Pais $pais): RedirectResponse
    {
        $pais->delete();

        return redirect()->route('paiss.index')->with('success','Pais eliminado com sucesso!');
    }
}
