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
    public function get($id, Request $request)
    {
        $res = $this->repository->get($id);
        if ($res) {
        return response()->json(['success' => true, 'data' => $res], 200);
        }
        return response()->json(['message' => 'Data not found'], 404);
    }
    public function delete($id, Request $request)
    {
        $res = $this->repository->delete($id);
        if ($res) {
        return response()->json(['success' => $res], 200);
        }
        return response()->json(['message' => 'Data not found'], 404);
    }

}
