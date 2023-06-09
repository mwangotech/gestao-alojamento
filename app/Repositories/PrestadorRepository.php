<?php

namespace App\Repositories;

use App\Models\Prestador;
use Illuminate\Support\Facades\DB;

class PrestadorRepository
{
   private $model;
   
   public function __construct(Prestador $_model)
   {
      $this->model = $_model;
   }

   public function list($limit=20) {
    //return $this->model->paginate($limit);
    return $this->model->all();
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