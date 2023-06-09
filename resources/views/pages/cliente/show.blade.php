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
                  <li class="nav-item"><a class="nav-link active" href="#timeline" data-toggle="tab">Actividades</a></li>
                  <li class="nav-item"><a class="nav-link" href="#documentos" data-toggle="tab">Documentos</a></li>
                  <li class="nav-item"><a class="nav-link" href="#reservas" data-toggle="tab">Reservas</a></li>
                  <li class="nav-item"><a class="nav-link" href="#pagamentos" data-toggle="tab">Pagamentos</a></li>
               </ul>
            </div>
            <div class="card-body">
               <div class="tab-content">
                  <div class="tab-pane active" id="timeline">
                    <div class="timeline timeline-inverse">
                        <div class="time-label">
                           <span class="bg-success">
                           28 Jun. 2023
                           </span>
                        </div>
                        {{--<div>
                           <i class="fas fa-envelope bg-primary"></i>
                           <div class="timeline-item">
                              <span class="time"><i class="far fa-clock"></i> 12:05</span>
                              <h3 class="timeline-header"><a href="#">Support Team</a> sent you an email</h3>
                              <div class="timeline-body">
                                 Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
                                 weebly ning heekya handango imeem plugg dopplr jibjab, movity
                                 jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
                                 quora plaxo ideeli hulu weebly balihoo...
                              </div>
                              <div class="timeline-footer">
                                 <a href="#" class="btn btn-primary btn-sm">Read more</a>
                                 <a href="#" class="btn btn-danger btn-sm">Delete</a>
                              </div>
                           </div>
                        </div>--}}
                        <div>
                           <i class="fas fa-user bg-info"></i>
                           <div class="timeline-item">
                              <span class="time"><i class="far fa-clock"></i> Há 5 minutos</span>
                              <h3 class="timeline-header border-0"><a href="#">Maria Francisco</a> Finalizou a limpeza do quarto</h3>
                           </div>
                        </div>
                        <div>
                            <i class="fas fa-user bg-info"></i>
                            <div class="timeline-item">
                               <span class="time"><i class="far fa-clock"></i> Há 25 minutos</span>
                               <h3 class="timeline-header border-0"><a href="#">Maria Francisco</a> Iniciou a limpeza do quarto</h3>
                            </div>
                         </div>
                        <div>
                           <i class="fas fa-comments bg-warning"></i>
                           <div class="timeline-item">
                              <span class="time"><i class="far fa-clock"></i> Há 22 horas</span>
                              <h3 class="timeline-header"><a href="#">Recepção</a> Check-in Reserva #987</h3>
                              <div class="timeline-body">
                                 Está incluido na reserva os seguintes serviços: pequeno almoço, acesso a biblioteca
                              </div>
                           </div>
                        </div>
                        <div class="time-label">
                           <span class="bg-success">
                           3 Jan. 2014
                           </span>
                        </div>
                        <div>
                            <i class="fas fa-comments bg-warning"></i>
                            <div class="timeline-item">
                               <span class="time"><i class="far fa-clock"></i> Há 2 meses</span>
                               <h3 class="timeline-header"><a href="#">Recepção</a> check-out Reserva #587</h3>
                            </div>
                         </div>
                        <div>
                           <i class="far fa-clock bg-grey"></i>
                        </div>
                    </div>
                  </div>
                  <div class="tab-pane" id="documentos">
                    Documentos
                  </div>
                  <div class="tab-pane" id="reservas">
                    Reservas
                  </div>
                  <div class="tab-pane" id="pagamentos">
                    Pagamentos
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