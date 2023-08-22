@extends('layouts.master')
@section('title', 'Nova Reserva')
 
@section('content')
<div class="row">
    <div class="col-md-12">
        
    @include('components.messages')

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
            </div>
            <div class="bs-stepper-content">
              <!-- your steps content here -->
              <div id="room-part" class="content" role="tabpanel" aria-labelledby="room-part-trigger">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-info">
                            <div class="card-header">
                            <h3 class="card-title">Encontrar Quarto</h3>
                            </div>
                            <form id="form-pesquisa-quarto">
                                @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-3">
                                        <div class="form-group">
                                            <strong>Tipo de Quarto:</strong>
                                            <select required name="filtro_idTipoQuarto" class="form-control">
                                                @foreach ($tipos as $tipo)
                                                    <option value="{{$tipo->id}}">{{$tipo->nome}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-3">
                                        <div class="form-group">
                                            <strong>Qtd Adultos:</strong>
                                            <input required type="number" name="filtro_numAdulto" value="{{ old('numAdulto') }}" min="0" max="6" class="form-control" placeholder="Qtd de Adultos">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-3">
                                        <div class="form-group">
                                            <strong>Qtd Crianças:</strong>
                                            <input required type="number" name="filtro_numCrianca" value="{{ old('numCrianca') }}" min="0" max="6" class="form-control" placeholder="Qtd de Crianças">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-3">
                                        <div class="form-group">
                                            <strong>Data Reserva:</strong>
                                            <div class="input-group">
                                                <input required name="filtro_data" type="text" class="form-control float-right" id="reservationdate">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="fa fa-calendar"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-2">
                                        <div class="form-group">
                                            <strong>Nº Dias:</strong>
                                            <input required type="number" name="filtro_numDias" value="{{ old('numDias') }}" min="0" class="form-control" placeholder="Nº de Dias">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-4">
                                        <div class="form-group">
                                            <strong>Comodidades:</strong>
                                            <select name="filtro_comodidades[]" class="select2bs4" multiple="multiple" data-placeholder="Selecionar Comunidades" style="width: 100%;">
                                                @foreach ($comodidades as $comodidade)
                                                    <option value="{{$comodidade->id}}">{{$comodidade->nome}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <strong>Serviços:</strong>
                                            <select name="filtro_servicos[]" class="select2bs4" multiple="multiple" data-placeholder="Selecionar Serviço" style="width: 100%;">
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
                            <button type="button" id="pesquisar-quarto" class="btn btn-info">Pesquisar&nbsp;<i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12" id="lista-quartos">
                    </div>
                    <br/>
                </div>  
                <div class="text-right">
                    <button type="button" id="stp-one" class="btn btn-primary" onclick="stepper.next()">Seguinte</button>
                </div>
              </div>
              
                <form id="form-quarto" action="{{ route('reservas.store') }}" method="POST">
                    @csrf
                    <div id="information-part" class="content" role="tabpanel" aria-labelledby="information-part-trigger">
                        <input type="hidden" value="{{ old('idQuarto') }}" name="idQuarto" id="input-idQuarto" />
                        <input type="hidden" value="{{ old('idCliente') }}" name="idCliente" id="input-idCliente"/>
                        <input type="hidden" value="{{ old('qtdDias') }}" name="qtdDias" id="input-qtdDias"/>
                        <input type="hidden" value="{{ old('preco') }}" name="preco" id="input-preco"/>
                        <input type="hidden" value="{{ old('valor') }}" name="valor" id="input-valor"/>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-3">
                                <div class="form-group">
                                    <strong>Nº de Identificação:</strong>
                                    <div class="input-group mb-3">
                                        <input name="BI" id="input-BI" value="{{ old('BI') }}" type="text" class="form-control" placeholder="00000000000UE000">
                                        <div class="input-group-append">
                                            <span class="input-group-text" style="cursor: pointer;" id="pesquisa-cliente"><i class="fas fa-search"></i></span>
                                        </div>
                                    </div>
                                
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-3">
                                <div class="form-group">
                                    <strong>Tipo:</strong>
                                    <input type="text" readonly name="nomeTipo" value="{{ old('nomeTipo') }}" class="form-control" placeholder="Tipo de Cliente">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <strong>Cliente:</strong>
                                    <input type="text" readonly name="nomeCliente" value="{{ old('nome') }}" class="form-control" placeholder="Nome do Cliente">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-3">
                                <div class="form-group">
                                    <strong>Nº Adulto:</strong>
                                    <input type="text" readonly name="totalAdulto" value="{{ old('totalAdulto') }}" class="form-control" placeholder="Nº Adultos">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-3">
                                <div class="form-group">
                                    <strong>Nº Crianças:</strong>
                                    <input type="text" readonly name="totalCrianca" value="{{ old('totalCrianca') }}" class="form-control" placeholder="Nº Crianças">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-3">
                                <div class="form-group">
                                    <strong>Data de Inicio da Reserva:</strong>
                                    <div class="input-group">
                                        <input name="dataInicio" readonly type="text" class="form-control float-right" id="reservationdate">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fa fa-calendar"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-3">
                                <div class="form-group">
                                    <strong>Data de Fim da Reserva:</strong>
                                    <div class="input-group">
                                        <input name="dataFim" readonly type="text" class="form-control float-right" id="reservationdate">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fa fa-calendar"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br/>
                        <div class="text-right">
                            <button type="button" class="btn btn-danger" onclick="stepper.previous()">Anterior</button>
                            <button type="submit" class="btn btn-success">Concluir</button> 
                        </div>
                    </div>
                </form>
            </div>
          </div>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
  </div>
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
    $(function () {
        $('#pesquisar-quarto').on('click', function () {
            if (!$('#form-pesquisa-quarto')[0].checkValidity()) {
                $('#form-pesquisa-quarto')[0].reportValidity()
            } else {
                var formElement = document.querySelector("#form-pesquisa-quarto");
		        var formData = new FormData(formElement); 

                $.ajax({
                    url: "{{ url('pesquisa_quarto') }}",
                    type: 'post',
                    dataType: 'json',
                    contentType: "application/json; charset=utf-8",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    beforeSend: function() {
                        $('#pesquisar-quarto').button('loading');
                    },
                    complete: function() {
                        $('#pesquisar-quarto').button('reset');
                    },
                    success: function(json) {
                        if(json.data && json.data.length > 0) {
                            $('#lista-quartos').html(json.data);
                            $(".table-list").DataTable({
                                "paging": true,
                                "lengthChange": false,
                                "searching": true,
                                "ordering": true,
                                "info": true,
                                "autoWidth": false,
                                "responsive": true,
                            });
                            location.href="#lista-quartos";
                        } else {
                            $('#lista-quartos').empty();
                        }

                    }
                });
            }
        });
        $('#stp-one').on('click', function () {
            var idQuarto = $('input[name="quartoSelecionado"]:checked').val();
            if(idQuarto) {
                $("#input-idQuarto").val(idQuarto);
            }
            var preco = $('input[name="quartoSelecionado"]:checked').attr('data-preco');
            if(preco) {
                $("input[name='preco']").val(preco);
            }
            var valor = $('input[name="quartoSelecionado"]:checked').attr('data-valor');
            if(valor) {
                $("input[name='valor']").val(valor);
            }
            
            var numDias = $("input[name='filtro_numDias']").val();
            var dateParts = $("input[name='filtro_data']").val().split("/");

            var date = new Date(+dateParts[2], dateParts[1] - 1, +dateParts[0]);
            var days = parseInt(numDias, 10);

            console.log(date);
            if(!isNaN(date.getTime())){
                date.setDate(date.getDate() + days);
                $("input[name='dataFim']").val(date.toInputFormat());
            }                           
            $("input[name='totalAdulto']").val($("input[name='filtro_numAdulto']").val());
            $("input[name='totalCrianca']").val($("input[name='filtro_numCrianca']").val());
            $("input[name='dataInicio']").val($("input[name='filtro_data']").val());
            $("input[name='qtdDias']").val(numDias);

            location.href = "#information-part";
            
        });
        $('#pesquisa-cliente').on('click', function(){
            var bi = $('#input-BI').val();
            if(bi.length >= 5) {
                $.ajax({
                    url: "{{ url('pesquisa_cliente') }}?filter_bi=" + encodeURIComponent(bi),
                    dataType: 'json',
                    success: function(json) {
                     if(json.length == 1) {
                        $("input[name='idCliente']").val(json[0].id);
                        $("input[name='nomeTipo']").val(json[0].nomeTipo);
                        $("input[name='nomeCliente']").val(json[0].nome);
                     } else {
                        Swal.fire({
                            title: 'Resultado',
                            text: "A Pesquisa não retornou nenhuma informação.",
                            icon: 'info',
                            showCancelButton: true,
                            confirmButtonColor: '#1B98F5',
                            cancelButtonColor: '#1FAA59',
                            cancelButtonText: 'Criar Novo',
                            confirmButtonText: 'Ok'
                        }).then((result) => {
                            if (result.isDismissed) {
                               //New Customer form
                               alert("Create new customer Page");
                            }
                        })
                     }
                    }
                });
            }
        });
        
        Date.prototype.toInputFormat = function() {
            var yyyy = this.getFullYear().toString();
            var mm = (this.getMonth()+1).toString();
            var dd  = this.getDate().toString();
            return (dd[1]?dd:"0"+dd[0]) + "/" + (mm[1]?mm:"0"+mm[0]) + "/" + yyyy;
        };
    });
</script>
<script>
    // BS-Stepper Init
    document.addEventListener('DOMContentLoaded', function () {
        window.stepper = new Stepper(document.querySelector('.bs-stepper'));
    });
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