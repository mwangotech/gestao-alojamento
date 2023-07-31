<?php

namespace App\Services;
use App\Repositories\ReservaRepository;

class ReservaService
{
    private $repository;
    public function __construct(ReservaRepository $_repository)
    {
        $this->repository = $_repository;
    }

    public function list()
    {
        return $this->repository->list();
    }

}
