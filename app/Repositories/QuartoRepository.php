<?php

namespace App\Repositories;

use DateTime;
use App\Models\Quarto;
use Illuminate\Support\Facades\DB;

class QuartoRepository
{
   private $model;
   
   public function __construct(Quarto $_model)
   {
      $this->model = $_model;
   }

   public function list($limit=20) {
    return $this->model->all();
   }

   public function pesquisa_quarto($filters=array()) {

      $numDias = 1;
      if(!empty($filters["filtro_numDias"])) {
         $numDias = $filters["filtro_numDias"];
      }

      $sql = "SELECT 
       q.id,
       tq.nome as nomeTipoQuarto,
       q.`nome`,
       q.`numero`,
       q.`idTipoQuarto`,
       q.`idEstadoQuarto`,
       q.`limit_adulto`,
       q.`limit_crianca`,
       q.`preco`,
       (q.`preco`*?) as valor
       
   FROM 
      `quarto` q 
      LEFT JOIN tipo_quarto tq ON (tq.id=q.idTipoQuarto)
      LEFT JOIN comodidade_quarto cq ON (cq.idQuarto = q.id)
      LEFT JOIN servico_quarto sq ON (sq.idQuarto = q.id)
   WHERE 
      q.`idEstadoQuarto` = 1";

      if(!empty($filters["filtro_idTipoQuarto"])) {
         $sql.=" AND q.idTipoQuarto= ".$filters["filtro_idTipoQuarto"]."";
      }
      if(!empty($filters["filtro_numAdulto"])) {
         $sql.=" AND q.limit_adulto <= ".$filters["filtro_numAdulto"]."";
      }
      if(!empty($filters["filtro_numCrianca"])) {
         $sql.=" AND q.limit_crianca <= ".$filters["filtro_numCrianca"]."";
      }
      if(!empty($filters["filtro_data"])) {
         if($numDias>0) {
            //Calculate EndDate
            $datetime = DateTime::createFromFormat('d/m/Y', $filters["filtro_data"]);
            $start_date = $datetime->format('Y-m-d');
            $end_date = $datetime->modify("+{$numDias} days")->format('Y-m-d');
            //dd($start_date.' => '.$end_date);
            //$sql.=" AND q.idTipoQuarto= ".$filters["filtro_numDias"]."";
         }
      }
      if(!empty($filters["filtro_comodidades"])) {
         $ids = array();
         foreach($filters["filtro_comodidades"] as $id) {
            $ids[] = $id;
         }
         $sql.=" AND cq.idComodidade IN (".join(',', $ids).")";
      }
      if(!empty($filters["filtro_servicos"])) {
         $ids = array();
         foreach($filters["filtro_servicos"] as $id) {
            $ids[] = $id;
         }
         $sql.=" AND sq.idServico IN (".join(',', $ids).")";
      }

      $sql.=" GROUP BY q.id
         ORDER BY 
            q.limit_adulto DESC,
            q.limit_crianca DESC";

      return DB::select($sql,[$numDias]);
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