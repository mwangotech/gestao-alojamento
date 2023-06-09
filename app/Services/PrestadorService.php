<?php

namespace App\Services;
use App\Repositories\PrestadorRepository;

class PrestadorService
{
    private $repository;
    public function __construct(PrestadorRepository $_repository)
    {
        $this->repository = $_repository;
    }

    public function list()
    {
        return $this->repository->list();
    }

}
