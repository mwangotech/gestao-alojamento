@extends('layouts.master')
@section('title', 'Detalhes do Cliente')
 
@section('content')
<div class="row">
    <div class="col-sm-12 col-md-3">
        <div class="card card-primary card-outline">
            <div class="card-body box-profile">
               <h3 class="profile-username text-center">{{ $cliente->nome }}</h3>
               <p class="text-muted text-center">{{ $cliente->nomeTipo }}</p>
               <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <strong class="text-info"><i class="fas fa-venus-mars mr-1"></i> Género</strong> <span class="float-right">{{ $cliente->nomeGenero }}</span>
                  </li>
                  <li class="list-group-item">
                    <strong class="text-info"><i class="fas fa-venus-double mr-1"></i> Estado Civil</strong> <span class="float-right">{{ $cliente->nomeEstadoCivil }}</span>
                  </li>
                  <li class="list-group-item">
                    <strong class="text-info"><i class="fas fa-calendar mr-1"></i> Nascimento</strong> <span class="float-right">{{ $cliente->dataNascimento }}</span>
                  </li>
                  <li class="list-group-item">
                    <strong class="text-info"><i class="fas fa-globe mr-1"></i> Pais</strong> <span class="float-right">{{ $cliente->nomeNacionalidade }}</span>
                  </li>
                  <li class="list-group-item">
                    <strong class="text-info"><i class="fas fa-map-marker-alt mr-1"></i> Província</strong> <span class="float-right">{{ $cliente->nomeProvincia }}</span>
                  </li>
               </ul>
               <strong class="text-info"><i class="fas fa-envelope mr-1"></i> E-mail</strong>
               <p class="text-muted">{{ $cliente->email }}</p>
               <hr>
               <strong class="text-info"><i class="fas fa-phone-square mr-1"></i> Telefone</strong>
               <p class="text-muted">{{ $cliente->telefone }}</p>
               <hr>
               <strong class="text-info"><i class="fas fa-book mr-1"></i> Profissão</strong>
               <p class="text-muted">{{ $cliente->profissao }}</p>
            </div>
         </div>  
    </div>
    <div class="col-sm-12 col-md-9">
        <div class="card">
            <div class="card-header p-2">
               <ul class="nav nav-pills">
                  {{--<li class="nav-item"><a class="nav-link active" href="#timeline" data-toggle="tab">Actividades</a></li>--}}
                  {{--<li class="nav-item"><a class="nav-link" href="#documentos" data-toggle="tab">Documentos</a></li>--}}
                  <li class="nav-item"><a class="nav-link active" href="#reservas" data-toggle="tab">Reservas</a></li>
                  <li class="nav-item"><a class="nav-link" href="#pagamentos" data-toggle="tab">Pagamentos</a></li>
               </ul>
            </div>
            <div class="card-body">
               <div class="tab-content">
                  <div class="tab-pane active" id="reservas">
                     <div class="card-body">
                        <table class="table-home-search table table-bordered table-striped">
                           <thead>
                           <tr>
                                 <th width="10px">Cod.</th>
                                 <th>Quarto</th>
                                 <th class="text-center" width="50px">Hospedes</th>
                                 <th class="text-right" width="70px">Preço</th>
                                 <th class="text-right" width="50px">Nº Dias</th>
                                 <th class="text-right" width="70px">Valor</th>
                                 <th class="text-right" width="110px">Data Inicio</th>
                                 <th class="text-right" width="80px">Data Fim</th>
                                 <th class="text-center" width="70px">Estado</th>
                           </tr>
                           </thead>
                           <tbody>
                           @foreach ($reservas as $reserva)
                           <tr>
                                 <td>RN-{{ $reserva->id }}/<?php echo date("Y");?></td>
                                 <td><span class="right badge badge-info">{{ $reserva->numeroQuarto }}</span>&nbsp;&nbsp;{{ $reserva->nomeQuarto }}</td>
                                 <td class="text-center"><span class="right badge badge-primary"><i class="fas fa-male"></i>&nbsp;&nbsp;{{ $reserva->totalAdulto }}</span>&nbsp;<span class="right badge badge-info"><i class="fas fa-baby"></i>&nbsp;&nbsp;{{ $reserva->totalCrianca }}</span></td>
                                 <td class="text-right">{{number_format($reserva->preco,0,',',' ')}} kz</td>
                                 <td class="text-right">{{$reserva->qtdDias}} dias</td>
                                 <td class="text-right">{{number_format($reserva->valor,0,',',' ')}} kz</td>
                                 <td class="text-right">{{ $reserva->dataInicio }}</td>
                                 <td class="text-right">{{ $reserva->dataFim }}</td>
                                 <td class="text-center"><span class="right badge badge-{{ $reserva->corEstadoReserva }}">{{ $reserva->nomeEstadoReserva }}</span></td>
                           </tr>
                           @endforeach
                           </tbody>
                        </table>
                     </div>
                  </div>
                  <div class="tab-pane" id="pagamentos">
                     <div class="card-body">        
                        <table class="table-home-search table table-bordered table-striped">
                           <thead>
                           <tr>
                              <th width="10px">Cod.</th>
                              <th width="50px">Reserva</th>
                              <th class="text-right" width="100px">Valor</th>
                              <th class="text-center">Metodo</th>
                              <th class="text-center">Criado por</th>
                              <th  class="text-right" width="80px">Criado Em</th>
                           </tr>
                        </thead>
                           @foreach ($pagamentos as $pagamento)
                           <tr>
                              <td>{{ $pagamento->id }}</td>
                              <td>RN-{{ $pagamento->idReserva }}/<?php echo date("Y");?></td>
                              <td class="text-right">{{number_format($pagamento->montante,0,',',' ')}} kz</td>
                              <td class="text-center">{{ $pagamento->nomeMetodoPagamento }}</td>
                              <td class="text-center">{{ $pagamento->nomeUtilizador }}</td>
                              <td class="text-right">{{ $pagamento->created_at }}</td>
                           </tr>
                           @endforeach
                        </table>
                  </div>
                  </div>
               </div>
            </div>
        </div> 
    </div>
</div>
@endsection
@section('footer-scripts')
<script>
    
</script>  
@endsection