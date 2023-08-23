<?php

namespace App\Services;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Repositories\ClienteRepository;
use Illuminate\Http\RedirectResponse;

class ClienteService
{
    private $repository;
    public function __construct(ClienteRepository $_repository)
    {
        $this->repository = $_repository;
    }

    public function list()
    {
        return $this->repository->list();
    }

    public function pesquisa_cliente(Request $request)
    {
        $filters = array(
            'filter_name' => $request->input('filter_name') ?? null,
            'filter_bi' => $request->input('filter_bi') ?? null,
            'filter_telefone' => $request->input('filter_telefone') ?? null,
            'filter_email' => $request->input('filter_email') ?? null,
        );
        return $this->repository->pesquisa_cliente($filters);
    }
    
}
