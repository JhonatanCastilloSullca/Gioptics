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
            padding: 0.5rem;
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
                            <td rowspan="2" style="TEXT-ALIGN-LAST: CENTER;"><img src="" width="100px" height="50px"></td>
                            <td colspan="7" style="TEXT-ALIGN-LAST: CENTER;font-size: x-large;"><b>REQUERIMIENTO</b></td>
                            <td rowspan="2" style="TEXT-ALIGN-LAST: CENTER;"><img src="" width="100px" height="50px"></td>
                        </tr>
                        <tr>
                            
                                <td colspan="4"><b>AREA: {{$req->area}}</b></td>
                                <td colspan="3"><b>NUMERO: REQ-{{$req->usuario}}-{{$req->numero}}-2021</b></td>
                            
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="table-responsive" >
                <table class=" tableinvcab table table-sm" >
                    <tbody>
                        <tr class=" tableinvcab">
                            <td class=" tableinvcab"><b>PROYECTO: {{$req->categoria}}</b></td>
                            <td class=" tableinvcab"><b>FECHA: {{date("d/m/Y", strtotime($req->fecha))}} </b></td>
                        </tr>
                        <tr class=" tableinvcab">
                            <td class=" tableinvcab"><b>NOMBRE CLAVE: {{$req->proyecto}} </b></td>
                            <td class=" tableinvcab"><b>TIPO: {{$req->tipo}} </b></td>
                        </tr>
                        <tr class=" tableinvcab">
                            <td class=" tableinvcab"><b>RESPONSABLE: {{$req->usuario}}  {{$req->apellido}}</b></td>
                            <td class=" tableinvcab"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="table-responsive" >
                <table class="table table-bordered table-striped table-sm" style="TEXT-ALIGN-LAST: CENTER;">
                    <tbody>
                        <tr class="bg-primary">
                            <td><b>Item</b></td>
                            <td><b>Cant.</b></td>
                            <td><b>Und.</b></td>
                            <td><b>Rubro</b></td>
                            <td><b>Insumo/Equipo</b></td>
                            <td><b>Proveedor Sugerido</b></td>
                            <td><b>Detalle Especifico</b></td>
                            <td><b>Precio U.</b></td>
                            <td><b>Subtotal</b></td>
                        </tr>@php $item=1; @endphp
                        @foreach($detalle_requerimientos as $dereq)
                        <tr>
                            <td><b>{{$item}}</b></td>
                            <td><b>{{$dereq->cantidad}}</b></td>
                            <td><b>{{$dereq->unidad}}</b></td>
                            <td><b>{{$dereq->rubro}}</b></td>
                            @if($dereq->rubro=="MAQUINARIA")
                                @foreach($maquinarias as $maq)
                                    @if($maq->id==$dereq->idInsumo)
                                        <td><b>{{$maq->nombre}}</b></td>
                                    @endif
                                @endforeach
                            @else
                                @foreach($insumos as $ins)
                                    @if($ins->id==$dereq->idInsumo)
                                        <td><b>{{$ins->nombre}}</b></td>
                                    @endif
                                @endforeach
                            @endif
                            <td><b>{{$dereq->proveedor}}</b></td>
                            <td><b>{{$dereq->detalle}}</b></td>
                            <td style="text-align-last: right"><b>{{number_format($dereq->preciosug,2)}}</b></td>
                            <td style="text-align-last: right"><b>{{number_format($dereq->preciosug*$dereq->cantidad,2)}}</b></td>
                            @php $item++; @endphp
                        </tr>
                        @endforeach
                        <tr>
                            <td><h1></h1></td>
                            <td><h1></h1></td>
                            <td><h1></h1></td>
                            <td><h1></h1></td>
                            <td><h1></h1></td>
                            <td><h1></h1></td>
                            <td><h1></h1></td>
                            <td><b>Total Req.</b></td>
                            <td style="text-align-last:right"><b>{{number_format($req->totalReq,2)}}</b><BR></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <br></br><br></br>
            <span>
            @if($req->estado=="PENDIENTE")
                <b>NOTA:</b> SE NECESITA 1 FIRMA DE APROBACION CUANDO EL MONTO ES DE 0 A 1500, 2 FIRMAS PARA MONTOS DE 1500 A 5000 Y 3 FIRMAS PARA MONTOS MAYORES A 5000.
                <br></br><br></br>
            </span>
            @else
                <span><b>OBSERVACIONES: </b>{{$req->observacion}}</span>
                <br></br><br></br>
                @foreach($usuarios as $user)
                    <br></br><br></br>
                    @if($req->aprobacion1==$user->id)
                        <span><b>APROBADO: </b>{{$user->nombre}}  {{$user->apellido}} el {{$req->aprobacionfecha1}}</span>
                    @endif
                    <br></br><br></br>
                    @if($req->aprobacion2==$user->id)
                        <span><b>APROBADO: </b>{{$user->nombre}}  {{$user->apellido}} el {{$req->aprobacionfecha2}}</span>
                    @endif
                    <br></br><br></br>
                    @if($req->aprobacion3==$user->id)
                        <span><b>APROBADO: </b>{{$user->nombre}}  {{$user->apellido}} el {{$req->aprobacionfecha3}}</span>
                    @endif
                @endforeach

            @endif
        </div>
    </div>
</div>
</body>
@endforeach
</html>