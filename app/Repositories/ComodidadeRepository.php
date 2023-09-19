<?php

namespace App\Repositories;

use App\Models\Comodidade;
use Illuminate\Support\Facades\DB;

class ComodidadeRepository
{
   private $model;
   
   public function __construct(Comodidade $_model)
   {
      $this->model = $_model;
   }

   public function list($limit=20) {
    return $this->model->all();
   }
    public function autocomplete($filter_name) {
        if(!empty($filter_name)) {
            return $this->model->where('nome', 'LIKE', "%{$filter_name}%")->limit(10)->get();
        } else {
            return $this->model->limit(10)->get();
        }
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