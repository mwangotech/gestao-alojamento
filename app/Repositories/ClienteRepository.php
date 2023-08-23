<?php

namespace App\Repositories;

use App\Models\Cliente;
use Illuminate\Support\Facades\DB;

class ClienteRepository
{
   private $model;
   
   public function __construct(Cliente $_model)
   {
      $this->model = $_model;
   }

   public function list($limit=20) {
    return $this->model->all();
   }

   public function pesquisa_cliente($filters=array()) {
         $query = $this->model::query();

         if(!empty($filters["filter_bi"])) {
            $query->where('BI', $filters["filter_bi"]);
         }
         if(!empty($filters["filter_name"])) {
            $query->where('nome', 'LIKE','%'.$filters["filter_name"].'%');
         }
         if(!empty($filters["filter_telefone"])) {
            $query->where('telefone', $filters["filter_telefone"]);
         }
         if(!empty($filters["filter_email"])) {
            $query->where('email', $filters["filter_email"]);
         }

         return $query->get();
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