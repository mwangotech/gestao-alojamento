@extends('layouts.master')
@section('title', 'Gestão de Clientes')
 
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="text-right">
                <a class="btn btn-primary" href="{{ route('clientes.create') }}"> Novo</a>
            </div>
        </div>
    </div>
    <br/>

    <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Lista de Clientes</h3>
        </div>
        <div class="card-body">
            @include('components.messages')
            <table class="table-list table table-bordered table-striped">
                <thead>
                <tr>
                    <th width="10px">Cod.</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th width="70px">Telefone</th>
                    <th width="70px">Tipo</th>
                    <th width="100px">Nacionalidade</th>
                    <th width="100px">Provincia</th>
                    <th width="70px">Genero</th>
                    <th class="text-center" width="120px">Acção</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($clientes as $cliente)
                <tr>
                    <td>{{ $cliente->id }}</td>
                    <td>{{ $cliente->nome }}</td>
                    <td>{{ $cliente->email }}</td>
                    <td>{{ $cliente->telefone }}</td>
                    <td>{{ $cliente->nomeTipo }}</td>
                    <td>{{ $cliente->nomeNacionalidade }}</td>
                    <td>{{ $cliente->nomeProvincia }}</td>
                    <td>{{ $cliente->nomeGenero }}</td>
                    <td>
                        <form id="list-form-delete" action="{{ route('clientes.destroy',$cliente->id) }}" method="POST">
                            <a class="btn btn-success" href="{{ route('clientes.show',$cliente->id) }}"><i class="fa fa-eye"></i></a>
                            <a class="btn btn-primary" href="{{ route('clientes.edit',$cliente->id) }}"><i class="fa fa-pen"></i></a>
                            @csrf
                            @method('DELETE')
                            <button @if (!$cliente->can_delete) disabled="disabled" @endif type="button" class="btn btn-danger form-delete-button"><i class="fa fa-trash"></i></button>
                        </form>
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