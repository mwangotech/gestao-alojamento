<?php

namespace App\Services;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Repositories\ProvinciaRepository;
use Illuminate\Http\RedirectResponse;

class ProvinciaService
{
    private $repository;
    public function __construct(ProvinciaRepository $_repository)
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
        $filter_country_id = $request->input('filter_country_id');
        $res = $this->repository->autocomplete($filter_country_id, $filter_name);
        return response()->json($res, 200);
    }
    

}
