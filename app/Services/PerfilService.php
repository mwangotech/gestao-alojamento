<?php

namespace App\Services;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Repositories\PerfilRepository;
use Illuminate\Http\RedirectResponse;

class PerfilService
{
    private $repository;
    public function __construct(PerfilRepository $_repository)
    {
        $this->repository = $_repository;
    }

    public function list()
    {
        return $this->repository->list();
    }

}
