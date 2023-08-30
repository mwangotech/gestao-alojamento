<?php

namespace App\Http\Controllers;
use PDF;
use App\Models\Perfil;
use App\Models\Pagamento;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Services\DashboardService;
use App\Services\PagamentoService;
use App\Http\Requests\PerfilRequest;
use Illuminate\Http\RedirectResponse;
use Symfony\Component\Console\Input\Input;

class PagamentoController extends Controller
{
    private $service;
    private $dashboardService;
    public function __construct(PagamentoService $_Service, DashboardService $_dashboardService)
    {
       $this->service = $_Service;
       $this->dashboardService = $_dashboardService;
    }

    /**

    * Display a listing of the resource.

    */
    public function index(Request $request): View
    {
        $periodo_selecionado = 1;
        $getAnalisysPeriods = $this->dashboardService->getAnalisysPeriods();

        $filtro_periodo = array();
        if($request->periodo){
            $periodo_selecionado = $request->periodo;
        } 
            
        $filtro_periodo = $getAnalisysPeriods[$periodo_selecionado];
        
        $pagamentos = $this->service->list($filtro_periodo);

        //dd($getAnalisysPeriods);
        $breadcrumbs = array(
            ['name'=> 'Dashboard','url' => route('dashboard'),'active' => 0],
            ['name'=> 'Pagamentos','url' => '','active' => 1]
        );
        return view('pages.relatorio.pagamentos',compact('pagamentos','breadcrumbs','getAnalisysPeriods','periodo_selecionado'))->with('i', ($request->input('page', 1) - 1) * 5);    }
    

    public function downloadPagamentos(Request $request) 
    {
        $periodo_selecionado = 1;
        $getAnalisysPeriods = $this->dashboardService->getAnalisysPeriods();

        $filtro_periodo = array();
        if($request->periodo){
            $periodo_selecionado = $request->periodo;
        } 
            
        $filtro_periodo = $getAnalisysPeriods[$periodo_selecionado];
        
        $pagamentos = $this->service->list($filtro_periodo);
        $pagamentoPorMetodos = $this->service->pagamentoPorMetodo($filtro_periodo);
        
        $html = view('pages.relatorio.pdfPagamentos',compact('pagamentos','pagamentoPorMetodos','filtro_periodo'))->render();
        
        $pdf = PDF::loadHTML($html)->setOptions(['defaultFont' => 'sans-serif']);;
     
        $export_filename = "pagamentos_".date('YmdHis').".pdf";
        return $pdf->download($export_filename);
    }
    /**
 
    * Show the form for creating a new resource.

    */
    public function create(): View
    {
        $breadcrumbs = array(
            ['name'=> 'Dashboard','url' => route('dashboard'),'active' => 0],
            ['name'=> 'Perfil','url' => route('perfis.index'),'active' => 0],
            ['name'=> 'Novo','url' => '','active' => 1]
        );
        return view('pages.perfil.create',compact('breadcrumbs'));
    }

    /**
 
    * Store a newly created resource in storage.

    */
    public function store(PerfilRequest $request): RedirectResponse
    {        
        Perfil::create($request->all());

        return redirect()->route('perfis.index')->with('success','Perfil criado com sucesso.');
    }

    /**
    * Show the form for editing the specified resource.
    */
    public function edit(Perfil $perfil): View
    {
        $breadcrumbs = array(
            ['name'=> 'Dashboard','url' => route('dashboard'),'active' => 0],
            ['name'=> 'Perfil','url' => route('perfis.index'),'active' => 0],
            ['name'=> 'Editar','url' => '','active' => 1]
        );
        return view('pages.perfil.edit',compact('perfil','breadcrumbs'));
    }

    /** 
    * Update the specified resource in storage.
    */
    public function update(PerfilRequest $request, Perfil $perfil): RedirectResponse
    { 
        $perfil->update($request->all());

        return redirect()->route('perfis.index')->with('success','Perfil atualizado com sucesso.');
    }



    /**
    * Remove the specified resource from storage.
    */
    public function destroy(Perfil $perfil): RedirectResponse
    {
        $perfil->utilizadores()->detach();
        $perfil->menus()->detach();
        $perfil->delete();

        return redirect()->route('perfis.index')->with('success','Perfil eliminado com sucesso!');
    }
}
