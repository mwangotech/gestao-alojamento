<?php

namespace App\Repositories;

use App\Models\Reserva;
use Illuminate\Support\Facades\DB;

class ReservaRepository
{
   private $model;
   
    public function __construct(Reserva $_model)
    {
        $this->model = $_model;
    }

    public function list($limit=20) {
        return $this->model->orderBy('dataInicio', 'ASC')->orderBy('idEstadoReserva', 'ASC')->orderBy('qtdDias', 'ASC')->get();
    }
    public function autocomplete($filter_name) {
        if(!empty($filter_name)) {
            return $this->model->where('nome', 'LIKE', "%{$filter_name}%")->limit(6)->get();
        } else {
            return $this->model->limit(6)->get();
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