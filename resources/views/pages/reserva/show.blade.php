@extends('layouts.master')
@section('title', 'Detalhes Reserva')
 
@section('content')
<div class="row">
    <div class="col-md-12">
        
    @include('components.messages')

    <input type="hidden" value="{{$reserva->id}}" id="input-idReserva">
    <input type="hidden" value="{{$reserva->idQuarto}}" id="input-idQuarto">
    <input type="hidden" value="{{$reserva->idCliente}}" id="input-idCliente">
      <div class="card card-default">
        <div class="card-body p-3">
            <div id="information-part">
                <div class="row">
                    <div class="col-md-6">
                        <div class="panel panel-default">
                           <table class="table">
                              <tbody>
                                <tr>
                                   <td style="width: 1%;"><button data-toggle="tooltip" title="" class="btn btn-info btn-xs" data-original-title="Nº da Reserva"><i class="fas fa-ticket-alt fa-fw"></i></button></td>
                                   <td>#{{$reserva->id}}</td>
                                </tr>
                                 <tr>
                                    <td style="width: 1%;"><button data-toggle="tooltip" title="" class="btn btn-info btn-xs" data-original-title="Cliente"><i class="fa fa-user fa-fw"></i></button></td>
                                    <td>{{$reserva->nomeCliente}}</td>
                                 </tr>
                                 <tr>
                                    <td style="width: 1%;"><button data-toggle="tooltip" title="" class="btn btn-info btn-xs" data-original-title="Tipo Cliente"><i class="fas fa-network-wired fa-fw"></i></button></td>
                                    <td>{{$cliente->nomeTipo}}</td>
                                 </tr>
                                 <tr>
                                    <td><button data-toggle="tooltip" title="" class="btn btn-info btn-xs" data-original-title="E-mail"><i class="fas fa-envelope fa-fw"></i></button></td>
                                    <td><a href="mailto:{{$cliente->email}}">{{$cliente->email}}</a></td>
                                 </tr>
                                 <tr>
                                    <td><button data-toggle="tooltip" title="" class="btn btn-info btn-xs" data-original-title="Telemovel"><i class="fa fa-phone fa-fw"></i></button></td>
                                    <td><a href="tel:{{$cliente->telefone}}">{{$cliente->telefone}}</a></td>
                                 </tr>
                                 <tr>
                                    <td><button data-toggle="tooltip" title="" class="btn btn-info btn-xs" data-original-title="Nº de Identificação"><i class="fa fa-id-card fa-fw"></i></button></td>
                                    <td>{{$cliente->BI}}</td>
                                 </tr>
                                 <tr>
                                    <td><button data-toggle="tooltip" title="" class="btn btn-info btn-xs" data-original-title="Quarto"><i class="fas fa-bed fa-fw"></i></button></td>
                                    <td><a href="javascript:void(0)">{{$quarto->numero}}</a>&nbsp;.:.&nbsp;{{$quarto->nome}}</td>
                                 </tr>
                                 <tr>
                                    <td><button data-toggle="tooltip" title="" class="btn btn-info btn-xs" data-original-title="Estado da Reserva"><i class="fa fa-rss fa-fw"></i></button></td>
                                    <td><span class="right badge badge-{{ $reserva->corEstadoReserva }}">{{ $reserva->nomeEstadoReserva }}</span></td>
                                 </tr>
                                 <tr>
                                    <td><button data-toggle="tooltip" title="" class="btn btn-info btn-xs" data-original-title="Criado por"><i class="fas fa-calendar-plus fa-fw"></i></button></td>
                                    <td><a href="javascript:void(0)">{{$reserva->nomeUtilizador}}</a>&nbsp;.:.&nbsp;{{$reserva->created_at}}</td>
                                 </tr>
                              </tbody>
                           </table>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="panel panel-default">
                           <table class="table">
                              <tbody>
                                <tr>
                                   <td><button data-toggle="tooltip" title="" class="btn btn-info btn-xs" data-original-title="Montante"><i class="fas fa-money-bill-alt fa-fw"></i></button></td>
                                   <td>{{number_format($reserva->preco,0,',',' ')}} kz</td>
                                </tr>
                                <tr>
                                   <td><button data-toggle="tooltip" title="" class="btn btn-info btn-xs" data-original-title="Quantidade Dias"><i class="fa fa-sitemap fa-fw"></i></button></td>
                                   <td>{{$reserva->qtdDias}}</td>
                                </tr>
                                <tr>
                                   <td><button data-toggle="tooltip" title="" class="btn btn-info btn-xs" data-original-title="Montante"><i class="fas fa-money-bill-alt fa-fw"></i></button></td>
                                   <td>{{number_format($reserva->valor,0,',',' ')}} kz</td>
                                </tr>
                                 <tr>
                                    <td style="width: 1%;"><button data-toggle="tooltip" title="" class="btn btn-info btn-xs" data-original-title="Quantidade de Adultos"><i class="fas fa-restroom fa-fw"></i></button></td>
                                    <td>{{$reserva->totalAdulto}}</td>
                                 </tr>
                                 <tr>
                                    <td style="width: 1%;"><button data-toggle="tooltip" title="" class="btn btn-info btn-xs" data-original-title="Quantidade de Adultos"><i class="fa fa-user-friends fa-fw"></i></button></td>
                                    <td>{{$reserva->totalCrianca}}</td>
                                 </tr>
                                 <tr>
                                    <td><button data-toggle="tooltip" title="" class="btn btn-info btn-xs" data-original-title="Inicio da Reserva"><i class="far fa-calendar fa-fw"></i></button></td>
                                    <td>{{$reserva->dataInicio}}</td>
                                 </tr>
                                 <tr>
                                    <td><button data-toggle="tooltip" title="" class="btn btn-info btn-xs" data-original-title="Fim da Reserva"><i class="far fa-calendar-check fa-fw"></i></button></td>
                                    <td>{{$reserva->dataFim}}</td>
                                 </tr>
                                 <tr>
                                    <td><button data-toggle="tooltip" title="" class="btn btn-info btn-xs" data-original-title="Checkin da Reserva"><i class="fas fa-calendar fa-fw"></i></button></td>
                                    <td>{{$reserva->checkin}}</td>
                                 </tr>
                                 <tr>
                                    <td><button data-toggle="tooltip" title="" class="btn btn-info btn-xs" data-original-title="Checkout da Reserva"><i class="fas fa-calendar-check fa-fw"></i></button></td>
                                    <td>{{$reserva->checkout}}</td>
                                 </tr>
                              </tbody>
                           </table>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-7">
                        <div class="card card-success">
                            <div class="card-header">
                            <h3 class="card-title">Histórico</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12" id="lista-historico">
                                        <table class="table-list-reserva table table-bordered table-striped">
                                            <thead>
                                            <tr>
                                                <th>Criado por</th>
                                                <th class="text-center">Estado</th>
                                                <th>Nota</th>
                                                <!--th class="text-center" width="10px">Info.</th-->
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach ($historicos as $historico)
                                            <tr>
                                                <td><a href="javascript:void(0)">{{$historico->nomeUtilizador}}</a>&nbsp;.:.&nbsp;{{$historico->created_at}}</td>
                                                <td><span class="text-center badge badge-{{ $historico->corEstadoReserva }}">{{ $historico->nomeEstadoReserva }}</span></td>
                                                <td>{{ $historico->notas }}</td>
                                            </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <br/>
                                <fieldset>
                                    <legend>Adicionar histórico de Reserva</legend>
                                    <form id="form-add-historico">
                                        @csrf
                                        <input type="hidden" value="{{$reserva->id}}" name="idReserva">
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <div class="form-group">
                                                    <strong>Estado:</strong>
                                                    <select name="idEstadoReserva" class="form-control">
                                                        @foreach ($estados as $estado)
                                                            @if($estado->id == $reserva->idEstadoReserva) 
                                                                <option selected="selected" value="{{$estado->id}}">{{$estado->nome}}</option>
                                                            @else
                                                                <option value="{{$estado->id}}">{{$estado->nome}}</option>
                                                            @endif
                                                            
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <div class="form-group">
                                                    <strong>Notas</strong>
                                                    <textarea required name="notas" class="form-control" rows="5"></textarea>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-12 text-right">
                                                <button type="button" id="btn-add-historico" class="btn btn-success">Gravar</button> 
                                                <br>
                                                <br>
                                            </div>
                                        </div>
                                        </form>
                                </fieldset>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="card card-info">
                            <div class="card-header">
                            <h3 class="card-title">Pagamentos</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-5">
                                        <div class="form-group">
                                            <strong>Metódo de Pagamento:</strong>
                                            <select name="metodoPagamento" id="input-metodoPagamento" class="form-control">
                                                @foreach ($mPagamentos as $mPagamento)
                                                    <option value="{{$mPagamento->id}}">{{$mPagamento->nome}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-5">
                                        <div class="form-group">
                                            <strong>Valor a Pagar:</strong>
                                            <input type="text" name="valorPagamento" id="input-metodoPagamento" class="form-control" placeholder="Valor a Pagar">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-2">
                                        <br>
                                        <button type="button" class="btn btn-info">Adicionar</button> 
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th style="width: 10px">#</th>
                                                    <th>Metódo de Pagamento</th>
                                                    <th>Valor</th>
                                                    <th style="width: 40px">Estado</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>1.</td>
                                                    <td>Transferência Bancaria</td>
                                                    <td>
                                                    10 000 kz
                                                    </td>
                                                    <td><span class="badge bg-success">Pago</span></td>
                                                </tr>
                                                <tr>
                                                    <td>2.</td>
                                                    <td>TPA</td>
                                                    <td>
                                                    5 000 kz
                                                    </td>
                                                    <td><span class="badge bg-danger">Pendente</span></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br/>
            </div>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
  </div>
@endsection
@section('footer-scripts')
<script>
    $(function () {
        
    });
</script>
<script>
    $(function () {
        $('#btn-add-historico').on('click', function () {
            if (!$('#form-add-historico')[0].checkValidity()) {
                $('#form-add-historico')[0].reportValidity()
            } else {
                var formElement = document.querySelector("#form-add-historico");
		        var formData = new FormData(formElement); 

                $.ajax({
                    url: "{{ url('add_historico_reserva') }}",
                    type: 'post',
                    dataType: 'json',
                    contentType: "application/json; charset=utf-8",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    beforeSend: function() {
                        $('#btn-add-historico').button('loading');
                    },
                    complete: function() {
                        $('#btn-add-historico').button('reset');
                    },
                    success: function(json) {
                        if(json.success) {
                            if(json.data && json.data.length > 0) {
                                $('#lista-historico').html(json.data);
                                $(".table-list-reserva").DataTable({
                                    "paging": true,
                                    "lengthChange": false,
                                    "pageLength": 3,
                                    "searching": true,
                                    "ordering": false,
                                    "info": true,
                                    "autoWidth": false,
                                    "responsive": true,
                                });
                                Swal.fire({
                                title: 'Sucesso',
                                text: "Histórico adicionado com sucesso.",
                                icon: 'success'
                            }).then((result) => {
                                window.location.reload();
                            });
                            }
                        } else {
                            Swal.fire({
                                title: 'Oops',
                                text: "Ocorreu um erro ao gravar o historico.",
                                icon: 'error',
                            });
                        }
                    }
                });
            }
        });
    });
</script>
@endsection