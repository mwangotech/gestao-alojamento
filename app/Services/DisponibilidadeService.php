<?php

namespace App\Services;
use App\Repositories\DisponibilidadeRepository;

class DisponibilidadeService
{
    private $repository;
    public function __construct(DisponibilidadeRepository $_repository)
    {
        $this->repository = $_repository;
    }

    public function list()
    {
        return $this->repository->list();
    }

}
