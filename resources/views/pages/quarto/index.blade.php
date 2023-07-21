@extends('layouts.master')
@section('title', 'Gestão de Quartos')
 
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="text-right">
                <a class="btn btn-primary" href="{{ route('quartos.create') }}"> Novo</a>
            </div>
        </div>
    </div>
    <br/>

    <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Lista de Quartos</h3>
        </div>
        <div class="card-body">
            @include('components.messages')
            <table class="table-list table table-bordered table-striped">
                <thead>
                <tr>
                    <th width="10px">Cod.</th>
                    <th>Nome</th>
                    <th>número</th>
                    <th class="text-right" width="100px">Preço</th>
                    <th class="text-right" width="100px">Nº Adulto</th>
                    <th class="text-right" width="100px">Nº Crianças</th>
                    <th class="text-center" width="100px">Estado</th>
                    <th  class="text-center" width="70px">Acção</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($quartos as $quarto)
                <tr>
                    <td>{{ $quarto->id }}</td>
                    <td>{{ $quarto->nome }}</td>
                    <td>{{ $quarto->numero }}</td>
                    <td class="text-right">{{number_format($quarto->preco,0,',',' ')}}kz</td>
                    <td class="text-right">{{ $quarto->limit_adulto }}</td>
                    <td class="text-right">{{ $quarto->limit_crianca }}</td>
                    <td class="text-center"><span class="right badge badge-{{ $quarto->corEstadoQuarto }}">{{ $quarto->nomeEstadoQuarto }}</span></td>
                    <td>
                        <form id="list-form-delete" action="{{ route('quartos.destroy',$quarto->id) }}" method="POST">
                            <a class="btn btn-primary" href="{{ route('quartos.edit',$quarto->id) }}"><i class="fa fa-pen"></i></a>
                            @csrf
                            @method('DELETE')
                            <button @if (!$quarto->can_delete) disabled="disabled" @endif type="button" class="btn btn-danger form-delete-button"><i class="fa fa-trash"></i></button>
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