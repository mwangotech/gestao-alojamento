@extends('layouts.master')
@section('title', 'Utilizadores')
 
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="text-right">
                <a class="btn btn-primary" href="{{ route('utilizadores.create') }}"> Novo</a>
            </div>
        </div>
    </div>
    <br/>

    <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Lista de Utilizadores</h3>
        </div>
        <div class="card-body">
            @include('components.messages')
            <table class="table table-bordered">
                <tr>
                    <th width="100px">No</th>
                    <th>Name</th>
                    <th>Utilizador</th>
                    <th>Email</th>
                    <th class="text-center">Estado</th>
                    <th  class="text-center" width="120px">Acção</th>
                </tr>
                @foreach ($utilizadores as $utilizador)
                <tr>
                    <td>{{ $utilizador->id }}</td>
                    <td>{{ $utilizador->name }}</td>
                    <td>{{ $utilizador->username }}</td>
                    <td>{{ $utilizador->email }}</td>
                    <td class="text-center">@if ($utilizador->status == 1) <span class="right badge badge-success">Ativo</span> @else <span class="right badge badge-danger">Inativo</span> @endif</td>
                    <td>
                        <form action="{{ route('utilizadores.destroy',$utilizador->id) }}" method="POST">
                            <a class="btn btn-primary" href="{{ route('utilizadores.edit',$utilizador->id) }}"><i class="fa fa-pen"></i></a>
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </table>
            {!! $utilizadores->links() !!}
        </div>
    </div>
@endsection