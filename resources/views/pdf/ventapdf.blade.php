<!DOCTYPE html><html lang="en">
<head>
<meta charset="UTF-8">
<title>Venta PDF!</title>
    <style type="text/css">
        @page{
            margin: 0;
            padding:0;
            size: 60mm 200mm;
			font-family: 'Outfit', sans-serif;

        }
  
  #invoice-POS {
	 box-shadow: 0 0 1in -0.25in rgba(0, 0, 0, 0.5);
	 padding: 2mm;
	 margin: 0 auto;
	 width: 44mm;
	 background: #fff;
}
 #invoice-POS ::selection {
	 background: #f31544;
	 color: #fff;
}
 #invoice-POS ::moz-selection {
	 background: #f31544;
	 color: #fff;
}
 #invoice-POS h1 {
	 font-size: 8px;
	 color: #222;
}
 #invoice-POS h2 {
	 font-size: 8px;
}
.item,.Hours,.Rate,.Pu h2{
    font-size: 8px;
	text-align: center;
	padding-left:10px;

}
.Rate h2{
	text-align: right !important;
	text-transform:capitalize !important;

}

 #invoice-POS h3 {
	 font-size: 8px;
	 font-weight: 300;
}
#invoice-POS h3 {
	 font-size: 8px;
	 font-weight: 300;
}
 #invoice-POS p {
	 font-size: 0.7em;
	 color: black;
}
 #invoice-POS #top, #invoice-POS #mid, #invoice-POS #bot {
	/* Targets all id with 'col-' */
	 border-bottom: 1px solid #eee;
}
#bot{
	text-transform:Uppercase;
}
 #invoice-POS #top {
	 min-height: 100px;
}
 #invoice-POS #mid {
	 min-height: 80px;
}
 #invoice-POS #bot {
	 min-height: 50px;
}


 #invoice-POS .info {
	 display: block;
	 font-size: 14px;
	 margin-left: 0;
}
 #invoice-POS .title {
	 float: right;
}
 #invoice-POS .title p {
	 text-align: right;
}
 #invoice-POS table {
	 width: 100%;
	 border-collapse: collapse;
}
 #invoice-POS .tabletitle {
	 font-size: 9px;
	 background: #eee0;
	 text-align:right;
	 padding:0 !important;
	 margin:0 !important;
}
 #invoice-POS .service {
	 border-bottom: 1px solid #eee;
	 color:#000 !important;
}
 #invoice-POS .serviceas {
	 border-bottom: 1px solid #eee;
	 font-weight:400 !important;
	 color:#69696a !important;
}
 #invoice-POS .item {
	 width:20px;
}
 #invoice-POS .itemtext {
	 font-size: 0.5em;
}
 #invoice-POS #legalcopy {
	 margin-top: 5mm;
}
.payment{
	font-weight:400 !important;;
	color:#69696a !important;

}
.payment h2{
	text-align:right !important;
	padding-left:10px;
}
.cabecera h4{
    font-size: 7px !important;
    padding-bottom:0;
    padding-top:0;
    line-height: 0.5px;
    
}
.tituloTicket h2{
	text-align:center;
	font-size:12px;
}
.datosticket{
	color:#69696a !important;
	font-weight:400 !important;;
	font-size:8px;


}
.legalp {
    font-size:7px !important;
}
.vendedor{
    font-size:8px !important;

}
.colorservice{
	color:#fff;
}
 
    </style>
    </head>
    <body>
@foreach($ventas as $venta)

     
  <div id="invoice-POS">
    
    <div id="top" align='center'>
		<div class="logo">
			<img src="{{public_path('img/logo-gstore.png')}}" width="120px" alt="logo">
			
		</div>
      <div class="info cabecera"> 
        
        <h4>Calle Matará 242 - Cusco</h4>
        <h4>Celular +51 953 278 563</h4>
        <h4>Horario de Atención: 8:30 - 20:30 Hrs.</h4>
        <h4>Web: www.facebook.com/GOeyewearstore</h4>
      </div><!--End Info-->
    </div><!--End InvoiceTop-->
    
    <div id="mid">
      <div class="info">
        <h2 style="font-size:8px; text-align:center;">Ticket de Pedido</h2>
        <p> 
            <b>Número de Pedido:</b><span class="datosticket"> {{$venta->id}}</span><br>
            <b>Fecha:</b><span class="datosticket"> {{$venta->fecha}}</span><br>
            <b>Cliente:</b><span class="datosticket"> {{$venta->cliente}}</span><br>
            <b>Teléfono:</b><span class="datosticket"> {{$venta->celcliente}}</span><br>
        </p>
      </div>
    </div><!--End Invoice Mid-->
    
    <div id="bot">

					<div id="table">
						<table>
							<tr class="service colorservice">
								<td width="10%" class="item"><h2>Cant.</h2></td>
								<td width="60%" class="Hours"><h2>Producto</h2></td>
								<td width="30%" class="Pu"><h2>P.U</h2></td>
							</tr>										
							@foreach($detalles as $detalle)							
							<tr class="serviceas">
								<td width="10%"class="item"><h2>{{$detalle->cantidad}}</h2></td>
								<td width="60%"class="Hours"><h2>{{$detalle->producto}}</h2></td>
								<td width="30%"class="Pu"><h2>{{$detalle->precio}}</h2></td>
							</tr>
							@endforeach


							<hr>
							<tr class="tabletitle">
								<td></td>
								<td class="Rate"><h2>SubTotal:</h2></td>
								<td class="payment"><h2>{{$venta->total + $venta->descuento}}.00</h2></td>
							</tr> 
							<tr class="tabletitle">
								<td></td>
								<td class="Rate"><h2>Descuento:</h2></td>
								<td class="payment"><h2>-{{$venta->descuento}}</h2></td>
							</tr>                            
							<tr class="tabletitle">
								<td></td>
								<td class="Rate"><h2>Importe Total:</h2></td>
								<td class="payment"><h2>{{$venta->total}}</h2></td>
							</tr>                            
							<tr class="tabletitle">
								<td></td>
								<td class="Rate"><h2>A cuenta:</h2></td>
								<td class="payment"><h2>{{$venta->acuenta}}</h2></td>
							</tr>                            
							<tr class="tabletitle">
								<td></td>
								<td class="Rate"><h2>Por pagar:</h2></td>
								<td class="payment"><h2>{{$venta->saldo}}</h2></td>
							</tr>                            

						</table>
					</div><!--End Table-->
						<div id="legalcopy">
							<p class="vendedor"><strong>Vendedor: {{$venta->vendedor}}</strong>
							</p>
							<p class="legalp">*Los pedidos no recogidos caducan en 30 días</p>
							<p class="legalp">** El presente ticket no constituye un comprobante de pago válido. Puede recoger su comprobante al momento de reitrar su pedido.</p>
						</div>
					


				</div><!--End InvoiceBot-->
  </div><!--End Invoice-->

      			@endforeach
  
    </body>
</html>