@extends('layouts.master')
@section('title', 'Disponibilidades 24h')
 
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="text-right">
                {{--<a class="btn btn-primary" href="{{ route('disponibilidades.create') }}"> Novo</a>--}}
            </div>
        </div>
    </div>
    <br/>
    <div class="row">
        @foreach ($disponibilidades as $disponibilidade)
        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box @if($disponibilidade->is_reserved) bg-info @else bg-{{ $disponibilidade->corEstadoQuarto }} @endif">
                <span class="info-box-icon"><i class="{{$disponibilidade->iconEstadoQuarto}}"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">{{$disponibilidade->nome}}({{$disponibilidade->numero}})</span>
                    <span class="info-box-number"><i class="fas fa-hand-holding-usd" data-toggle="tooltip" title="" data-original-title="Preço"></i>&nbsp;&nbsp;&nbsp;&nbsp;{{number_format($disponibilidade->preco,0,',',' ')}}kz</span>
                    <span class="info-box-number"><i class="fas fa-users" data-toggle="tooltip" title="" data-original-title="Capacidade de Hospedes"></i>&nbsp;&nbsp;&nbsp;&nbsp;{{number_format($disponibilidade->totalHospedes,0,',',' ')}}</span>
                    <div class="progress">
                        <div class="progress-bar" style="width: 100%"></div>
                    </div>
                    <span class="progress-description">@if($disponibilidade->is_reserved) Ocupado <i class="fas fa-info-circle" data-toggle="tooltip" title="" data-original-title="Data e Hora do Fim da Ocupação: {{$disponibilidade->fimReserva}}"></i> @else {{$disponibilidade->nomeEstadoQuarto}} @if($disponibilidade->inicioReserva) <i class="fas fa-info-circle" data-toggle="tooltip" title="" data-original-title="Data e Hora do Inicio da Proxima Reserva: {{$disponibilidade->inicioReserva}}"></i> @endif @endif</span>
                </div>
            </div>
        </div>
        @endforeach
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