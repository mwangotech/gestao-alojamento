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
          <h3 class="card-title">Nova Quarto</h3>
        </div>
        <div class="card-body">
         
        @include('components.messages')

        <form id="form-quarto" action="{{ route('quartos.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Nome:<span style="color:red">*</span></strong>
                        <input type="text" name="nome" value="{{ old('nome') }}" class="form-control" placeholder="Nome">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Número:<span style="color:red">*</span></strong>
                        <input type="number" name="numero" value="{{ old('numero') }}" class="form-control" placeholder="Número">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Preço:<span style="color:red">*</span></strong>
                        <input type="text" name="preco" value="{{ old('preco') }}" class="form-control" placeholder="Preço">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Qtd Adulto:<span style="color:red">*</span></strong>
                        <input type="number" name="limit_adulto" value="{{ old('limit_adulto') }}" class="form-control" placeholder="Qtd Adulto">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Qtd Crianças:<span style="color:red">*</span></strong>
                        <input type="number" name="limit_crianca" value="{{ old('limit_crianca') }}" class="form-control" placeholder="Qtd Crianças">
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Estado:</strong>
                        <select name="idEstadoQuarto" class="form-control">
                            @foreach ($estados as $estado)
                                @if($estado->id == old('idEstadoQuarto')) 
                                    <option selected="selected" value="{{$estado->id}}">{{$estado->nome}}</option>
                                @else
                                <option value="{{$estado->id}}">{{$estado->nome}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <label for="input-comodidade"><span data-toggle="tooltip" title="Filtro letra-a-letra">Comodidades</span></label>
                        <input type="text" name="comodidade" value="" placeholder="Comodidades" id="input-comodidade" class="form-control"/>
                        <div id="quarto-comodidade" class="well well-sm" style="padding:10px;background-color: #f5f5f5; height: 150px; overflow: auto;"> 
                           
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <label for="input-servico"><span data-toggle="tooltip" title="Filtro letra-a-letra">Serviços</span></label>
                        <input type="text" name="servico" value="" placeholder="Serviços" id="input-servico" class="form-control"/>
                        <div id="quarto-servico" class="well well-sm" style="padding:10px;background-color: #f5f5f5; height: 150px; overflow: auto;"> 
                            
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <label>Descrição</label>
                        <textarea class="form-control" name="descricao" rows="5" placeholder="Descrição">{{ old('descricao') }}</textarea>
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
                $('#quarto-comodidade' + ui.item['value']).remove();

                $('#quarto-comodidade').append('<div id="quarto-comodidade' + ui.item['value'] + '"><i class="fa fa-minus-circle"></i> ' + ui.item['label'] + '<input type="hidden" name="quarto_comodidade[]" value="' + ui.item['value'] + '" /></div>');

                $('input[name=\'comodidade\']').val('');
                event.preventDefault();
            }
        });

        $('#quarto-comodidade').delegate('.fa-minus-circle', 'click', function() {
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
                $('#quarto-servico' + ui.item['value']).remove();

                $('#quarto-servico').append('<div id="quarto-servico' + ui.item['value'] + '"><i class="fa fa-minus-circle"></i> ' + ui.item['label'] + '<input type="hidden" name="quarto_servico[]" value="' + ui.item['value'] + '" /></div>');

                $('input[name=\'servico\']').val('');
                event.preventDefault();
            }
        });

        $('#quarto-servico').delegate('.fa-minus-circle', 'click', function() {
            $(this).parent().remove();
        });
    });
</script>  
@endsection