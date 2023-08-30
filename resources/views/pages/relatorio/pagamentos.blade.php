@extends('layouts.master')
@section('title', 'Relatório de Pagamentos')
 
@section('content')
    <div class="row">
        
    </div>
    <br/>

    <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Pagamentos</h3>
        </div>
        <div class="card-body">
            <div class="row margin-tb">
                <div class="col-md-8 text-left">
                    <div class="form-group">
                        <select class="custom-select" id="filtro-pagamento">
                            @foreach ($getAnalisysPeriods as $getAnalisysPeriod)
                                @if($periodo_selecionado == $getAnalisysPeriod["id"]) 
                                    <option selected="selected" value="{{$getAnalisysPeriod["id"]}}">{{$getAnalisysPeriod["name"]}}</option>
                                @else
                                <option value="{{$getAnalisysPeriod["id"]}}">{{$getAnalisysPeriod["name"]}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-4 text-right">
                    <a class="btn btn-primary" href="{{ url('download-pagamentos') }}?periodo={{$periodo_selecionado}}"> Gerar Documento <i class="fas fa-file-pdf"></i></a>
                </div>
            </div>            
            @include('components.messages')
            <table class="table-home table table-bordered table-striped">
                <thead>
                <tr>
                    <th width="10px">Cod.</th>
                    <th>Cliente</th>
                    <th width="50px">Reserva</th>
                    <th class="text-right" width="100px">Valor</th>
                    <th class="text-center" width="100px">Metodo</th>
                    <th width="150px">Criado por</th>
                    <th  class="text-right" width="80px">Criado Em</th>
                </tr>
            </thead>
                @foreach ($pagamentos as $pagamento)
                <tr>
                    <td>{{ $pagamento->id }}</td>
                    <td>{{ $pagamento->nomeCliente }}</td>
                    <td>RN-{{ $pagamento->idReserva }}</td>
                    <td class="text-right">{{number_format($pagamento->montante,0,',',' ')}} kz</td>
                    <td class="text-center">{{ $pagamento->nomeMetodoPagamento }}</td>
                    <td>{{ $pagamento->nomeUtilizador }}</td>
                    <td class="text-right">{{ $pagamento->created_at }}</td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection
@section('footer-scripts')
<script>
    $('#filtro-pagamento').on('change', function() {
        var id = $(this).val();
        window.location.href = "{{ url('relatorio-pagamentos') }}?periodo="+id;
    })
</script>
@endsection