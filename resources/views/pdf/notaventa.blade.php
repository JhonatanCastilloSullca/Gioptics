<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>{{$venta->documento->nombre}} - {{$venta->nume_doc}}</title>
    <style type="text/css">
        *{
            padding:2px;
        }
        html, body {
            margin: 0;
            padding: 0;
            height: 100%;
        }

        body {
            display: flex;
            flex-direction: column;
            font-family: Arial, sans-serif;
            font-size: 12px;
            text-align:center;
        }
        .text-right{
            text-align:right !important;
        }
        .text-left{
            text-align:left !important;
        }
        .text-center{
            text-align:center;
        }
        .header {
            border-bottom: 1px solid #000;
            padding: 10px;
            text-align: center;
        }
        .header img {
            width: 150px;
        }
        .header-details {
            padding:0;
            margin:0;
            margin-bottom:5px;
            padding-left: 5px;
            text-align: center;
        }
        .header-details-factura
        {
            padding:0;
            margin:0;
        }
        .header-details > p{
            padding:0;
            margin:0;
        }
        .header-details-tittles
        {
            font-size:12px;
            font-weight:bold;
        }

        .header-details-factura .header-details-text
        {
            font-size:18px;
            font-weight:normal;
            text-align:center;
            padding:0;
            margin:0;
        }
        .header-details-text
        {
            font-size:12px;
            font-weight:normal;
            text-align:center;
        }

        body:first-child .header {
            display: block;
        }

        .content {
            flex: 1;
            padding: 5px 0px;
            border-bottom: 1px solid #000;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        table, th, td {
            border: none;
            border-collapse: collapse;
            text-align:center;
            font-size:10px;
        }

        thead th {
            border-bottom: 2px solid black;
        }

        .td-description{
            font-size:8px !important;
        }

        .footer {
            margin-top: auto;
        }

        thead th {
            border-bottom: 2px solid black;
        }

        .tr-odd:nth-child(odd) {
            background-color: #efefef;
        }

        /* Estilos para filas pares */
        .tr-odd:nth-child(even) {
            background-color: #f6f6f6;
        }
        .division{
            border-top: solid 1px #000;
        }
        .text-light{
            font-size:11px;
            font-weight:normal;
        }
        .w-50{
            width:80px !important;
            font-size:10px !important;
            font-weight:bold;
        }
        .border-all
        {
            border: solid 1px #000;
        }
        .table-info tr td
        {
            border: solid 1px #000;
        }
        .de-details td
        {
            font-size: 9px !important;
            font-weight:bold;
            padding-right: 20px !important;
        }
        .enlace-consulta
        {
            font-size: 8px !important;
        }




    </style>
</head>
<body>
    <div class="header">
        <img src="{{asset('img/logo-gstore.png')}}" class="img-logo" alt="logo">
        <div class="header-details">
            <p class="header-details-text">RUC 10446103071</p>
            <p class="header-details-text">{{$venta->sucursal->direccion}}</p>
            <p class="header-details-text">Central telefónica: {{$venta->sucursal->telefono}}</p>
        </div>
        <div class="division"></div>
        <div class="header-details-factura">
            <p class="header-details-text text-center">{{$venta->documento->nombre}}</p>
            <p class="header-details-text text-center">{{$venta->documento->serie}} - {{$venta->nume_doc}}</p>
        </div>
        <div class="division"></div>

        <table class="">
            <tbody class="">
                <tr class="">
                    <td class="w-50 text-left" >F. Emisión:</td>
                    <td class="text-left" ><span class="text-light ">{{date("d-m-Y",strtotime($venta->fecha))}}</span></td>
                </tr>
                <tr class="">
                    <td class="w-50 text-left" >F. Vencimiento:</td>
                    <td class="text-left" ><span class="text-light ">{{date("d-m-Y",strtotime($venta->fecha))}}</span></td>
                </tr>
                <tr class="">
                    <td class="w-50 text-left" >Cliente:</td>
                    <td class="text-left" ><span class="text-light ">{{ $venta->cliente->nombre }} </span></td>
                </tr>
                <tr class="">
                    <td class="w-50 text-left" >RUC:</td>
                    <td class="text-left" ><span class="text-light ">{{$venta->cliente->num_documento}} </span></td>
                </tr>
                <tr class="">
                    <td class="w-50 text-left" >Dirección:</td>
                    <td class="text-left" ><span class="text-light ">{{$venta->cliente->direccion}}</span></td>
                </tr>
            </tbody>
        </table>

    </div>
    <div class="content">
        <table>
            <thead>
                <tr>
                    <th>Cant.</th>
                    <th>Descripción</th>
                    <th>P.U.</th>
                    <th>Importe</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($venta->detalleventas as $v )
                    <tr class="tr-odd">
                        <td>{{ $v->cantidad }}</td>
                        <td class="td-description">{{$v->idProducto ? $v->producto->nombre : $v->especificacion}}</td>
                        <td>{{number_format($v->precio,2)}}</td>
                        <td>{{number_format($v->precio*$v->cantidad,2)}} </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <table class="de-details">
            <tbody>
                <tr>
                    <td class="text-right">ACUENTA S/ {{$venta->acuenta}}</td>
                </tr>
                <tr>
                    <td class="text-right">SALDO S/ {{$venta->saldo}}</td>
                </tr>
                <tr>
                    <td class="text-right">TOTAL A PAGAR: S/ {{$venta->total}}</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div style="padding-left: 10px;">
        <div class="header-details">
            <p class="header-details-text text-left">Son: {{$letrasnumeros}}</p>
        </div>
    </div>
</body>
</html>
