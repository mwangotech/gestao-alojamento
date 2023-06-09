<?php

namespace App\Services;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Repositories\MenuRepository;
use Illuminate\Http\RedirectResponse;

class MenuService
{
    private $repository;
    public function __construct(MenuRepository $_repository)
    {
        $this->repository = $_repository;
    }

    public function list()
    {
        return $this->repository->list();
    }

}
