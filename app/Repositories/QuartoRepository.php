<?php

namespace App\Repositories;

use DateTime;
use App\Models\Quarto;
use App\Models\CheckinConfig;
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

   public function todayDisponibilities() {
      $numDias = 1;
      
      //Calculate EndDate
      $config = CheckinConfig::find(1);
      $tempoInicio = date('d/m/Y').' '.$config->horaCheckin.':'.($config->minuteCheckin<10?'0'.$config->minuteCheckin:$config->minuteCheckin);
      $tempoFim = date('d/m/Y', strtotime('+ 1 days')).' '.$config->horaCheckout.':'.($config->minuteCheckout<10?'0'.$config->minuteCheckout:$config->minuteCheckout);

      $start_date = DateTime::createFromFormat('d/m/Y H:i', $tempoInicio)->format('Y-m-d H:i');
      $end_date = DateTime::createFromFormat('d/m/Y H:i', $tempoFim)->format('Y-m-d H:i');

      //dd($start_date.' - '.$end_date);
      $sql = "SELECT 
         q.id,
         tq.nome as nomeTipoQuarto,
         eq.cor as corEstadoQuarto,
         eq.icon as iconEstadoQuarto,
         eq.nome as nomeEstadoQuarto,
         q.`nome`,
         q.`numero`,
         q.`idTipoQuarto`,
         q.`idEstadoQuarto`,
         q.`limit_adulto`,
         q.`limit_crianca`,
         q.`preco`,
         (q.`preco`*?) as valor,
         (q.limit_adulto + q.limit_crianca) as totalHospedes,
         (
            SELECT 
               COUNT(*)
            FROM
               reserva r
            WHERE
               r.idQuarto = q.id AND
               r.idEstadoReserva IN (1,2) AND
               (
                  r.dataInicio <= '".$start_date."' AND 
                  r.dataFim >= '".$end_date."'
               )
         ) as is_reserved,
         (
            SELECT 
               r.dataFim as dataFim
            FROM
               reserva r
            WHERE
               r.idQuarto = q.id AND
               r.idEstadoReserva IN (1,2) AND
               (
                  r.dataInicio <= '".$start_date."' AND 
                  r.dataFim >= '".$end_date."'
               )
            LIMIT 1
         ) as fimReserva,
         (
            SELECT 
               r.dataInicio as dataInicio
            FROM
               reserva r
            WHERE
               r.idQuarto = q.id AND
               r.idEstadoReserva IN (1,2) AND
               (
                  r.dataInicio > '".$end_date."'
               )
            LIMIT 1
         ) as inicioReserva
   FROM 
      `quarto` q 
      LEFT JOIN tipo_quarto tq ON (tq.id=q.idTipoQuarto)
      LEFT JOIN comodidade_quarto cq ON (cq.idQuarto = q.id)
      LEFT JOIN servico_quarto sq ON (sq.idQuarto = q.id)
      LEFT JOIN estado_quarto eq ON (eq.id = q.idEstadoQuarto)
   WHERE 
      q.`idEstadoQuarto` >= 1
   GROUP BY 
      q.id
   ORDER BY 
      eq.ordem ASC,
      is_reserved ASC,
      fimReserva ASC,
      inicioReserva ASC";

      //dd($sql);
      return DB::select($sql,[$numDias]);
   }

   public function pesquisa_quarto($filters=array()) {

      $numDias = 1;
      if(!empty($filters["filtro_numDias"])) {
         $numDias = $filters["filtro_numDias"];
      }
      if(!empty($filters["filtro_data"])) {
         if($numDias>0) {
            //Calculate EndDate
            $config = CheckinConfig::find(1);
            $_datetime = $filters["filtro_data"].' '.$config->horaCheckin.':'.($config->minuteCheckin<10?'0'.$config->minuteCheckin:$config->minuteCheckin);

            $datetime = DateTime::createFromFormat('d/m/Y H:i', $_datetime);
            $start_date = $datetime->format('Y-m-d H:i');
            $end_date = $datetime->modify("+{$numDias} days")->format('Y-m-d H:i');
            //dd($start_date.' => '.$end_date);
         }
      }
      //AND (DATE(r.dataInicio) >= ".$start_date." AND DATE(r.dataFim) <= ".$end_date.")
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
         (q.`preco`*?) as valor,
         (
            SELECT 
               COUNT(*)
            FROM
               reserva r
            WHERE
               r.idQuarto = q.id AND
               r.idEstadoReserva IN (1,2) AND
               (
                  r.dataFim >= '".$start_date."' AND 
                  r.dataInicio <= '".$end_date."'
               )
         ) as is_reserved
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
         $sql.=" AND q.limit_adulto >= ".$filters["filtro_numAdulto"]."";
      }
      if(!empty($filters["filtro_numCrianca"])) {
         $sql.=" AND q.limit_crianca >= ".$filters["filtro_numCrianca"]."";
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

      $sql.=" GROUP BY 
            q.id
         HAVING
            is_reserved = 0
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