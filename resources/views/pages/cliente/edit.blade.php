@extends('layouts.master')
@section('title', 'Gestão de Clientes')
 
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="text-right">
            <button type="submit" form="form-cliente" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;Guardar</button>
            <a class="btn btn-default" href="{{ route('clientes.index') }}"><i class="fa fa-reply"></i>&nbsp;Voltar</a>
        </div>
        <br />
    </div>
</div>
   
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Editar Cliente</h3>
    </div>
    <div class="card-body">
         
        @include('components.messages')

        <form id="form-cliente" action="{{ route('clientes.update',$cliente->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Nome:<span style="color:red">*</span></strong>
                        <input type="text" name="nome" value="{{ $cliente->nome }}" class="form-control" placeholder="Nome">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Número:<span style="color:red">*</span></strong>
                        <input type="number" name="numero" value="{{ $cliente->numero }}" class="form-control" placeholder="Número">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Preço:<span style="color:red">*</span></strong>
                        <input type="text" name="preco" value="{{ $cliente->preco }}" class="form-control" placeholder="Preço">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Qtd Adulto:<span style="color:red">*</span></strong>
                        <input type="number" name="limit_adulto" value="{{ $cliente->limit_adulto }}" class="form-control" placeholder="Qtd Adulto">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Qtd Crianças:<span style="color:red">*</span></strong>
                        <input type="number" name="limit_crianca" value="{{ $cliente->limit_crianca }}" class="form-control" placeholder="Qtd Crianças">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Estado:</strong>
                        <select name="idEstadoCliente" class="form-control">
                            @foreach ($estados as $data)
                                @if($data->id == $cliente->idEstadoCliente) 
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
                        <label for="input-comodidade"><span data-toggle="tooltip" title="Filtro letra-a-letra">Comodidades</span></label>
                        <input type="text" name="comodidade" value="" placeholder="Comodidades" id="input-comodidade" class="form-control"/>
                        <div id="cliente-comodidade" class="well well-sm" style="padding:10px;background-color: #f5f5f5; height: 150px; overflow: auto;"> 
                            @foreach ($comodidades as $data)
                            <div id="cliente-comodidade{{$data->id}}"><i class="fa fa-minus-circle"></i> {{$data->nome}}
                                <input type="hidden" name="cliente_comodidade[]" value="{{$data->id}}"/>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <label for="input-servico"><span data-toggle="tooltip" title="Filtro letra-a-letra">Serviços</span></label>
                        <input type="text" name="servico" value="" placeholder="Serviços" id="input-servico" class="form-control"/>
                        <div id="cliente-servico" class="well well-sm" style="padding:10px;background-color: #f5f5f5; height: 150px; overflow: auto;"> 
                            @foreach ($servicos as $data)
                            <div id="cliente-servico{{$data->id}}"><i class="fa fa-minus-circle"></i> {{$data->nome}}
                                <input type="hidden" name="cliente_servico[]" value="{{$data->id}}"/>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <label>Descrição</label>
                        <textarea class="form-control" name="descricao" rows="5" placeholder="Descrição">{{ $cliente->descricao }}</textarea>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
@section('footer-scripts')
<script>
    $(function () {
        //Comodidades Autocomplete
        $('input[name=\'comodidade\']').autocomplete({
            'source': function(request, response) {
                console.log(request.term);
                $.ajax({
                url: "{{ url('comodidade_autocomplete') }}?filter_name=" + encodeURIComponent(request.term),
                dataType: 'json',
                success: function(json) {
                    response($.map(json, function(item) {
                    return {
                        label: item['nome'],
                        value: item['id']
                    }
                    }));
                }
                });
            },
            'select': function(event, ui) {
                $('#cliente-comodidade' + ui.item['value']).remove();

                $('#cliente-comodidade').append('<div id="cliente-comodidade' + ui.item['value'] + '"><i class="fa fa-minus-circle"></i> ' + ui.item['label'] + '<input type="hidden" name="cliente_comodidade[]" value="' + ui.item['value'] + '" /></div>');

                $('input[name=\'comodidade\']').val('');
                event.preventDefault();
            }
        });

        $('#cliente-comodidade').delegate('.fa-minus-circle', 'click', function() {
            $(this).parent().remove();
        });
        //Servicos Autocomplete
        $('input[name=\'servico\']').autocomplete({
            'source': function(request, response) {
                console.log(request.term);
                $.ajax({
                url: "{{ url('servico_autocomplete') }}?filter_name=" + encodeURIComponent(request.term),
                dataType: 'json',
                success: function(json) {
                    response($.map(json, function(item) {
                    return {
                        label: item['nome'],
                        value: item['id']
                    }
                    }));
                }
                });
            },
            'select': function(event, ui) {
                $('#cliente-servico' + ui.item['value']).remove();

                $('#cliente-servico').append('<div id="cliente-servico' + ui.item['value'] + '"><i class="fa fa-minus-circle"></i> ' + ui.item['label'] + '<input type="hidden" name="cliente_servico[]" value="' + ui.item['value'] + '" /></div>');

                $('input[name=\'servico\']').val('');
                event.preventDefault();
            }
        });

        $('#cliente-servico').delegate('.fa-minus-circle', 'click', function() {
            $(this).parent().remove();
        });
    });
</script>  
@endsection