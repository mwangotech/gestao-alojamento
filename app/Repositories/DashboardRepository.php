<?php

namespace App\Repositories;

use DateTime;
use Illuminate\Support\Facades\DB;

class DashboardRepository
{
   private $model;
   
   public function __construct()
   {
     
   }

   public function quartosOcupados() {    
      
   }

   public function dashboardReservasPorEstados() {    
      return DB::select("SELECT 
         er.nome as label,
         COUNT(*) as valor
      FROM 
         `reserva` r
         LEFT JOIN estado_reserva er ON (er.id = r.`idEstadoReserva`)
      WHERE 
         r.`dataInicio` >= ? AND 
         r.`dataInicio` <= ?
      GROUP BY
         label
      ",[date('Y-m-01'),date('Y-m-t')]);
   }

   public function dashboardFaturacaoSemanal($period) {
      return DB::select("SELECT 
      DAY(`dataPagamento`) as dia,
      WeekDay(`dataPagamento`) as diaSemana,
      SUM(`montante`) as montante
   FROM 
   `pagamento`
   WHERE 
      DATE(`dataPagamento`) >= ? AND 
      DATE(`dataPagamento`) <= ?
   GROUP BY 
      dia,
      diaSemana
      ",[$period['start_date'],$period['end_date']]);
   }
   
   public function dashboardFaturacaoMensal($period) {
      return DB::select("SELECT 
         MONTH(`dataPagamento`) as mes,
         YEAR(`dataPagamento`) as ano,
         SUM(`montante`) as montante
      FROM 
      `pagamento`
      WHERE 
         DATE(`dataPagamento`) >= ? AND 
         DATE(`dataPagamento`) <= ?
      GROUP BY 
         ano,
         mes
      ",[$period['start_date'],$period['end_date']]);
   }
}