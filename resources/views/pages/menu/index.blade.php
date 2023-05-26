@extends('layouts.master')
@section('title', 'Gestão de Menus')
 
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="text-right">
                <a class="btn btn-primary" href="{{ route('menus.create') }}"> Novo</a>
            </div>
        </div>
    </div>
    <br/>

    <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Lista de Menus</h3>
        </div>
        <div class="card-body">
            @include('components.messages')
            <table class="table table-bordered">
                <tr>
                    <th width="100px">No</th>
                    <th class="text-center">Icone</th>
                    <th>Nome</th>
                    <th>Codigo</th>
                    <th class="text-center">Estado</th>
                    <th  class="text-center" width="120px">Acção</th>
                </tr>
                @foreach ($menus as $menu)
                <tr>
                    <td>{{ $menu->id }}</td>
                    <td class="text-center"><i class="{{$menu->icone}}"></i></td>
                    <td>{{ $menu->nome }}</td>
                    <td>{{ $menu->codigo }}</td>
                    <td class="text-center">@if ($menu->estado == 1) <span class="right badge badge-success">Ativo</span> @else <span class="right badge badge-danger">Inativo</span> @endif</td>
                    <td>
                        <form action="{{ route('menus.destroy',$menu->id) }}" method="POST">
                            <a class="btn btn-primary" href="{{ route('menus.edit',$menu->id) }}"><i class="fa fa-pen"></i></a>
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </table>
            {!! $menus->links() !!}
        </div>
    </div>
@endsection