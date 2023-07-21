@extends('layouts.master')
@section('title', 'Disponibilidades')
 
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
            <div class="info-box bg-{{ $disponibilidade->corEstadoQuarto }}">
                <span class="info-box-icon"><i class="{{$disponibilidade->iconEstadoQuarto}}"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">{{$disponibilidade->nome}}</span>
                    <span class="info-box-number">{{number_format($disponibilidade->preco,0,',',' ')}}kz</span>
                    <div class="progress">
                        <div class="progress-bar" style="width: 90%"></div>
                    </div>
                    <span class="progress-description">90% {{$disponibilidade->nomeEstadoQuarto}}</span>
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