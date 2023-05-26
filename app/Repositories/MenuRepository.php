<?php

namespace App\Repositories;

use App\Models\Menu;
use Illuminate\Support\Facades\DB;

class MenuRepository
{
   private $model;
   
   public function __construct(Menu $_model)
   {
      $this->model = $_model;
   }

   public function list($limit=20) {
      return $this->model->paginate($limit);
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