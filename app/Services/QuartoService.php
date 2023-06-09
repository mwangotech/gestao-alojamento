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

}
