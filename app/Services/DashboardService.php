<?php

namespace App\Services;
use DateTime;
use Illuminate\Http\Request;
use App\Repositories\DashboardRepository;

class DashboardService
{
    private $repository;
    public function __construct(DashboardRepository $_repository)
    {
        $this->repository = $_repository;
    }

    public function quartosOcupados()
    {
        return $this->repository->quartosOcupados()();
    }

    public function dashboardReservasPorEstados(Request $request)
    {
        $res = $this->repository->dashboardReservasPorEstados();
        return response()->json($res, 200);
    }

    public function dashboardFaturacaoSemanal(Request $request)
    {
        $filtro_p = $request->input('periodo') ?? null;
        $periodos = $this->getAnalisysPeriods();
        $res = $this->repository->dashboardFaturacaoSemanal($periodos[$filtro_p]);
        foreach($res as $key => $data) {
            $res[$key]->montante = (float)$data->montante;
            $res[$key]->nomeDiaSemana = $this->getMysqlWeekDayNamePT($data->diaSemana,true);
        }
        return response()->json($res, 200);
    }
    
    public function dashboardFaturacaoMensal(Request $request)
    {
        $filtro_p = $request->input('periodo') ?? null;
        $periodos = $this->getAnalisysPeriods();
        $res = $this->repository->dashboardFaturacaoMensal($periodos[$filtro_p]);
        foreach($res as $key => $data) {
            $res[$key]->montante = (float)$data->montante;
            $res[$key]->nomeMesAno = $this->getMonthNamePT($data->mes,true)."(".$data->ano.")";
        }
        return response()->json($res, 200);
    }
    
