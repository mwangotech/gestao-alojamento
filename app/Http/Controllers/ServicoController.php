<?php

namespace App\Http\Controllers;

use App\Models\Servico;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Services\ServicoService;
use App\Http\Requests\ServicoRequest;
use Illuminate\Http\RedirectResponse;

class ServicoController extends Controller
{
    private $service;
    public function __construct(ServicoService $_Service)
    {
       $this->service = $_Service;
    }

    /**

    * Display a listing of the resource.

    */
    public function index(Request $request): View
    {
        $servicos = $this->service->list();

        $breadcrumbs = array(
            ['name'=> 'Dashboard','url' => route('dashboard'),'active' => 0],
            ['name'=> 'Servico','url' => '','active' => 1]
        );
        return view('pages.servico.index',compact('servicos','breadcrumbs'))->with('i', ($request->input('page', 1) - 1) * 5);
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
            ['name'=> 'Servico','url' => route('servicos.index'),'active' => 0],
            ['name'=> 'Novo','url' => '','active' => 1]
        );
        return view('pages.servico.create',compact('breadcrumbs'));
    }

    /**
 
    * Store a newly created resource in storage.

    */
    public function store(ServicoRequest $request): RedirectResponse
    {        
        Servico::create($request->all());

        return redirect()->route('servicos.index')->with('success','Servico criado com sucesso.');
    }

    /**
    * Show the form for editing the specified resource.
    */
    public function edit(Servico $servico): View
    {
        $breadcrumbs = array(
            ['name'=> 'Dashboard','url' => route('dashboard'),'active' => 0],
            ['name'=> 'Servico','url' => route('servicos.index'),'active' => 0],
            ['name'=> 'Editar','url' => '','active' => 1]
        );
        return view('pages.servico.edit',compact('servico','breadcrumbs'));
    }

    /** 
    * Update the specified resource in storage.
    */
    public function update(ServicoRequest $request, Servico $servico): RedirectResponse
    { 
        $servico->update($request->all());

        return redirect()->route('servicos.index')->with('success','Servico atualizado com sucesso.');
    }



    /**
    * Remove the specified resource from storage.
    */
    public function destroy(Servico $servico): RedirectResponse
    {
        $servico->delete();

        return redirect()->route('servicos.index')->with('success','Servico eliminado com sucesso!');
    }
}
