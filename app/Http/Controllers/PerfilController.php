<?php

namespace App\Http\Controllers;

use App\Models\Perfil;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Services\PerfilService;
use Illuminate\Http\RedirectResponse;

class PerfilController extends Controller
{
    private $service;
    public function __construct(PerfilService $_Service)
    {
       $this->service = $_Service;
    }

    /**

    * Display a listing of the resource.

    */
    public function index(Request $request): View
    {
        $perfis = $this->service->list();

        $breadcrumbs = array(
            ['name'=> 'Dashboard','url' => route('dashboard'),'active' => 0],
            ['name'=> 'Perfis','url' => '','active' => 1]
        );
        return view('pages.perfil.index',compact('perfis','breadcrumbs'))->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
 
    * Show the form for creating a new resource.

    */
    public function create(): View
    {
        return view('perfis.create');
    }

    /**
 
    * Store a newly created resource in storage.

    */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required',
            'detail' => 'required',
        ]);
        
        Perfil::create($request->all());

        return redirect()->route('perfis.index')->with('success','Perfil created successfully.');
    }


    /**
    * Display the specified resource.
    */
    public function show(Perfil $perfil): View
    {
        return view('perfis.show',compact('perfil'));
    }

    /**
    * Show the form for editing the specified resource.
    */
    public function edit(Perfil $perfil): View
    {
        return view('perfis.edit',compact('perfil'));
    }

    /** 
    * Update the specified resource in storage.
    */
    public function update(Request $request, Perfil $perfil): RedirectResponse
    {
        $request->validate([
            'name' => 'required',
            'detail' => 'required',
        ]);
        
        $perfil->update($request->all());

        return redirect()->route('perfis.index')->with('success','Perfil updated successfully');
    }



    /**
    * Remove the specified resource from storage.
    */
    public function destroy(Perfil $perfil): RedirectResponse
    {
        $perfil->delete();

        return redirect()->route('perfis.index')->with('success','Perfil deleted successfully');
    }
}
