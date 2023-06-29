@extends('layouts.master')
@section('title', 'Dashboard')
@section('content')
        <!-- Info boxes -->
        <div class="row">
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="far fa-flag"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Quartos Disponiveis</span>
                <span class="info-box-number">
                  10
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-podcast"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Quartos Oucupados</span>
                <span class="info-box-number">5</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Reservas em Curso</span>
                <span class="info-box-number">50</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Hospedes</span>
                <span class="info-box-number">20</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

        <div class="row">
          <div class="col-lg-6">
            <div class="card">
              <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                  <a href="javascript:void(0);"><h3 class="card-title">Reservas por Semana</h3></a>
                </div>
              </div>
              <div class="card-body">
                <div style="height: 300px;" id="week-chart"></div>
              </div>
            </div>
            <!-- /.card -->

            <div class="card">
              <div class="card-header border-0">
                <h3 class="card-title"><a href="javascript:void(0);"><h3 class="card-title">Reservas a Começar</h3></a></h3>
              </div>
              <div class="card-body table-responsive p-0">
                <table class="table-home table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Quarto</th>
                            <th>Cliente</th>
                            <th>Faturação</th>
                            <th>Data</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td><a href="#" class="text-muted">998&nbsp;<i class="fas fa-link"></i></a></td>
                            <td>Quarto Solteiro#201</td>
                            <td>Mario Diogo</td>
                            <td>75 000 kz</td>
                            <td>29/06/2023 11:30</td>
                        </tr>
                        <tr>
                            <td><a href="#" class="text-muted">1002&nbsp;<i class="fas fa-link"></i></a></td>
                            <td>Quarto Solteiro#203</td>
                            <td>Matos Zenga</td>
                            <td>80 000 kz</td>
                            <td>30/06/2023 13:30</td>
                        </tr>
                        <tr>
                            <td><a href="#" class="text-muted">10021&nbsp;<i class="fas fa-link"></i></a></td>
                            <td>Quarto Casal#102</td>
                            <td>Igor Viera</td>
                            <td>133 000 kz</td>
                            <td>30/06/2023 12:30</td>
                        </tr>
                        </tbody>
                </table>
              </div>
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col-md-6 -->
          <div class="col-lg-6">
            <div class="card">
              <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                  <h3 class="card-title"><a href="javascript:void(0);"><h3 class="card-title">Reservas por Mês</h3></a></h3>
                </div>
              </div>
              <div class="card-body">
                <div style="height: 300px;" id="month-chart"></div>
              </div>
            </div>
            <!-- /.card -->

            <div class="card">
              <div class="card-header border-0">
                <h3 class="card-title"><h3 class="card-title"><a href="javascript:void(0);"><h3 class="card-title">Reservas a Terminar</h3></a></h3></h3>
              </div>
              <div class="card-body table-responsive p-0">
                <table class="table-home table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>#</th>
                    <th>Quarto</th>
                    <th>Cliente</th>
                    <th>Faturação</th>
                    <th>Data</th>
                  </tr>
                  </thead>
                  <tbody>
                  <tr>
                    <td><a href="#" class="text-muted">1001&nbsp;<i class="fas fa-link"></i></a></td>
                    <td>Quarto Casal#101</td>
                    <td>Sampaio Pedro</td>
                    <td>125 000 kz</td>
                    <td>10/07/2023  09:30</td>
                  </tr>
                  <tr>
                    <td><a href="#" class="text-muted">1011&nbsp;<i class="fas fa-link"></i></a></td>
                    <td>Quarto Solteiro#105</td>
                    <td>Zenilda Zenga</td>
                    <td>160 000 kz</td>
                    <td>12/07/2023 12:00</td>
                  </tr>
                  <tr>
                    <td><a href="#" class="text-muted">1031&nbsp;<i class="fas fa-link"></i></a></td>
                    <td>Quarto Casal#100</td>
                    <td>Kiesse Matos</td>
                    <td>134 000 kz</td>
                    <td>03/07/2023 13:00</td>
                  </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
@endsection
@section('footer-scripts')
<script>
const dataSource = [{
    day: 'Seg',
    values: 3,
  }, {
    day: 'Ter',
    values: 2,
  }, {
    day: 'Qua',
    values: 3,
  }, {
    day: 'Qui',
    values: 4,
  }, {
    day: 'Sex',
    values: 6,
  }, {
    day: 'Sab',
    values: 11,
  }, {
    day: 'Dom',
    values: 4,
  }];
$('#week-chart').dxChart({
    dataSource: dataSource,
    series: {
        argumentField: 'day',
        valueField: 'values',
        name: {
            visible: false
        },
        type: 'bar',
        color: '#17A2B8',
    },
    legend: {
        visible:false
    },
    commonAxisSettings: {
        label: {
            visible:false
        },
        grid: {
            visible: false
        },
        tick: {
            visible: false
        },
    },
    argumentAxis: {
        visible: false,
        label: {
            visible:true
        },
    },
    valueAxis: {
        visible: false,
        label: {
            visible:true
        },
        grid: {
            visible: true
        }
    },
    tooltip: {
        enabled: true,
        zIndex: 999,
        customizeTooltip(arg) {
            return {
                text: `Reservas: ${format_AOA(arg.valueText)}`,
            };
        },
    },
});
const dataSource2 = [{
    month: 'Jan',
    values: 10,
  }, {
    month: 'Fev',
    values: 23,
  }, {
    month: 'Mar',
    values: 14,
  }, {
    month: 'Mai',
    values: 7,
  }, {
    month: 'Jun',
    values: 9,
  }, {
    month: 'Jul',
    values: 5,
  }, {
    month: 'Ago',
    values: 13,
  }, {
    month: 'Set',
    values: 15,
  }, {
    month: 'Out',
    values: 23,
  }, {
    month: 'Nov',
    values: 20,
  }, {
    month: 'Dez',
    values: 22,
  }];
$('#month-chart').dxChart({
    dataSource: dataSource2,
    series: {
        argumentField: 'month',
        valueField: 'values',
        name: {
            visible: false
        },
        type: 'bar',
        color: '#17A2B8',
    },
    legend: {
        visible:false
    },
    commonAxisSettings: {
        label: {
            visible:false
        },
        grid: {
            visible: false
        },
        tick: {
            visible: false
        },
    },
    argumentAxis: {
        visible: false,
        label: {
            visible:true
        },
    },
    valueAxis: {
        visible: false,
        label: {
            visible:true
        },
        grid: {
            visible: true
        }
    },
    tooltip: {
        enabled: true,
        zIndex: 999,
        customizeTooltip(arg) {
            return {
                text: `Reservas: ${format_AOA(arg.valueText)}`,
            };
        },
    },
  });
</script>
@endsection