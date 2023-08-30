<?php

namespace App\Repositories;

use App\Models\Pagamento;
use Illuminate\Support\Facades\DB;

class PagamentoRepository
{
   private $model;
   
   public function __construct(Pagamento $_model)
   {
      $this->model = $_model;
   }

   public function list($filtro_periodo) {
      return $this->model
      ->whereDate('dataPagamento','>=',$filtro_periodo["start_date"])
      ->whereDate('dataPagamento','<=',$filtro_periodo["end_date"])
      ->orderBy('created_at', 'DESC')->get();
   }

   public function pagamentoPorMetodo($filtro_periodo) {
      return DB::select("SELECT 
         mp.nome as nomeMetodoPagamento,
         SUM(p.montante) as totalMontante
      FROM 
         `pagamento` p
         LEFT JOIN metodo_pagamento mp ON (mp.id = p.idMetodoPagamento)
      WHERE 
         DATE(p.dataPagamento) >= ? AND 
         DATE(p.dataPagamento) <= ?
      GROUP BY
         nomeMetodoPagamento
      ", [$filtro_periodo["start_date"], $filtro_periodo["end_date"]]);
   }

   public function get($id){
      return $this->model->find($id);
   }

   public function getByName($name){
      return $this->model->firstWhere('name', $name);
   }

   public function storeORUpdate($id, $data){
      $d = $this->model->find($id);
      if($d) {
         return $d->update($data);
      } else {
         return $this->model->create($data);
      }
   }

   public function store($data){
      return $this->model->create($data);
   }

    public function update($id, $data){
      $d = $this->model->find($id);
      if($d) {
         return $d->update($data);
      }
      return false;
    }

    public function delete($id){
        return $this->model->find($id)->delete();
    }

}