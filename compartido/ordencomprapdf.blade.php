<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Caja Diaria Geovial</title>
    <style>



        body {
            margin: 0;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            font-size: 0.5rem;
            font-weight: normal;
            line-height: .5;
            color: #151b1e;   
            writing-mode: tb-rl;
            size:landscape;
            width:100%;
            height:100%;
            TEXT-TRANSFORM:UPPERCASE;
        }
        
        .table {
            display: table;
            width: 100%;
            max-width: 100%;
            margin-bottom: 0.3rem;
            background-color: transparent;
            border-collapse: collapse;
        }
        .table-bordered {
            border: 1px solid #c2cfd6;
        }
        thead {
            display: table-header-group;
            vertical-align: middle;
            border-color: inherit;
        }
        tr {
            display: table-row;
            vertical-align: inherit;
            border-color: inherit;
        }
        .table th, .table td {
            padding: 0.3rem;
            vertical-align: top;
            border-top: 1px solid #c2cfd6;
        }
        .table thead th {
            vertical-align: bottom;
            border-bottom: 1px solid #c2cfd6;
        }
        .table-bordered thead th, .table-bordered thead td {
            border-bottom-width: 1px;
        }
        .table-bordered th, .table-bordered td {
            border: 1px solid #c2cfd6;
        }
        th, td {
            display: table-cell;
            vertical-align: inherit;
            line-height: 1.6;
        }
        th {
            font-weight: bold;
            text-align: -internal-center;
            text-align: left;
            line-height: 1.6;
        }
        tbody {
            vertical-align: middle;
            border-color: inherit;
        }
        tr {
            display: table-row;
            vertical-align: inherit;
            border-color: inherit;
            line-height: 1.6;
        }
        .table-striped tbody tr:nth-of-type(odd) {
            background-color: rgba(0, 0, 0, 0.05);
        }
        .izquierda{
            float:left;
        }
        .derecha{
            float:right;
        }
        .resumen{
            page-break-inside: avoid;
        }
    </style>
