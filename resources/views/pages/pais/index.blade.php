@extends('layouts.master')
@section('title', 'Gestão de Paises')
 
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="text-right">
                <!--a class="btn btn-primary" href="{{ route('paises.create') }}"> Novo</a-->
            </div>
        </div>
    </div>
    <br/>

    <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Lista de Paises</h3>
        </div>
        <div class="card-body">
            @include('components.messages')
            <table class="table-list table table-bordered table-striped">
                <thead>
                <tr>
                    <th width="10px">Cod.</th>
                    <th>Nome</th>
                    <th class="text-center" width="100px">Estado</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($paises as $pais)
                <tr>
                    <td>{{ $pais->id }}</td>
                    <td>{{ $pais->nome }}</td>
                    <td class="text-center">@if ($pais->estado == 1) <span class="right badge badge-success">Ativo</span> @else <span class="right badge badge-danger">Inativo</span> @endif</td>
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