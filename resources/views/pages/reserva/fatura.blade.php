<!DOCTYPE html>
<html lang="pt">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400&display=swap" rel="stylesheet">
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
	font-family: roboto;
	background: white;
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
.material-icons {
  cursor: pointer;
}

.invoice-container {
  margin: auto;
  padding: 0px 20px;
}

.invoice-header {
  display: flex;
  padding: 70px 0%;
  width: 100%;
}

.title {
  font-size: 18px;
  letter-spacing: 3px;
  color: rgb(66, 66, 66);
}

.date {
  padding: 5px 0px;
  font-size: 14px;
  letter-spacing: 3px;
  color: rgb(156, 156, 156);
}

.invoice-number {
  font-size: 17px;
  letter-spacing: 2px;
  color: rgb(156, 156, 156);
}

.space {
  width: 50%;
}

table {
  table-layout: auto;
  width: 100%;
}
table, th, td {
  border-collapse: collapse;
}

th {
  padding: 10px 0px;
  border-bottom: 1px solid rgb(187, 187, 187);
  border-bottom-style: dashed;
  font-weight: 400;
  font-size: 13px;
  letter-spacing: 2px;
  color: gray;
  text-align: left;

}

td {
  padding: 10px 0px;
  border-bottom: 0.5px solid rgb(226, 226, 226);
  text-align: left;
}

.dashed {
  border-bottom: 1px solid rgb(187, 187, 187);
  border-bottom-style: dashed;
}

.total {
  font-weight: 800;
  font-size: 20px !important;
  color: black;
}

input[type=number] {
  text-align: center ;
  max-width: 50px;
  font-size: 15px;
  padding: 10px;
  border: none;
  outline: none;
}

input[type=text] {
  max-width: 170px;
  text-align: left;
  font-size: 15px;
  padding: 10px;
  border: none;
  outline: none;
}

input[type=text]:focus {
  border-radius: 5px;
  background: #ffffff;
  box-shadow:  11px 11px 22px #d9d9d9,
           -11px -11px 22px #ffffff;
}

input[type=number]:focus {
  border-radius: 5px;
  background: #ffffff;
  box-shadow:  11px 11px 22px #d9d9d9,
           -11px -11px 22px #ffffff;
}

input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
-webkit-appearance: none;
margin: 0;
}
/* Firefox */
input[type=number] {
-moz-appearance: textfield;
}

.float{
  width:40px;
  height:40px;
  background-color:#FF1D89;
  color:#FFF;
  border-radius:100%;
  text-align:center;
  box-shadow:
0 2.8px 2.2px rgba(0, 0, 0, 0.048),
0 6.7px 5.3px rgba(0, 0, 0, 0.069),
0 12.5px 10px rgba(0, 0, 0, 0.085),
0 22.3px 17.9px rgba(0, 0, 0, 0.101),
0 41.8px 33.4px rgba(0, 0, 0, 0.122),
0 100px 80px rgba(0, 0, 0, 0.17);
}

.float:hover {
  background-color:#ff057e;
}

.plus{
  margin-top:10px;
}

#sum {
  text-align: right;
  width: 100%;
}

#sum input[type=text] {
  width: 100%;
  font-size: 33px !important;
  color: black;
  text-align: right !important;

}

/* Medium devices (landscape tablets, 768px and up) */
@media only screen and (min-width: 768px) {
  body {
      background: #fff;
  }
  .invoice-container {
      width: 60%;
      margin: 50px auto;
      padding: 40px;
      padding-bottom: 100px;
      background: white;
      box-shadow:
0 2.8px 2.2px rgba(0, 0, 0, 0.02),
0 6.7px 5.3px rgba(0, 0, 0, 0.028),
0 12.5px 10px rgba(0, 0, 0, 0.035),
0 22.3px 17.9px rgba(0, 0, 0, 0.042),
0 41.8px 33.4px rgba(0, 0, 0, 0.05),
0 100px 80px rgba(0, 0, 0, 0.07);
  }

  .title-date {
      width: 20%;
  }
  .invoice-number {
      width: 20%;
  }
  .space {
      width: 80%;
  }
}
</style>
  </head>
  <body>
	<header>    
		<p>
			<span style="float: left">Factura <small style="font-size:12px;color: rgb(156, 156, 156)">RN-{{$reserva->id}}/<?php echo date("Y");?></small></span>
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
    <div class="invoice-container">
      <div class="invoice-header">
		<div class="title">
			Cliente
		</div>
		<table>
			<thead>
				<th class="text-left">
			  </th>
		  </thead>
			<thead>
			  	<th class="text-left">
					Tipo:&nbsp;<span style="color:#000 !important">{{$cliente->nomeTipo}}</span><br><br>
					NIF:&nbsp;<span style="color:#000 !important">{{$cliente->BI}}</span><br><br>
					Nome:&nbsp;<span style="color:#000 !important">{{$cliente->nome}}</span>
				</th>
			</thead>
		</tbody>
		</table>
      </div>
      <div class="invoice-body">
		<br/>
		<div class="title">
			Consumo
		</div>
          <table>
			<thead>
				<th width="50px" class="text-right">Nº</th>
				<th  class="text-left" style="padding-left:25px;">QUARTO</th>
				<th class="text-right">PREÇO</th>
				<th class="text-right">QTD</th>
				<th class="text-right">VALOR</th>
			</thead>
			<tbody id="table-body">
				<tr style="padding-left: 20px">
					<td class="dashed text-right">{{$reserva->numeroQuarto}}</td>
					<td class="dashed text-left" style="padding-left:25px;">{{$reserva->nomeQuarto}}</td>
					<td class="dashed text-right">{{number_format($reserva->preco,0,',',' ')}} kz</td>
					<td class="dashed text-right">{{$reserva->qtdDias}}</td>
					<td class="dashed text-right">{{number_format($reserva->valor,0,',',' ')}} kz</td>
				</tr>
			</tbody>
          </table>
		  <br/>
		  <br/>
		  <br/>
		<div class="title">
			Pagamentos
		</div>
		<table>
			<tr>
				<th>Método</th>
				<th class="text-right">Montante</th>
			</tr>
			@php
				$totalMp = 0;
			@endphp
			@foreach ($pagamentos as $pagamento)
			<tr>
				<td>{{$pagamento->nomeMetodoPagamento}}</td>
				<td class="text-right">{{number_format($pagamento->montante,0,',',' ')}} kz</td>
			</tr>
			@php
				$totalMp += $pagamento->montante;
			@endphp
			@endforeach
			<tr>
				<th>Total Pago</th>
				<th class="text-right">{{number_format($totalMp,0,',',' ')}} kz</th>
			</tr>
			<tr>
				<th>Troco</th>
				<th class="text-right">{{number_format(($reserva->valor-$totalMp),0,',',' ')}} kz</th>
			</tr>
		</table>
      </div>
  </div>
	</main>
  </body>
</html>