<?php

namespace App\Repositories;

use App\Models\User;
use App\Traits\DatabaseFunctions;
use Illuminate\Support\Facades\DB;

class AuthRepository
{
    use DatabaseFunctions;
    private $model;

    public function __construct(User $_model)
    {
        $this->model = $_model;
    }

    public function get($id)
    {
        return $this->model->find($id);
    }

    public function getByName($name)
    {
        $sql =
            "SELECT id,name FROM rm_partner WHERE name LIKE '%" .
            $this->escape($name) .
            "%'" .
            ' LIMIT 10';
        return DB::select($sql) ?? [];
    }
}
