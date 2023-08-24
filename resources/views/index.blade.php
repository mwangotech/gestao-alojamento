@extends('layouts.master')
@section('title', 'Dashboard')
@section('content')
        <!-- Info boxes -->
        <div class="row">
          <div class="col-12 col-sm-6 col-md-2">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-bed"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Checkin em Curso</span>
                <span class="info-box-number">
                  {{$checkinCurso}}
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-2">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-dolly-flatbed"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Reservas Pendentes</span>
                <span class="info-box-number">{{$reservasPendente}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <!-- fix for small devices only -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-hand-holding-usd"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Faturação Pendente (Mês)</span>
                <span class="info-box-number">{{number_format($totalFaturacaoEmFalta,0,',',' ')}} kz</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-dollar-sign"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Faturação Confirmada (Mês)</span>
                <span class="info-box-number">{{number_format($totalFaturacaoRecebido,0,',',' ')}} kz</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-2">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-users"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Hospedes Activos</span>
                <span class="info-box-number">{{$totalHospedes}}</span>
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
                  <a href="javascript:void(0);"><h3 class="card-title">Faturação por Semana</h3></a>
                </div>
              </div>
              <div class="card-body">
                <div style="height: 300px;" id="week-chart"></div>
              </div>
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col-md-6 -->
          <div class="col-lg-6">
            <div class="card">
              <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                  <h3 class="card-title"><a href="javascript:void(0);"><h3 class="card-title">Faturação por Mês</h3></a></h3>
                </div>
              </div>
              <div class="card-body">
                <div style="height: 300px;" id="month-chart"></div>
              </div>
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
        <div class="card">
          <div class="card-header border-0">
            <div class="d-flex justify-content-between">
              <h3 class="card-title"><a href="javascript:void(0);"><h3 class="card-title">Reservas (Este Mês)</h3></a></h3>
            </div>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-lg-4">
                <div style="height: 300px;" id="monthly-pie-chart"></div>
              </div>
              <div class="col-lg-8">
                <div style="height: 300px;" id="monthly-line-chart"></div>
              </div>
            </div>
          </div>
        </div>
@endsection
@section('footer-scripts')
<script>
  $.ajax({
        type: 'GET',
        url: "{{ url('dashboardFaturacaoSemanal') }}?periodo=8",
        dataType: "json",
        contentType:"application/json; charset=utf-8",
    }).done(function(dataSource) {
      if(dataSource) {
        $('#week-chart').dxChart({
          dataSource: dataSource,
          series: {
              argumentField: 'nomeDiaSemana',
              valueField: 'montante',
              name: {
                  visible: false
              },
              type: 'bar',
              color: '#5B9D95',
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
                console.log(arg);
                  return {
                      text: `${format_AOA(arg.valueText)} kz`,
                  };
              },
          },
        });
      }
  });
    
  $.ajax({
      type: 'GET',
      url: "{{ url('dashboardFaturacaoMensal') }}?periodo=20",
      dataType: "json",
      contentType:"application/json; charset=utf-8",
  }).done(function(dataSource) {
    if(dataSource) {
      $('#month-chart').dxChart({
        dataSource: dataSource,
        series: {
            argumentField: 'nomeMesAno',
            valueField: 'montante',
            name: {
                visible: false
            },
            type: 'bar',
            color: '#5B9D95',
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
              console.log(arg);
                return {
                    text: `${format_AOA(arg.valueText)} kz`,
                };
            },
        },
      });
    }
  });
</script>
<script>
  $.ajax({
      type: 'GET',
      url: "{{ url('dashboardReservasPorEstados') }}",
      dataType: "json",
      contentType:"application/json; charset=utf-8",
  }).done(function(dataSource) {
      if(dataSource) {
        $('#monthly-pie-chart').dxPieChart({
          type: 'doughnut',
          palette: 'Green Mist',
          dataSource,
          title: false,
          tooltip: {
            enabled: true,
            customizeTooltip(arg) {
              return {
                text: `${arg.valueText} -> ${(arg.percent * 100).toFixed(2)}%`,
              };
            },
          },
          legend: {
            horizontalAlignment: 'left',
            verticalAlignment: 'top',
            margin: 0,
          },
          series: [{
            argumentField: 'label',
            valueField: 'valor',
            label: {
              visible: false,
              position: 'inside',
              connector: {
                visible: false,
              },
            },
          }],
        });
      }
  });
  $.ajax({
      type: 'GET',
      url: "{{ url('dashboardFaturacaoSemanal') }}?periodo=9",
      dataType: "json",
      contentType:"application/json; charset=utf-8",
  }).done(function(dataSource) {
    if(dataSource) {
      $('#monthly-line-chart').dxChart({
        dataSource: dataSource,
        series: {
            argumentField: 'dia',
            valueField: 'montante',
            name: {
                visible: false
            },
            type: 'bar',
            color: '#5B9D95',
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
              console.log(arg);
                return {
                    text: `${format_AOA(arg.valueText)} kz`,
                };
            },
        },
      });
    }
  });
</script>
@endsection