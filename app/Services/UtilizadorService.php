<?php

namespace App\Services;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Repositories\UtilizadorRepository;
use Illuminate\Http\RedirectResponse;

class UtilizadorService
{
    private $repository;
    public function __construct(UtilizadorRepository $_repository)
    {
        $this->repository = $_repository;
    }

    public function list()
    {
        return $this->repository->list();
    }

}
