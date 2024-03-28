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
                            <td colspan="7" style="TEXT-ALIGN: CENTER;font-size: x-large;"><b>RENDICION</b></td>
                            <td rowspan="2" style="TEXT-ALIGN-LAST: CENTER;"><img src="" width="100px" height="50px"></td>
                        </tr>
                        <tr>
                            
                                <td colspan="4"><b>FECHA: {{date("d-m-Y" )}}</b></td>
                                <td colspan="3"><b>NUMERO: REQ-{{$req->usuario}}-{{$req->numero}}-2021</b></td>
                            
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="table-responsive" >
                <table class=" tableinvcab table table-sm" >
                    <tbody>
                        <tr class=" tableinvcab">
                            <td class=" tableinvcab"><b>A QUIEN RINDE: {{Auth::user()->nombre}} {{Auth::user()->apellido}}</b></td>
                            <td class=" tableinvcab"><b>QUIEN RINDE: {{$req->usuario}} {{$req->apellido}} </b></td>
                        </tr>
                        <tr class=" tableinvcab">
                            <td class=" tableinvcab"><b>PROYECTO: {{$req->categoria}}  </b></td>
                            <td class=" tableinvcab"><b>NOMBRE CLAVE: {{$req->proyecto}}  </b></td>
                        </tr>
                    </tbody>
                </table>
            </div><br></br><br></br>
            <b>1.-  RECIBIDO</b><br></br><br></br>
            <div class="table-responsive" >
                <table class="table table-bordered table-striped table-sm" style="TEXT-ALIGN-LAST: CENTER;">
                    <tbody>
                        <tr class="bg-primary">
                            <td><b>Nº</b></td>
                            <td><b>FECHA</b></td>
                            <td><b>DETALLE</b></td>
                            <td><b>FUENTE</b></td>
                            <td><b>OBSERVACIONES</b></td>
                            <td><b>MONTO</b></td>
                        </tr>@php $item1=1; @endphp
                        @php $total_ingreso=0; @endphp
                        @foreach($anteriores as $ant)
                            @if($req->estado!="POR RENDIR")
                                @if($ant->estado=="FINALIZADO")
                                    @if($ant->fuente==$req->id)
                                        <tr>
                                            
                                            <td><b>{{$item1}}</b></td>
                                            <td><b>{{date("d/m/Y", strtotime($ant->fecha))}} </b></td>
                                            <td><b>{{$ant->detalle}} </b></td>
                                            <td><b>REQ-{{$ant->numero}}-{{$ant->nombre}}</b></td>
                                            <td><b></b></td>
                                            <td style="text-align: right"><b>{{$ant->monto}}</b></td>
                                            
                                            @php $item1++; @endphp
                                            @php $total_ingreso=$total_ingreso+$ant->monto; @endphp
                                            
                                        </tr>
                                    @endif
                                @endif
                            @else
                                @if($ant->estado=="REGISTRADO")
                                    <tr>
                                            
                                        <td><b>{{$item1}}</b></td>
                                        <td><b>{{date("d/m/Y", strtotime($ant->fecha))}} </b></td>
                                        <td><b>{{$ant->detalle}} </b></td>
                                        <td><b>REQ-{{$ant->numero}}-{{$ant->nombre}}</b></td>
                                        <td><b></b></td>
                                        <td style="text-align: right"><b>{{$ant->monto}}</b></td>
                                        
                                        @php $item1++; @endphp
                                        @php $total_ingreso=$total_ingreso+$ant->monto; @endphp
                                        
                                    </tr>
                                @endif
                            @endif
                        @endforeach
                        @foreach($depositos as $dep)
                        <tr>
                            <td><b>{{$item1}}</b></td>
                            <td><b>{{date("d/m/Y", strtotime($dep->fecha))}} </b></td>
                            <td><b>{{$dep->medioPago}} </b></td>
                            <td><b>OFICINA CUSCO</b></td>
                            <td><b></b></td>
                            <td style="text-align: right"><b>{{$dep->monto}}</b></td>
                            
                            @php $item1++; @endphp
                            @php $total_ingreso=$total_ingreso+$dep->monto; @endphp
                        </tr>
                        @endforeach
                        <tr>
                            <td><b></b></td>
                            <td><b></b></td>
                            <td><b> </b></td>
                            <td><b></b></td>
                            <td style="text-align: right"><b>TOTAL INGRESO</b></td>
                            <td style="text-align: right"><b>{{number_format($total_ingreso,2)}}</b></td>
                        </tr>
                    </tbody>
                </table>
            </div><br></br><br></br>
            <b>2.-  GASTOS</b><br></br><br></br>
            <div class="table-responsive" >
                <table class="table table-bordered table-striped table-sm" id="gastos">
                    <tbody>
                        <tr class="bg-primary">
                            <td><b>Nº</b></td>
                            <td><b>FECHA</b></td>
                            <td><b>CATEGORIA</b></td>
                            <td><b>INSUMO/EQUIPO</b></td>
                            <td><b>PROVEEDOR</b></td>
                            <td><b>DETALLE</b></td>
                            <td><b>TIPO</b></td>
                            <td><b>Nº</b></td>
                            <td><b>APROBADO</b></td>
                            <td><b>EJECUTADO</b></td>
                        </tr>@php $item=1; $total=0;@endphp
                        @foreach($detalle_requerimientos as $dereq)
                        <tr>
                            <td>{{$item}}<input type="hidden" class="id_detalle_1" value="{{$dereq->id}}"></td>
                            <td>
                            @if($dereq->fechafin!="")
                                {{date("d/m/Y", strtotime($dereq->fechafin))}}</td>
                            @else
                            @endif
                            <td>{{$dereq->rubro}}</td>
                            
                                @if($dereq->rubro=="MAQUINARIA")
                                    @foreach($maquinarias as $maq)
                                        @if($maq->id==$dereq->idInsumo)
                                            <td>{{$maq->nombre}}</td>
                                        @endif
                                    @endforeach
                                @else
                                    @foreach($insumos as $ins)
                                        @if($ins->id==$dereq->idInsumo)
                                            <td>{{$ins->nombre}}</td>
                                        @endif
                                    @endforeach
                                @endif
                            
                                
                                    
                            @foreach($proveedor as $prov)
                                @if($dereq->idProveedor==$prov->id)
                                    <td class="proveedor">{{$prov->nombre}}</td>
                                @endif
                            @endforeach
                            <td>{{$dereq->detalle}}</td>
                            <td>{{$dereq->sustento}}</td>
                            <td>{{$dereq->numero}}</td>
                            <td style="text-align: right">{{number_format($dereq->preciosug,2)}}</td>
                            <td style="text-align: right">{{number_format($dereq->monto,2)}}</td>
                            @php $item++; $total=$total+$dereq->monto;@endphp
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                            <tr>
                                <td  colspan="9"><p align="right">TOTAL REQUERIMIENTO:</p></td>
                                <td style="text-align:right"><b>{{number_format($total,2)}}<input type="hidden" id="totalRendicion" name="totalRendicion" value="{{$total}}"> </b><BR></td>
                            </tr>           
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
</body>
@endforeach
</html>