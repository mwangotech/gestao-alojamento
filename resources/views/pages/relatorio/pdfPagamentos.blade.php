<!DOCTYPE html>
<html lang="pt">
    <head>
        <style>
            @page {
                margin: 100px 25px;
            }

            header {
                position: fixed;
                top: -60px;
                left: 0px;
                right: 0px;
                min-height: 50px; 
                font-size: 18px !important;
                background-color: #fff;
                color: #000;
                text-align: right;
                line-height: 35px;
            }

            footer {
                position: fixed; 
                bottom: -60px; 
                left: 0px; 
                right: 0px;
                height: 50px; 
                font-size: 11px !important;
                background-color: #fff;
                color: #000;
            }
            body {
                font-family: "Roboto",sans-serif;
                font-size: 12px;
                color: #6c757d;
                margin: 0;
            }
            .red {
                color: #bf2f38;
            }
            .blue {
                color: #23C4ED;
            }
            .font-14 {
                font-size: 14px;
            }
            .font-11 {
                font-size: 11px;
            }
            .font-22 {
                font-size: 22px;
            }
            .font-42 {
                font-size: 42px;
            }
            .bold {
                font-weight: bold;
            }
            .normal {
                font-weight: normal;
                text-transform: initial;
            }
            .underline {
                padding-bottom: 8px;
                border-bottom: 1px solid #6c757d;
                ;
            }
            .doc-type {
                font-size: 18px;
                display: block;
                width: 500px;
                text-align: right;
            }
            .doc-title {
                font-size: 24px;
            }
            .header-info {
                float: right;
                text-align: right;
                padding-top: 30px;
            }
            .text-right{
                text-align: right !important;
            }
            .text-left{
                text-align: left !important;
            }
            .text-center{
                text-align: center !important;
            }
            hr {
                border-top: 1px solid #ebebeb;
                float: left;
                width: 100%;
            }
            .title {
                border-bottom: 2px solid #6c757d;
                padding: 8px 5px;
                text-transform: uppercase;
                font-weight: 500;
                font-size: 16px;
                margin-bottom: 5px;
            }
            .title-center {
                text-transform: uppercase;
                font-weight: 500;
                font-size: 18px;
                margin-left: 150px !important;
                margin-bottom: 5px;
                text-align: center;
            }
            .title span{
                margin-right: 10px;
            }
            section {
                margin-bottom: 20px;
                display: block;
                width: 100%;
            }
            .line {
                padding: 5px;
                color: #333;
                display: block;
                width: 100%;
                float: left;
            }
            .line.big {
                padding-top: 15px;
                padding-bottom: 15px;
                line-height: 1.5;
            }
            .line div{
                float: left;
            }
            .line div.float-right {
                float: right;
            }
            .line b{
                margin-right: 8px;
            }

            .line .w1-3{width: 33.333333333%;}
            .line .w1-4{width: 25%;}
            .line .w3-4{width: 75%;} 
            .line .w1-2{width: 50%;}
            .line .w1{width: 100%;}
            .line .w1-6{width: 16.6666666%;}
            .line .w4-6{width: 66.666666%;}
            table {
                width: 100%;
                margin: auto !important;
            }  
            table th {
                color: white;
                padding: 8px;
                text-align: center;
                text-transform: uppercase;
                background-color: #6c757d;
            }
            table td {
                padding: 8px;
                text-align: center;
                text-transform: uppercase;
                background-color: #ebebeb;
                font-size: 14px;
            }
            table th.red {
                background-color: #bf2f38;
                color: white;
            }
            table th.blue {
                background-color: #23C4ED;
                color: white;
            }
            table td.line-through {
                text-decoration: line-through;
            }
            table td span {
                display: block;
                font-size: 12px;
                font-weight: bold;
            }

            footer .line > div{
                margin-bottom: 5px;
            }
            .gray {
                color: #6c757d;
            }
            .bg-gray {
                background-color: #faf9f5;
            }
        </style>
    </head>
    <body>
        <header>    
            <p>
                <span style="float: left">SIGALO</span>
                <span style="float: right">*ORIGINAL*</span>
            </p>
        </header>

        <footer>
            <p>
                <span style="float: left"> Emitido em: <?php echo date("d/m/Y H:i:s");?></span>
                <span style="float: right">Emitido por: {{auth()->user()->name}}</span>
            </p>
            <br/>
            <p><span style="float: right">*** Processado por computador ***</span></p>
        </footer>

        <main>
            <section>
                <div class="title-center">
                    <span class="blue">Relatório de Pagamentos</span>
                </div>
                <p>
                    <span style=""> <b>Período:<b> {{$filtro_periodo["name"]}}</span>
                </p>
            </section>
            <br /> 
            <section>
                <div class="title">
                    <span class="blue">1.</span>Pagamentos Por Metodos
                </div>
                <table>
                    <tr>
                        <th>Método</th>
                        <th class="blue">Montante Total</th>
                    </tr>
                    @php
                        $totalMp = 0;
                    @endphp
                    @foreach ($pagamentoPorMetodos as $mp)
                    <tr>
                        <td>{{$mp->nomeMetodoPagamento}}</td>
                        <td>{{number_format($mp->totalMontante,0,',',' ')}} kz</td>
                    </tr>
                    @php
                        $totalMp += $mp->totalMontante;
                    @endphp
                    @endforeach
                    <th>Total</th>
                    <th class="blue">{{number_format($totalMp,0,',',' ')}} kz</th>
                </table>
            </section>
            <br />
            <section>
                <div class="title">
                  <span class="blue">2.</span>Pagamentos
                </div>
                <table>
                    <tr>
                        <th>Cliente</th>
                        <th width="50px">Reserva</th>
                        <th class="text-right" width="100px">Valor</th>
                        <th class="text-center" width="100px">Metodo</th>
                        <th width="150px">Criado por</th>
                        <th  class="text-right" width="80px">Criado Em</th>
                    </tr>
                    @php
                        $totalMontante = 0;
                    @endphp
                    @foreach ($pagamentos as $pagamento)
                    <tr>
                        <td>{{ $pagamento->nomeCliente }}</td>
                        <td>RN-{{ $pagamento->idReserva }}</td>
                        <td class="text-right">{{number_format($pagamento->montante,0,',',' ')}} kz</td>
                        <td class="text-center">{{ $pagamento->nomeMetodoPagamento }}</td>
                        <td>{{ $pagamento->nomeUtilizador }}</td>
                        <td class="text-right">{{ $pagamento->created_at }}</td>
                    </tr>
                    @php
                        $totalMontante += $pagamento->montante;
                    @endphp
                    @endforeach
                    <tr>
                        <th colspan="2"></th>
                        <th class="text-right" width="100px">{{number_format($totalMontante,0,',',' ')}} kz</th>
                        <th colspan="3"></th>
                    </tr>
                </table>
            </section>
        </main>
    </body>
</html>