    private function getAnalisysPeriods() {
        $today = new DateTime("today");
        $yesterday = new DateTime("yesterday");
        $same_day_last_week=new DateTime("last ".$today->format("l"));
        $monday_of_this_week=new DateTime("monday this week");
        $monday_of_last_week=new DateTime("monday last week");
        $sunday_of_last_week=new DateTime("sunday last week");
        $first_day_of_this_month=new DateTime('first day of this month');
        $first_day_of_last_month=new DateTime('first day of last month');
        $last_day_of_last_month=new DateTime('last day of last month');
        $seven_days_ago=new DateTime('-7 days');
        $thirty_days_ago=new DateTime('-30 days');
        $sixty_days_ago=new DateTime('-60 days');
        $ninety_days_ago=new DateTime('-90 days');
        $onehundredeighty_days_ago=new DateTime('-180 days');
        $last_year_ago = new DateTime('-12 months');

        $first_day_of_last_month_last_year=new DateTime('first day of last month last year');
        $last_day_of_last_month_last_year=new DateTime('last day of last month last year');

        $first_day_of_this_month_last_year=new DateTime('first day of this month last year');
        $last_day_of_this_month_last_year=new DateTime('last day of this month last year');

        $days_from_start=$today->diff($first_day_of_this_month)->days;

        $homolog_day_last_month=new DateTime('first day of last month');
        $homolog_day_last_month->modify('+'.$days_from_start.' day');

        $homolog_day_last_month_last_year=new DateTime('first day of last month last year');
        $homolog_day_last_month_last_year->modify('+'.$days_from_start.' day');

        $homolog_day_this_month_last_year=new DateTime('first day of this month last year');
        $homolog_day_this_month_last_year->modify('+'.$days_from_start.' day');


        $first_day_of_this_year=new DateTime('first day of January '.date('Y') );
        $first_day_of_last_year=new DateTime('first day of last year');

        $periods=array(

            1=>array(
                'id'=>1,
                'name'=>'Hoje',
                'start_date'=>$today->format('Y-m-d'),
                'end_date'=>$today->format('Y-m-d')
            ),
            2=>array(
                'id'=>2,
                'name'=>'Ontem',
                'start_date'=>$yesterday->format('Y-m-d'),
                'end_date'=>$yesterday->format('Y-m-d')
            ),
            3=>array(
                'id'=>3,
                'name'=> $this->getWeekDayNamePT($today->format("N")).' da Semana Passada',
                'start_date'=>$same_day_last_week->format('Y-m-d'),
                'end_date'=>$same_day_last_week->format('Y-m-d'),
            ),
            4=>array(
                'id'=>4,
                'name'=>'Esta Semana',
                'start_date'=>$monday_of_this_week->format('Y-m-d'),
                'end_date'=>$today->format('Y-m-d')
            ),
            5=>array(
                'id'=>5,
                'name'=>'Semana Passada',
                'start_date'=>$monday_of_last_week->format(('Y-m-d')),
                'end_date'=>$sunday_of_last_week->format('Y-m-d'),
            ),
            6=>array(
                'id'=>6,
                'name'=>'Este mês ('.$this->getMonthNamePT($first_day_of_this_month->format('m')).')',
                'start_date'=>$first_day_of_this_month->format('Y-m-d'),
                'end_date'=>$today->format('Y-m-d')
            ),
            12=>array(
                'id'=>12,
                'name'=>'Este Mês ('.$this->getMonthNamePT($first_day_of_this_month_last_year->format('m')).') no Ano passado',
                'start_date'=>$first_day_of_this_month_last_year->format('Y-m-d'),
                'end_date'=>$last_day_of_this_month_last_year->format('Y-m-d')
            ),
            19=>array(
                'id'=>19,
                'name'=>'Periodo homologo deste Mês ('.$this->getMonthNamePT($first_day_of_this_month_last_year->format('m')).') no Ano passado',
                'start_date'=>$first_day_of_this_month_last_year->format('Y-m-d'),
                'end_date'=>$homolog_day_this_month_last_year->format('Y-m-d')
            ),

            7=>array(
                'id'=>7,
                'name'=>'Mês Passado ('.$this->getMonthNamePT($first_day_of_last_month->format('m')).')',
                'start_date'=>$first_day_of_last_month->format('Y-m-d'),
                'end_date'=>$last_day_of_last_month->format('Y-m-d')
            ),
            14=>array(
                'id'=>14,
                'name'=>'Periodo homologo do Mês passado ('.$this->getMonthNamePT($first_day_of_last_month->format('m')).')',
                'start_date'=>$first_day_of_last_month->format('Y-m-d'),
                'end_date'=>$homolog_day_last_month->format('Y-m-d')
            ),
            13=>array(
                'id'=>13,
                'name'=>'Mês passado ('.$this->getMonthNamePT($first_day_of_last_month_last_year->format('m')).') do Ano passado ('.$first_day_of_last_month_last_year->format('Y').')',
                'start_date'=>$first_day_of_last_month_last_year->format('Y-m-d'),
                'end_date'=>$last_day_of_last_month_last_year->format('Y-m-d')
            ),
            15=>array(
                'id'=>15,
                'name'=>'Periodo homologo do Mês passado ('.$this->getMonthNamePT($first_day_of_last_month_last_year->format('m')).') do Ano Passado ('.$first_day_of_last_month_last_year->format('Y').')',
                'start_date'=>$first_day_of_last_month_last_year->format('Y-m-d'),
                'end_date'=>$homolog_day_last_month_last_year->format('Y-m-d')
            ),

            8=>array(
                'id'=>8,
                'name'=>'Ultimos 7 Dias',
                'start_date'=>$seven_days_ago->format('Y-m-d'),
                'end_date'=>$today->format('Y-m-d')
            ),
            9=>array(
                'id'=>9,
                'name'=>'Ultimos 30 Dias',
                'start_date'=>$thirty_days_ago->format('Y-m-d'),
                'end_date'=>$today->format('Y-m-d')
            ),
            10=>array(
                'id'=>10,
                'name'=>'Ultimos 60 Dias',
                'start_date'=>$sixty_days_ago->format('Y-m-d'),
                'end_date'=>$today->format('Y-m-d')
            ),
            11=>array(
                'id'=>11,
                'name'=>'Ultimos 90 Dias',
                'start_date'=>$ninety_days_ago->format('Y-m-d'),
                'end_date'=>$today->format('Y-m-d')
            ),
            16=>array(
                'id'=>16,
                'name'=>'Ultimos 180 Dias',
                'start_date'=>$onehundredeighty_days_ago->format('Y-m-d'),
                'end_date'=>$today->format('Y-m-d')
            ),
            20=>array(
                'id'=>16,
                'name'=>'Ultimos 12 Mêses',
                'start_date'=>$last_year_ago->format('Y-m-01'),
                'end_date'=>$today->format('Y-m-d')
            ),
            17=>array(
                'id'=>17,
                'name'=>'Este Ano',
                'start_date'=>$first_day_of_this_year->format('Y-m-d'),
                'end_date'=>$today->format('Y-m-d')
            ),
            18=>array(
                'id'=>18,
                'name'=>'Ano Passado',
                'start_date'=>$first_day_of_last_year->format('Y-m-d'),
                'end_date'=>$today->format('Y-m-d')
            ),



        );
        return $periods;
    }

