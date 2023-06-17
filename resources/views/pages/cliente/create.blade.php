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
          <h3 class="card-title">Novo Cliente</h3>
        </div>
        <div class="card-body">
         
        @include('components.messages')

        <form id="form-cliente" action="{{ route('clientes.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-8">
                    <div class="form-group">
                        <strong>Tipo:</strong>
                        <select name="idTipo" class="form-control">
                            @foreach ($tipos as $tipo)
                                @if($tipo->id == old('idTipo')) 
                                    <option selected="selected" value="{{$tipo->id}}">{{$tipo->nome}}</option>
                                @else
                                <option value="{{$tipo->id}}">{{$tipo->nome}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-4">
                    <div class="form-group">
                        <strong>Genero:</strong>
                        <select name="idGenero" class="form-control">
                            @foreach ($generos as $genero)
                                @if($genero->id == old('idGenero')) 
                                    <option selected="selected" value="{{$genero->id}}">{{$genero->nome}}</option>
                                @else
                                <option value="{{$genero->id}}">{{$genero->nome}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-8">
                    <div class="form-group">
                        <strong>Nome:<span style="color:red">*</span></strong>
                        <input type="text" name="nome" value="{{ old('nome') }}" class="form-control" placeholder="Nome">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-4">
                    <div class="form-group">
                        <strong>Data de Nascimento:</strong>
                        <input type="date" name="dataNascimento" value="{{ old('dataNascimento') }}" class="form-control" placeholder="Data de Nascimento">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-8">
                    <div class="form-group">
                        <strong>Email:<span style="color:red">*</span></strong>
                        <input type="email" name="email" value="{{ old('email') }}" class="form-control" placeholder="Email">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-4">
                    <div class="form-group">
                        <strong>Telefone:</strong>
                        <input type="tel" name="telefone" value="{{ old('telefone') }}" class="form-control" placeholder="244 xxx xxx xxx">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Profissão:</strong>
                        <input type="text" name="profissao" value="{{ old('profissao') }}" class="form-control" placeholder="Profissão">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6">
                    <div class="form-group">
                        <label for="input-pais"><span data-toggle="tooltip" title="Filtro letra-a-letra">Nacionalida</span></label>
                        <input type="text" name="nacionalidade" value="" placeholder="Nacionalidade" id="input-nacionalidade" class="form-control"/>
                        <input type="hidden" id="input-nacionalidade-id" name="idNacionalidade" value="0"/>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6">
                    <div class="form-group">
                        <label for="input-provincia"><span data-toggle="tooltip" title="Filtro letra-a-letra">Provincia</span></label>
                        <input type="text" name="provincia" value="" placeholder="Provincia" id="input-provincia" class="form-control"/>
                        <input type="hidden" id="input-provincia-id" name="idProvincia" value="0"/>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Estado Civil:</strong>
                        <select name="idEstadoCivil" class="form-control">
                            @foreach ($estadoCivils as $estadocivil)
                                @if($estadocivil->id == old('idEstadoCivil')) 
                                    <option selected="selected" value="{{$estadocivil->id}}">{{$estadocivil->nome}}</option>
                                @else
                                <option value="{{$estadocivil->id}}">{{$estadocivil->nome}}</option>
                                @endif
                            @endforeach
                        </select>
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
        //Nacionalidades Autocomplete
        $('input[name=\'nacionalidade\']').autocomplete({
            minLength: 0,
            autoFocus: true,
            'source': function(request, response) {
                $.ajax({
                url: "{{ url('pais_autocomplete') }}?filter_name=" + encodeURIComponent(request.term),
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

                $('#input-nacionalidade-id').val(ui.item['value']);
                $('input[name=\'nacionalidade\']').val(ui.item['label']);
                event.preventDefault();
            }
        }).focus(function() {
            $(this).autocomplete("search", "");
        });

        //Provincias Autocomplete
        $('input[name=\'provincia\']').autocomplete({
            'source': function(request, response) {
                console.log(request.term);
                $.ajax({
                url: "{{ url('provincia_autocomplete') }}?filter_country_id="+encodeURIComponent($('#input-nacionalidade-id').val())+"&filter_name=" + encodeURIComponent(request.term),
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
                
                $('#input-provincia-id').val(ui.item['value']);
                $('input[name=\'provincia\']').val(ui.item['label']);
                event.preventDefault();
            }
        }).focus(function() {
            $(this).autocomplete("search", "");
        });
    });
</script>  
@endsection