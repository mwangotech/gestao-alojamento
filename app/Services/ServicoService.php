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

}
