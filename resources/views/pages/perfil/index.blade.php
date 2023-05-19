@extends('layouts.master')
@section('title', 'Perfis')
 
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="text-right">
                <a class="btn btn-primary" href="{{ route('perfis.create') }}"> Novo</a>
            </div>
        </div>
    </div>
    <br/>

    <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Lista de Perfis</h3>
        </div>
        <div class="card-body">
            @include('components.messages')
            <table class="table table-bordered">
                <tr>
                    <th width="100px">No</th>
                    <th>Name</th>
                    <th class="text-right">Ordem</th>
                    <th class="text-center">Estado</th>
                    <th  class="text-center" width="120px">Acção</th>
                </tr>
                @foreach ($perfis as $perfil)
                <tr>
                    <td>{{ $perfil->id }}</td>
                    <td>{{ $perfil->nome }}</td>
                    <td class="text-right">{{ $perfil->ordem }}</td>
                    <td class="text-center">@if ($perfil->estado == 1) <span class="right badge badge-success">Ativo</span> @else <span class="right badge badge-danger">Inativo</span> @endif</td>
                    <td>
                        <form action="{{ route('perfis.destroy',$perfil->id) }}" method="POST">
                            <a class="btn btn-primary" href="{{ route('perfis.edit',$perfil->id) }}"><i class="fa fa-pen"></i></a>
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </table>
            {!! $perfis->links() !!}
        </div>
    </div>
@endsection