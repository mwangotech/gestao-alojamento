@extends('layouts.master')
@section('title', 'Gestão de Prestadores')
 
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="text-right">
            <button type="submit" form="form-prestador" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;Guardar</button>
            <a class="btn btn-default" href="{{ route('prestadores.index') }}"><i class="fa fa-reply"></i>&nbsp;Voltar</a>
        </div>
        <br />
    </div>
</div>
   
    <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Editar Prestador</h3>
        </div>
        <div class="card-body">
         
        @include('components.messages')

        <form id="form-prestador" action="{{ route('prestadores.update',$prestador->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Nome:<span style="color:red">*</span></strong>
                        <input type="text" name="nome" value="{{ $prestador->nome }}" class="form-control" placeholder="Nome">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Preço:<span style="color:red">*</span></strong>
                        <input type="number" name="preco" value="{{ $prestador->preco }}" class="form-control" placeholder="Preço">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Ordem:<span style="color:red">*</span></strong>
                        <input type="number" name="ordem" value="{{ $prestador->ordem }}" class="form-control" placeholder="Ordem">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <label>Descrição</label>
                        <textarea class="form-control" name="descricao" rows="5" placeholder="Descrição">{{ $prestador->descricao }}</textarea>
                    </div>
                </div>
            
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Activo?:</strong>
                        <input type="hidden" value="0" name="estado">
                        <div class="icheck-primary d-inline">
                            <input type="checkbox" name="estado" value="1" @if ($prestador->estado)checked="checked"@endif id="checkboxPrimary2">
                            <label for="checkboxPrimary2">
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        </div>
    </div>
    <script>
        $(function () {
    
        });
    </script>  
@endsection