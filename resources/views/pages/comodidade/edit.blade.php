@extends('layouts.master')
@section('title', 'Gestão de Comodidades')
 
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="text-right">
            <button type="submit" form="form-comodidade" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;Guardar</button>
            <a class="btn btn-default" href="{{ route('comodidades.index') }}"><i class="fa fa-reply"></i>&nbsp;Voltar</a>
        </div>
        <br />
    </div>
</div>
   
    <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Editar Comodidade</h3>
        </div>
        <div class="card-body">
         
        @include('components.messages')

        <form id="form-comodidade" action="{{ route('comodidades.update',$comodidade->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Nome:<span style="color:red">*</span></strong>
                        <input type="text" name="nome" value="{{ $comodidade->nome }}" class="form-control" placeholder="Nome">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Preço:<span style="color:red">*</span></strong>
                        <input type="number" name="preco" value="{{ $comodidade->preco }}" class="form-control" placeholder="Preço">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Ordem:<span style="color:red">*</span></strong>
                        <input type="number" name="ordem" value="{{ $comodidade->ordem }}" class="form-control" placeholder="Ordem">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <label>Descrição</label>
                        <textarea class="form-control" name="descricao" rows="5" placeholder="Descrição">{{ $comodidade->descricao }}</textarea>
                    </div>
                </div>
            
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Activo?:</strong>
                        <input type="hidden" value="0" name="estado">
                        <div class="icheck-primary d-inline">
                            <input type="checkbox" name="estado" value="1" @if ($comodidade->estado)checked="checked"@endif id="checkboxPrimary2">
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