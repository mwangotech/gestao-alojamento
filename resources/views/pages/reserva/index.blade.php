@extends('layouts.master')
@section('title', 'Reservas')
 
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="text-right">
                <a class="btn btn-primary" href="{{ route('reservas.create') }}"> Adicionar <i class="fas fa-plus-circle"></i></a>
            </div>
        </div>
    </div>
    <br/>
    
    <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Lista de Reservas</h3>
        </div>
        <div class="card-body">
            @include('components.messages')
            <table class="table-list table table-bordered table-striped">
                <thead>
                <tr>
                    <th width="10px">Cod.</th>
                    <th>Cliente</th>
                    <th>Quarto</th>
                    <th class="text-right" width="100px">Preço</th>
                    <th class="text-right" width="50px">Nº Dias</th>
                    <th class="text-right" width="100px">Valor</th>
                    <th class="text-right" width="80px">Checkin</th>
                    <th class="text-right" width="80px">Checkout</th>
                    <th class="text-center" width="100px">Estado</th>
                    <th  class="text-center" width="40px">Acção</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($reservas as $reserva)
                <tr>
                    <td>{{ $reserva->id }}</td>
                    <td>{{ $reserva->nomeCliente }}</td>
                    <td>{{ $reserva->numeroQuarto }}</td>
                    <td class="text-right">{{number_format($reserva->preco,0,',',' ')}}kz</td>
                    <td class="text-right">{{$reserva->qtdDias}}Dias</td>
                    <td class="text-right">{{number_format($reserva->valor,0,',',' ')}}kz</td>
                    <td class="text-right">{{ $reserva->checkin }}</td>
                    <td class="text-right">{{ $reserva->checkout }}</td>
                    <td class="text-center"><span class="right badge badge-{{ $reserva->corEstadoReserva }}">{{ $reserva->nomeEstadoReserva }}</span></td>
                    <td>
                        <a class="btn btn-success" href="{{ route('reservas.show',$reserva->id) }}"><i class="fa fa-eye"></i></a>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    
@endsection
@section('footer-scripts')
<script>
    $('.form-delete-button').on('click', function() {
        Swal.fire({
            title: 'Deseja eliminar o registo?',
            text: "Ao eliminar esse registo, poderás perder o acesso permanente a ele.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            cancelButtonText: 'Cancelar',
            confirmButtonText: 'Sim, Eliminar!'
        }).then((result) => {
            if (result.isConfirmed) {
                var myform = $(this).closest("#list-form-delete");
                myform.submit();
            }
        })
    })
</script>
@endsection