    private function getWeekDayNamePT($weekday,$short=false) {
        $d=array(
            '1'=>array('short'=>'Seg','long'=>'Segunda-Feira'),
            '2'=>array('short'=>'Ter','long'=>'Terça-Feira'),
            '3'=>array('short'=>'Qua','long'=>'Quarta-Feira'),
            '4'=>array('short'=>'Qui','long'=>'Quinta-Feira'),
            '5'=>array('short'=>'Sex','long'=>'Sexta-Feira'),
            '6'=>array('short'=>'Sab','long'=>'Sabado'),
            '7'=>array('short'=>'Dom','long'=>'Domingo'),
        );

        if(isset($d[$weekday])) {
            if($short) {
                return $d[$weekday]['short'];
            } else {
                return $d[$weekday]['long'];
            }
        }
        return false;
    }
    
    private function getMysqlWeekDayNamePT($weekday,$short=false) {
        $d=array(
            '0'=>array('short'=>'Seg','long'=>'Segunda-Feira'),
            '1'=>array('short'=>'Ter','long'=>'Terça-Feira'),
            '2'=>array('short'=>'Qua','long'=>'Quarta-Feira'),
            '3'=>array('short'=>'Qui','long'=>'Quinta-Feira'),
            '4'=>array('short'=>'Sex','long'=>'Sexta-Feira'),
            '5'=>array('short'=>'Sab','long'=>'Sabado'),
            '6'=>array('short'=>'Dom','long'=>'Domingo'),
        );

        if(isset($d[$weekday])) {
            if($short) {
                return $d[$weekday]['short'];
            } else {
                return $d[$weekday]['long'];
            }
        }
        return false;
    }
    private function getMonthNamePT($month,$short=false) {
        $month=(int)$month;
        $d=array(
            '1'=>array('short'=>'Jan','long'=>'Janeiro'),
            '2'=>array('short'=>'Fev','long'=>'Fevereiro'),
            '3'=>array('short'=>'Mar','long'=>'Março'),
            '4'=>array('short'=>'Abr','long'=>'Abril'),
            '5'=>array('short'=>'Mai','long'=>'Maio'),
            '6'=>array('short'=>'Jun','long'=>'Junho'),
            '7'=>array('short'=>'Jul','long'=>'Julho'),
            '8'=>array('short'=>'Ago','long'=>'Agosto'),
            '9'=>array('short'=>'Set','long'=>'Setembro'),
            '10'=>array('short'=>'Out','long'=>'Outubro'),
            '11'=>array('short'=>'Nov','long'=>'Novembro'),
            '12'=>array('short'=>'Dez','long'=>'Dezembro'),
        );

        if(isset($d[$month])) {
            if($short) {
                return $d[$month]['short'];
            } else {
                return $d[$month]['long'];
            }
        }
        return false;
    }

}
