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
                    1<br/>
                    <button type="button" class="btn btn-primary" onclick="stepper.next()">Seguinte</button>
              </div>
              <div id="information-part" class="content" role="tabpanel" aria-labelledby="information-part-trigger">
                    2<br/>
                    <button type="button" class="btn btn-primary" onclick="stepper.previous()">Anterior</button>
                    <button type="button" class="btn btn-primary" onclick="stepper.next()">Seguinte</button>
              </div>
              <div id="payment-part" class="content" role="tabpanel" aria-labelledby="payment-part-trigger">
                    3<br/>
                    <button type="button" class="btn btn-primary">Finalizar</button> 
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