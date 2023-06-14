<?php

namespace App\Services;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Repositories\ServicoRepository;
use Illuminate\Http\RedirectResponse;

class ServicoService
{
    private $repository;
    public function __construct(ServicoRepository $_repository)
    {
        $this->repository = $_repository;
    }

    public function list()
    {
        return $this->repository->list();
    }

    public function autocomplete(Request $request)
    {
        $filter_name = $request->input('filter_name');
        $res = $this->repository->autocomplete($filter_name);
        return response()->json($res, 200);
    }
    

}
