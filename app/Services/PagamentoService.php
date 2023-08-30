<?php

namespace App\Services;
use App\Repositories\PagamentoRepository;

class PagamentoService
{
    private $repository;
    public function __construct(PagamentoRepository $_repository)
    {
        $this->repository = $_repository;
    }

    public function list($filtro_periodo)
    {
        return $this->repository->list($filtro_periodo);
    }
    public function pagamentoPorMetodo($filtro_periodo)
    {
        return $this->repository->pagamentoPorMetodo($filtro_periodo);
    }
    

}
