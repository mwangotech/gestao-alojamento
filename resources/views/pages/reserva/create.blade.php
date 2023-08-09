@extends('layouts.master')
@section('title', 'Nova Reserva')
 
@section('content')
<form id="form-quarto" action="{{ route('reservas.store') }}" method="POST">
    @csrf
<div class="row">
    <div class="col-md-12">
      <div class="card card-default">
        <div class="card-body p-0">
          <div class="bs-stepper">
            <div class="bs-stepper-header" role="tablist">
              <!-- your steps here -->
              <div class="step" data-target="#room-part">
                <button type="button" class="step-trigger" role="tab" aria-controls="room-part" id="room-part-trigger">
                  <span class="bs-stepper-circle">1</span>
                  <span class="bs-stepper-label">Selecionar Quarto</span>
                </button>
              </div>
              <div class="line"></div>
              <div class="step" data-target="#information-part">
                <button type="button" class="step-trigger" role="tab" aria-controls="information-part" id="information-part-trigger">
                  <span class="bs-stepper-circle">2</span>
                  <span class="bs-stepper-label">Dados da Reserva</span>
                </button>
              </div>
              <div class="line"></div>
              <div class="step" data-target="#payment-part">
                <button type="button" class="step-trigger" role="tab" aria-controls="payment-part" id="payment-part-trigger">
                  <span class="bs-stepper-circle">3</span>
                  <span class="bs-stepper-label">Pagamento</span>
                </button>
              </div>
            </div>
            <div class="bs-stepper-content">
              <!-- your steps content here -->
              <div id="room-part" class="content" role="tabpanel" aria-labelledby="room-part-trigger">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card card-info">
                            <div class="card-header">
                            <h3 class="card-title">Encontrar Quarto</h3>
                            </div>
                            <form id="form-pesquisa-quarto">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <strong>Tipo de Quarto:</strong>
                                            <select name="idTipoQuarto" class="form-control">
                                                @foreach ($tipos as $tipo)
                                                    <option value="{{$tipo->id}}">{{$tipo->nome}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <strong>Qtd Hospedes:</strong>
                                            <input type="number" name="numHospedes" value="{{ old('numHospedes') }}" min="0" max="6" class="form-control" placeholder="Quantidade de Hospedes">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <strong>Data Reserva:</strong>
                                            <div class="input-group">
                                                <input type="text" class="form-control float-right" id="reservationdate">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="fa fa-calendar"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <strong>Nº Dias:</strong>
                                            <input type="number" name="numDias" value="{{ old('numDias') }}" min="0" max="6" class="form-control" placeholder="Nº de Dias">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <strong>Comodidades:</strong>
                                            <select class="select2bs4" multiple="multiple" data-placeholder="Selecionar Comunidades" style="width: 100%;">
                                                @foreach ($comodidades as $comodidade)
                                                    <option value="{{$comodidade->id}}">{{$comodidade->nome}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <strong>Serviços:</strong>
                                            <select class="select2bs4" multiple="multiple" data-placeholder="Selecionar Serviço" style="width: 100%;">
                                                @foreach ($servicos as $servico)
                                                    <option value="{{$servico->id}}">{{$servico->nome}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </form>
                            <div class="card-footer text-right">
                            <button type="button" class="btn btn-info">Pesquisar&nbsp;<i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="row">
                            @foreach ($quartosTest as $quarto)
                            <div class="col-md-4">
                                <div class="card card-widget widget-user">
                                    <div class="widget-user-header bg-info" style="height: auto !important">
                                    <h3 class="widget-user-username">{{$quarto->nome}}</h3>
                                    <h5 class="widget-user-desc">{{$quarto->nomeTipoQuarto}}</h5>
                                    <h5 class="widget-user-desc">{{$quarto->descricao}}</h5>
                                    </div>
                                    <div class="card-footer">
                                        <div class="row">
                                            <div class="col-sm-4 border-bottom">
                                            <div class="description-block">
                                                <h5 class="description-header text-info">Preço</h5>
                                                <span class="description-text">{{number_format($quarto->preco,0,',',' ')}}kz</span>
                                            </div>
                                            </div>
                                            <div class="col-sm-4 border-bottom">
                                                <div class="description-block">
                                                    <h5 class="description-header text-info">Dias</h5>
                                                    <span class="description-text">N/A</span>
                                                </div>
                                            </div>
                                            <div class="col-sm-4 border-bottom">
                                                <div class="description-block">
                                                    <h5 class="description-header text-info">Total</h5>
                                                    <span class="description-text">N/A</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-4">
                                            <div class="description-block">
                                                <h5 class="description-header text-info">Número</h5>
                                                <span class="description-text">{{$quarto->numero}}</span>
                                            </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="description-block">
                                                    <h5 class="description-header text-info">Adultos</h5>
                                                    <span class="description-text">{{$quarto->limit_adulto}}</span>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="description-block">
                                                    <h5 class="description-header text-info">Crianças</h5>
                                                    <span class="description-text">{{$quarto->limit_crianca}}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>  
                <div class="text-right">
                    <button type="button" class="btn btn-primary" onclick="stepper.next()">Seguinte</button>
                </div>
              </div>
              <div id="information-part" class="content" role="tabpanel" aria-labelledby="information-part-trigger">
                    2<br/>
                    <div class="text-right">
                        <button type="button" class="btn btn-danger" onclick="stepper.previous()">Anterior</button>
                        <button type="button" class="btn btn-primary" onclick="stepper.next()">Seguinte</button>
                    </div>
              </div>
              <div id="payment-part" class="content" role="tabpanel" aria-labelledby="payment-part-trigger">
                    3<br/>
                    <div class="text-right">
                        <button type="button" class="btn btn-success">Finalizar</button> 
                    </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
  </div>
</form>
@endsection
@section('footer-scripts')
<script>
    $(function () {
        //Date picker
        var todayDate = new Date(); 
        var dd = todayDate.getDate(); 
        var mm = todayDate.getMonth()+1; //January is 0! 
        var yyyy = todayDate.getFullYear(); 
        if(dd<10){ dd='0'+dd } 
        if(mm<10){ mm='0'+mm } 
        var minDate = dd+'/'+mm+'/'+yyyy; 
        var maxDate = dd+'/'+mm+'/'+(parseInt(yyyy)+2); 

        $('#reservationdate').daterangepicker({
            singleDatePicker: true,
            showDropdowns: false,
            autoUpdateInput: true,
            autoApply: true,
            minDate: minDate,
            maxDate: maxDate,
            locale: {
                format: 'DD/MM/YYYY'
                }
        });
    });
</script>
<script>
    // BS-Stepper Init
    document.addEventListener('DOMContentLoaded', function () {
        window.stepper = new Stepper(document.querySelector('.bs-stepper'))
    })
    $(function () {
        //Comodidades Autocomplete
        $('input[name=\'comodidade\']').autocomplete({
            minLength: 0,
            autoFocus: true,
            'source': function(request, response) {
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
        }).focus(function() {
            $(this).autocomplete("search", "");
        });

        $('#quarto-comodidade').delegate('.fa-minus-circle', 'click', function() {
            $(this).parent().remove();
        });
        //Servicos Autocomplete
        $('input[name=\'servico\']').autocomplete({
            minLength: 0,
            autoFocus: true,
            'source': function(request, response) {
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
        }).focus(function() {
            $(this).autocomplete("search", "");
        });

        $('#quarto-servico').delegate('.fa-minus-circle', 'click', function() {
            $(this).parent().remove();
        });
    });
</script>  
@endsection