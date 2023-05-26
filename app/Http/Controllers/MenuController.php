<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\User;
use App\Models\Perfil;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Services\MenuService;
use App\Http\Requests\MenuRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;

class MenuController extends Controller
{
    private $service;
    public function __construct(MenuService $_Service)
    {
       $this->service = $_Service;
    }

    /**

    * Display a listing of the resource.

    */
    public function index(Request $request): View
    {
        $menus = $this->service->list();

        $breadcrumbs = array(
            ['name'=> 'Dashboard','url' => route('dashboard'),'active' => 0],
            ['name'=> 'Menu','url' => '','active' => 1]
        );
        return view('pages.menu.index',compact('menus','breadcrumbs'))->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
 
    * Show the form for creating a new resource.

    */
    public function create(): View
    {
        $menus = Menu::where('tipo', 'collapse')->where('estado', 1)->where('visivel', 1)->get();
        $breadcrumbs = array(
            ['name'=> 'Dashboard','url' => route('dashboard'),'active' => 0],
            ['name'=> 'Menu','url' => route('menus.index'),'active' => 0],
            ['name'=> 'Novo','url' => '','active' => 1]
        );
        $perfis = Perfil::where('estado', 1)->get();
        return view('pages.menu.create', compact('breadcrumbs','perfis','menus'));
    }

    /**
 
    * Store a newly created resource in storage.

    */
    public function store(MenuRequest $request): RedirectResponse
    {
        
        $data = $request->all();
        DB::transaction(function () use ($data) {
            $menu = Menu::create($data);

            if(count($data["menu_perfil"])) {
                $menu->perfis()->sync($data["menu_perfil"]);
            }
        });
        
       

        return redirect()->route('menus.index')->with('success','Menu criado com sucesso.');
    }

    /**
    * Show the form for editing the specified resource.
    */
    public function edit(Menu $menu): View
    {
        $menus = Menu::where('tipo', 'collapse')->where('id', '!=', $menu->id)->where('estado', 1)->where('visivel', 1)->get();
        $breadcrumbs = array(
            ['name'=> 'Dashboard','url' => route('dashboard'),'active' => 0],
            ['name'=> 'Menu','url' => route('menus.index'),'active' => 0],
            ['name'=> 'Editar','url' => '','active' => 1]
        );
        $perfis = Perfil::where('estado', 1)->get();
        $db_perfis = $menu->perfis ?? [];
        if(count($db_perfis)) {
            foreach($db_perfis as $db_perfil) {
                $selectPerfil[] = $db_perfil->id;
            }
        } else {
            $selectPerfil = [];
        }
        return view('pages.menu.edit',compact('menu','breadcrumbs','menus','perfis','selectPerfil'));
    }

    /** 
    * Update the specified resource in storage.
    */
    public function update(MenuRequest $request, Menu $menu): RedirectResponse
    {
        $data = $request->all();
        DB::transaction(function () use ($menu, $data) {
            $menu->update($data);

            if(count($data["menu_perfil"])) {
                $menu->perfis()->sync($data["menu_perfil"]);
            }
        });
       
        return redirect()->route('menus.index')->with('success','Menu atualizado com sucesso.');
    }



    /**
    * Remove the specified resource from storage.
    */
    public function destroy(User $menu): RedirectResponse
    {
        $menu->delete();

        return redirect()->route('menus.index')->with('success','Menu eliminado com sucesso!');
    }
}
