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

    public function getMenuList($perfil_ids, $rota_activa) {
        $parents = $this->getParentMenuList($perfil_ids);
        foreach($parents as $key => $parent) {
            $tem_filho_activo = false;
            if($parent->route == $rota_activa) {
                $parents[$key]->activo = true;
            } else {
                $parents[$key]->activo = false;
            }
            $childs = $this->getChildMenuList($perfil_ids, $parent->id);
            foreach($childs as $keyC => $child) {
                if($child->route == $rota_activa) {
                    $childs[$keyC]->activo = true;
                    $tem_filho_activo = true;
                } else {
                    $childs[$keyC]->activo = false;
                }
            }
            if($tem_filho_activo) {
                $parents[$key]->tem_filho_activo = true;
            } else {
                $parents[$key]->tem_filho_activo = false;
            }
            $parents[$key]->childs = $childs;
        }
        return $parents;
    }
    public function getParentMenuList($perfil_ids)
    {
        $sql = "SELECT 
            m.*
        FROM 
            `menu` m,
            perfil_menu pm
        WHERE 
            m.id = pm.idMenu AND 
            m.`idMenu` IS NULL AND 
            pm.idPerfil IN (".join(',',$perfil_ids).")
        ";
        return DB::select($sql) ?? [];
    }

    public function getChildMenuList($perfil_ids, $parent_id)
    {
        $sql = "SELECT 
            m.*
        FROM 
            `menu` m,
            perfil_menu pm
        WHERE 
            m.id = pm.idMenu AND 
            m.`idMenu` = ".(int)$parent_id." AND 
            pm.idPerfil IN (".join(',',$perfil_ids).")
        ";
        return DB::select($sql) ?? [];
    }
}
