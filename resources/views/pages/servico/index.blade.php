@extends('layouts.master')
@section('title', 'Gestão de Serviços')
 
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="text-right">
                <a class="btn btn-primary" href="{{ route('servicos.create') }}"> Adicionar <i class="fas fa-plus-circle"></i></a>
            </div>
        </div>
    </div>
    <br/>

    <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Lista de Serviços</h3>
        </div>
        <div class="card-body">
            @include('components.messages')
            <table class="table-list table table-bordered table-striped">
                <thead>
                <tr>
                    <th width="10px">Cod.</th>
                    <th>Nome</th>
                    <th class="text-right" width="100px">Preço</th>
                    <th class="text-right" width="50px">Ordem</th>
                    <th class="text-center" width="100px">Estado</th>
                    <th  class="text-center" width="70px">Acção</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($servicos as $servico)
                <tr>
                    <td>{{ $servico->id }}</td>
                    <td>{{ $servico->nome }}</td>
                    <td class="text-right">{{ $servico->preco }}</td>
                    <td class="text-right">{{ $servico->ordem }}</td>
                    <td class="text-center">@if ($servico->estado == 1) <span class="right badge badge-success">Ativo</span> @else <span class="right badge badge-danger">Inativo</span> @endif</td>
                    <td>
                        <form id="list-form-delete" action="{{ route('servicos.destroy',$servico->id) }}" method="POST">
                            <a class="btn btn-primary" href="{{ route('servicos.edit',$servico->id) }}"><i class="fa fa-pen"></i></a>
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-danger form-delete-button"><i class="fa fa-trash"></i></button>
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