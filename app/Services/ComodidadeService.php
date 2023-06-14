<?php

namespace App\Services;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Repositories\ComodidadeRepository;
use Illuminate\Http\RedirectResponse;

class ComodidadeService
{
    private $repository;
    public function __construct(ComodidadeRepository $_repository)
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
