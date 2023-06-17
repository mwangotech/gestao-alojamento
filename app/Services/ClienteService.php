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

}