</head>
<body>
@foreach($requerimientos as $req)
<div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
    <div class="card">
        <div class="row">
            <div class="table-responsive" >
                <table class="table table-bordered table-striped table-sm" >
                    <tbody>
                        <tr>
                            <td rowspan="2" style="TEXT-ALIGN-LAST: CENTER;"><img src="../img/geovial.png" width="100px" height="50px"></td>
                            <td colspan="7" style="TEXT-ALIGN-LAST: CENTER;font-size: x-large;"><b>ORDEN COMPRA</b></td>
                            <td rowspan="2" style="TEXT-ALIGN-LAST: CENTER;"><img src="../img/geovial.png" width="100px" height="50px"></td>
                        </tr>
                        <tr>
                            
                            <td colspan="4"><b>FECHA:{{date("d/m/Y", strtotime($req->fecha))}}</b></td>
                            <td colspan="3"><b>REQ.:REQ-{{$req->numero}}-{{$req->usuario}}</b></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="table-responsive" >
                <table class=" tableinvcab table table-sm" >
                    <tbody>
                        <tr class=" ">
                            <td class=" "><b>Area: {{$req->area}}</b></td>
                            <td class="" style="text-align:right"><b>Tipo: </b>                    
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="table-responsive" >
                <table class="table table-bordered table-striped table-sm" style="TEXT-ALIGN-LAST: CENTER;">
                    <tbody>
                                            
                        <tr>
                            <td style="text-align-last: left">CENTRO DE COMPRA </td>
                            <td>{{$req->categoria}} {{$req->proyecto}}</td>
                            
                        </tr>
                        <tr>
                        @foreach($usuarios as $user)
                            @if($req->aprobacion1==$user->id)
                                <td style="text-align-last: left">APROBADO POR: </td>
                                <td>{{$user->nombre}}  {{$user->apellido}} el {{$req->aprobacionfecha1}}</td>
                            @endif
                            @if($req->aprobacion2==$user->id)
                                <td style="text-align-last: left">APROBADO POR: </td>
                                <td>{{$user->nombre}}  {{$user->apellido}} el {{$req->aprobacionfecha2}}</td>
                            @endif
                            @if($req->aprobacion3==$user->id)
                                <td style="text-align-last: left">APROBADO POR: </td>
                                <td>{{$user->nombre}}  {{$user->apellido}} el {{$req->aprobacionfecha3}}</td>
                            @endif
                        @endforeach
                            
                            
                        </tr>
                        <tr>
                            <td style="text-align-last: left">solicitante</td>
                            <td>{{$req->usuario}} {{$req->apellido}}
                            </td>
                            
                        </tr>
                        <tr>
                            <td style="text-align-last: left">destino/insumo</td>
                            <td></td>
                            
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="table-responsive" >
                <table class="table table-bordered table-striped table-sm" style="TEXT-ALIGN-LAST: CENTER;">
                    <tbody>

                        <tr>
                            <td class="bg-primary" colspan="2" style="text-align: center; background-color: black; color:#ffffff;" ><b>Detalle de la Compra</b></td>
                            
                            
                        </tr> 
                        @foreach($proveedor as $prov)                  
                        <tr>
                            <td style="text-align-last: left">Proveedor</td>
                            <td>{{$prov->razon_social}}</td>
                        </tr>
                        <tr>
                            <td style="text-align-last: left">Ruc</td>
                            <td>{{$prov->ruc}}</td>
                            
                        </tr>
                        <tr>
                            <td style="text-align-last: left">Direccion</td>
                            <td>{{$prov->direccion}}</td>
                        </tr>
                        <tr>
                            <td style="text-align-last: left">Direccion</td>
                            <td>{{$prov->numero_cuenta}}</td>
                        </tr>
                        <tr>
                            <td style="text-align-last: left">Tratado con</td>
                            <td>{{$req->tratado}}</td>
                        </tr>
                        <tr>
                            <td style="text-align-last: left">Forma de Pago</td>
                            <td>{{$req->formapago}}</td>
                        </tr>
                        <tr>
                            <td style="text-align-last: left">Lugar de Entrega</td>
                            <td>{{$req->entrega}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="table-responsive" >
                <table class="table table-bordered table-striped table-sm" style="TEXT-ALIGN-LAST: CENTER;">
                    <tbody>
                        <tr class="bg-primary">

                            <td><b>Item</b></td>
                            <td><b>Codigo</b></td>
                            <td><b>Descripcion - Recurso</b></td>
                            <td><b>UND</b></td>
                            <td><b>Cant</b></td>
                            <td><b>Precio</b></td>
                            <td><b>Dcto</b></td>
                            <td><b>Total</b></td>
                        </tr>
                        @php $item=1; @endphp
                        @php $subtotal=0; @endphp
                        @foreach($detalle_requerimientos as $det)
                            <tr>
                                
                                <td>{{$item}}</td>
                                <td></td>
                                <td>{{$det->detalle}}</td>
                                <td>{{$det->unidad}}</td>
                                <td>{{$det->cantidad}}</td>
                                <td>{{number_format($det->preciosug,2)}}</td>
                                <td></td>
                                <td>{{number_format(($det->preciosug*$det->cantidad),2)}}</td>
                                @php $subtotal=($det->preciosug*$det->cantidad)+$subtotal; @endphp 
                                @php $item++; @endphp
                            </tr>
                        @endforeach
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>Sub Total</td>
                            <td>{{number_format(($subtotal/1.18),2)}}</td>
                            @php $igv=$subtotal/1.18; @endphp
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>IGV</td>
                            <td>{{number_format(($igv*0.18),2)}}</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>Total</td>
                            <td>{{number_format($subtotal,2)}}</td>
                        </tr>
                        
                    </tbody>
                </table>
            </div>

            <div class="table-responsive" >
                <table class="table table-bordered table-striped table-sm" >
                    <tbody>
                        <tr>
                            <td colspan="3" style="height: 100px;">Observaciones:</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
            <div class="table-responsive" >
                <table class="table table-bordered table-striped table-sm" >
                    <tbody>
                        <tr>
                            <td>Facturar:</td>
                        </tr>
                        <tr>
                            <td>GRUPO:</td>
                        </tr>
                        <tr>
                            <td>RUC:</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="table-responsive" >
                <table class="table table-bordered table-striped table-sm" >
                    <tbody>
                        <tr class="bg-primary">
                            <td>operadores</td>
                            <td>Aprobaciones</td>
                        </tr>
                        <tr>
                            <td>Analista</td>
                            <td>DP:</td>
                        </tr>
                        <tr>
                            <td>Jefe de Logistica</td>
                            <td>DP:</td>
                        </tr>
                        <tr>
                            <td>Caja/contabilida</td>
                            <td>DP:</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="table-responsive" >
                <table class="table table-sm" >
                    <tbody>
                        <tr>
                            <td>Condiciones Generales</td>
                        </tr>
                        <tr>
                            <td>1) Compras hasta 1000 soles require 1 firma de autorizacion</td>
                        </tr>
                        <tr>
                            <td>2) Compras de 1000 soles hasta 3000 requierem 2 firmas de autorizacion</td>
                        </tr>
                        <tr>
                            <td>3) Compras de 3000 soles a mas requieren 3 firmas de autorizacion</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
        </div>
    </div>
</div>
</body>
@endforeach
</html>