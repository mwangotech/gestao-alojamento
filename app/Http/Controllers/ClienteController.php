<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Genero;
use App\Models\Cliente;
use App\Models\Reserva;
use App\Models\Pagamento;
use Illuminate\View\View;
use App\Models\EstadoCivil;
use App\Models\TipoCliente;
use Illuminate\Http\Request;
use App\Services\ClienteService;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ClienteRequest;
use Illuminate\Http\RedirectResponse;

class ClienteController extends Controller
{
    private $service;
    public function __construct(ClienteService $_Service)
    {
       $this->service = $_Service;
    }

    public function pesquisa_cliente(Request $request)
    {
        $clientes = $this->service->pesquisa_cliente($request);
        $content = array(
            'success'=>true,
            'data'=>view('pages.cliente.listaCliente',compact('clientes'))->render()
        );
        return response()->json($content, 200);
    }
    
    /**

    * Display a listing of the resource.

    */
    public function index(Request $request): View
    {
        $clientes = $this->service->list();

        $breadcrumbs = array(
            ['name'=> 'Dashboard','url' => route('dashboard'),'active' => 0],
            ['name'=> 'Cliente','url' => '','active' => 1]
        );
        return view('pages.cliente.index',compact('clientes','breadcrumbs'))->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
    * Display the specified resource.
    */
    public function show(Cliente $cliente): View
    {
        $reservas = Reserva::where('idCliente', $cliente->id)->orderBy('idEstadoReserva')->orderBy('dataInicio', 'DESC')->get();
        $pagamentos = Pagamento::where('idCliente', $cliente->id)->orderBy('dataPagamento', 'DESC')->get();;

        $breadcrumbs = array(
            ['name'=> 'Dashboard','url' => route('dashboard'),'active' => 0],
            ['name'=> 'Cliente','url' => route('clientes.index'),'active' => 0],
            ['name'=> 'Detalhes','url' => '','active' => 1]
        );
        return view('pages.cliente.show', compact('cliente','breadcrumbs','reservas','pagamentos'));
    }

    /**
 
    * Show the form for creating a new resource.

    */
    public function create(): View
    {
        $tipos = TipoCliente::where('estado', 1)->get();
        $generos = Genero::where('estado', 1)->get();
        $estadoCivils = EstadoCivil::where('estado', 1)->get();
        $breadcrumbs = array(
            ['name'=> 'Dashboard','url' => route('dashboard'),'active' => 0],
            ['name'=> 'Cliente','url' => route('clientes.index'),'active' => 0],
            ['name'=> 'Novo','url' => '','active' => 1]
        );
        return view('pages.cliente.create',compact('breadcrumbs', 'tipos','generos','estadoCivils'));
    }

    /**
 
    * Store a newly created resource in storage.

    */
    public function store(ClienteRequest $request): RedirectResponse
    {        
        $data = $request->all();
        //dd($data);
        $this->gravarNovoCliente($data);
        //errors

        return redirect()->route('clientes.index')->with('success','Cliente criado com sucesso.');
    }
    
    private function gravarNovoCliente($data) {
        return DB::transaction(function () use ($data) {
            //Check if BI Exists
            $exist = Cliente::where('BI', $data["BI"])->first();
            if($exist) {
                return false;
            }
           return Cliente::create($data);
        });
    }

    public function cadastro_quarto(Request $request)
    {
        $data = $request->all();
        try {
            $cliente = $this->gravarNovoCliente($data);
            if($cliente) {
                $content = array(
                    'success'=>true,
                    'data'=>$cliente
                );
            } else {
                $exist = Cliente::where('BI', $data["BI"])->first();
                $content = array(
                    'success'=>false,
                    'exists' => $exist,
                    'message'=> "Cliente já cadastrado anteriormente!"
                );
            }
        }catch(Exception $e){
            $content = array(
                'success'=>false,
                'message'=> "Erro ao criar o cliente!"
            );
        }
        
        
        return response()->json($content, 200);
    }
    
    /**
    * Show the form for editing the specified resource.
    */
    public function edit(Cliente $cliente): View
    {
        $tipos = TipoCliente::where('estado', 1)->get();
        $generos = Genero::where('estado', 1)->get();
        $estadoCivils = EstadoCivil::where('estado', 1)->get();
        $breadcrumbs = array(
            ['name'=> 'Dashboard','url' => route('dashboard'),'active' => 0],
            ['name'=> 'Cliente','url' => route('clientes.index'),'active' => 0],
            ['name'=> 'Editar','url' => '','active' => 1]
        );
        return view('pages.cliente.edit',compact('cliente','breadcrumbs','tipos','generos','estadoCivils'));
    }

    /** 
    * Update the specified resource in storage.
    */
    public function update(ClienteRequest $request, Cliente $cliente): RedirectResponse
    { 
        $data = $request->all();
        DB::transaction(function () use ($cliente, $data) {
            $cliente->update($data);

            /*if(count($data["cliente_comodidade"])) {
                $cliente->comodidades()->sync($data["cliente_comodidade"]);
            }
            if(count($data["cliente_servico"])) {
                $cliente->servicos()->sync($data["cliente_servico"]);
            }*/
        });
        return redirect()->route('clientes.index')->with('success','Cliente atualizado com sucesso.');
    }



    /**
    * Remove the specified resource from storage.
    */
    public function destroy(Cliente $cliente): RedirectResponse
    {
        $cliente->delete();

        return redirect()->route('clientes.index')->with('success','Cliente eliminado com sucesso!');
    }
}
