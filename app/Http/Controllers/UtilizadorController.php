<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Perfil;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Services\UtilizadorService;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\UtilizadorRequest;

class UtilizadorController extends Controller
{
    private $service;
    public function __construct(UtilizadorService $_Service)
    {
       $this->service = $_Service;
    }

    /**

    * Display a listing of the resource.

    */
    public function index(Request $request): View
    {
        $utilizadores = $this->service->list();

        $breadcrumbs = array(
            ['name'=> 'Dashboard','url' => route('dashboard'),'active' => 0],
            ['name'=> 'Utilizador','url' => '','active' => 1]
        );
        return view('pages.utilizador.index',compact('utilizadores','breadcrumbs'))->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
 
    * Show the form for creating a new resource.

    */
    public function create(): View
    {
        $breadcrumbs = array(
            ['name'=> 'Dashboard','url' => route('dashboard'),'active' => 0],
            ['name'=> 'Utilizador','url' => route('utilizadores.index'),'active' => 0],
            ['name'=> 'Novo','url' => '','active' => 1]
        );
        $perfis = Perfil::where('estado', 1)->get();
        return view('pages.utilizador.create',compact('breadcrumbs','perfis'));
    }

    /**
 
    * Store a newly created resource in storage.

    */
    public function store(UtilizadorRequest $request): RedirectResponse
    {
        $data = $request->all();
        DB::transaction(function () use ($data) {
            $utilizador = User::create($data);

            if(count($data["utilizador_perfil"])) {
                $utilizador->perfis()->sync($data["utilizador_perfil"]);
            }
        });
        
       

        return redirect()->route('utilizadores.index')->with('success','Utilizador criado com sucesso.');
    }

    /**
    * Show the form for editing the specified resource.
    */
    public function edit(User $utilizador): View
    {
        $breadcrumbs = array(
            ['name'=> 'Dashboard','url' => route('dashboard'),'active' => 0],
            ['name'=> 'Utilizador','url' => route('utilizadores.index'),'active' => 0],
            ['name'=> 'Editar','url' => '','active' => 1]
        );
        $perfis = Perfil::where('estado', 1)->get();
        $db_perfis = $utilizador->perfis ?? [];
        if(count($db_perfis)) {
            foreach($db_perfis as $db_perfil) {
                $selectPerfil[] = $db_perfil->id;
            }
        } else {
            $selectPerfil = [];
        }
        return view('pages.utilizador.edit',compact('utilizador','breadcrumbs','perfis','selectPerfil'));
    }

    /** 
    * Update the specified resource in storage.
    */
    public function update(UtilizadorRequest $request, User $utilizador): RedirectResponse
    {
        $data = $request->all();
        DB::transaction(function () use ($utilizador, $data) {
            $utilizador->update($data);

            if(count($data["utilizador_perfil"])) {
                $utilizador->perfis()->sync($data["utilizador_perfil"]);
            }
        });
       
        return redirect()->route('utilizadores.index')->with('success','Utilizador atualizado com sucesso.');
    }



    /**
    * Remove the specified resource from storage.
    */
    public function destroy(User $utilizador): RedirectResponse
    {
        $utilizador->delete();

        return redirect()->route('utilizadores.index')->with('success','Utilizador eliminado com sucesso!');
    }
}
