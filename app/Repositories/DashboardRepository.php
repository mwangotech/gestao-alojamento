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

   public function dashboardReservasPorEstados($period) {    
      return DB::select("SELECT 
         er.nome as label,
         COUNT(*) as valor
      FROM 
         `reserva` r
         LEFT JOIN estado_reserva er ON (er.id = r.`idEstadoReserva`)
      WHERE 
         r.`created_at` >= ? AND 
         r.`created_at` <= ?
      GROUP BY
         label
      ",[$period['start_date'], $period['end_date']]);
   }

   public function dashboardFaturacaoPorPeriodo($period) {
      return DB::select("SELECT 
      DAY(`dataPagamento`) as dia,
      WeekDay(`dataPagamento`) as diaSemana,
      MONTH(`dataPagamento`) as mes,
      SUM(`montante`) as montante
   FROM 
   `pagamento`
   WHERE 
      DATE(`dataPagamento`) >= ? AND 
      DATE(`dataPagamento`) <= ?
   GROUP BY 
      dia,
      diaSemana,
      mes
   ORDER BY
      mes,
      dia
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
      ORDER BY 
         ano, mes
      ",[$period['start_date'],$period['end_date']]);
   }
}