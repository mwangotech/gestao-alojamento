<?php

namespace App\Services;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Repositories\QuartoRepository;
use Illuminate\Http\RedirectResponse;

class QuartoService
{
    private $repository;
    public function __construct(QuartoRepository $_repository)
    {
        $this->repository = $_repository;
    }

    public function list()
    {
        return $this->repository->list();
    }

    public function todayDisponibilities()
    {
        return $this->repository->todayDisponibilities();
    }

    public function pesquisa_quarto(Request $request)
    {
        $filters = array(
            'filtro_idTipoQuarto' => $request->input('filtro_idTipoQuarto') ?? null,
            'filtro_numAdulto' => $request->input('filtro_numAdulto') ?? null,
            'filtro_numCrianca' => $request->input('filtro_numCrianca') ?? null,
            'filtro_data' => $request->input('filtro_data') ?? null,
            'filtro_numDias' => $request->input('filtro_numDias') ?? null,
            'filtro_comodidades' => $request->input('filtro_comodidades') ?? null,
            'filtro_servicos' => $request->input('filtro_servicos') ?? null,
        );
        //dd($filters);
        return $this->repository->pesquisa_quarto($filters);
    }
    
}
