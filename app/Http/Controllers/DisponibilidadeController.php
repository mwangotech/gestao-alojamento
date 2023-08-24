<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Services\QuartoService;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\DisponibilidadeRequest;

class DisponibilidadeController extends Controller
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
        $disponibilidades = $this->service->todayDisponibilities();

        $breadcrumbs = array(
            ['name'=> 'Dashboard','url' => route('dashboard'),'active' => 0],
            ['name'=> 'Disponibilidade','url' => '','active' => 1]
        );
        return view('pages.disponibilidade.index',compact('breadcrumbs','disponibilidades'))->with('i', ($request->input('page', 1) - 1) * 5);
    }
}
