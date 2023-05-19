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
    @include('components.messages')

    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Ordem</th>
            <th>Estado</th>
            <th width="280px">Acção</th>
        </tr>
        @foreach ($perfis as $perfil)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $perfil->nome }}</td>
            <td>{{ $perfil->ordem }}</td>
            <td>{{ $perfil->estado }}</td>
            <td>
                <form action="{{ route('perfis.destroy',$perfil->id) }}" method="POST">
                    <a class="btn btn-info" href="{{ route('perfis.show',$perfil->id) }}">Show</a>
                    <a class="btn btn-primary" href="{{ route('perfis.edit',$perfil->id) }}">Edit</a>
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
    {!! $perfis->links() !!}
@endsection