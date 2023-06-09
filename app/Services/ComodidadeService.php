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

}
