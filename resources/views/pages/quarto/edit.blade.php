@extends('layouts.master')
@section('title', 'Gestão de Quartos')
 
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="text-right">
            <button type="submit" form="form-quarto" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;Guardar</button>
            <a class="btn btn-default" href="{{ route('quartos.index') }}"><i class="fa fa-reply"></i>&nbsp;Voltar</a>
        </div>
        <br />
    </div>
</div>
   
    <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Editar Quarto</h3>
        </div>
        <div class="card-body">
         
        @include('components.messages')

        <form id="form-quarto" action="{{ route('quartos.update',$quarto->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Nome:<span style="color:red">*</span></strong>
                        <input type="text" name="nome" value="{{ $quarto->nome }}" class="form-control" placeholder="Nome">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Número:<span style="color:red">*</span></strong>
                        <input type="number" name="numero" value="{{ $quarto->numero }}" class="form-control" placeholder="Número">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Preço:<span style="color:red">*</span></strong>
                        <input type="text" name="preco" value="{{ $quarto->preco }}" class="form-control" placeholder="Preço">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Qtd Adulto:<span style="color:red">*</span></strong>
                        <input type="number" name="limit_adulto" value="{{ $quarto->limit_adulto }}" class="form-control" placeholder="Qtd Adulto">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Qtd Crianças:<span style="color:red">*</span></strong>
                        <input type="number" name="limit_crianca" value="{{ $quarto->limit_crianca }}" class="form-control" placeholder="Qtd Crianças">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Estado:</strong>
                        <select name="idEstadoQuarto" class="form-control">
                            @foreach ($estados as $data)
                                @if($data->id == $quarto->idEstadoQuarto) 
                                    <option selected="selected" value="{{$data->id}}">{{$data->nome}}</option>
                                @else
                                <option value="{{$data->id}}">{{$data->nome}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <label>Descrição</label>
                        <textarea class="form-control" name="descricao" rows="5" placeholder="Descrição">{{ $quarto->descricao }}</textarea>
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