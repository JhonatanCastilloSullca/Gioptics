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
            line-height: .05;
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
            padding: 0.05rem;
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
 
<div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
    <div class="card">
        <div class="row">
            <h1 style="text-align:center; font-size:28px"> Caja Bancos</h1>
            <img class="derecha" style="padding-top:0; margin-top:0;" src="{{asset('img/geovial.png')}}"   width="95px"  alt="admin@bootstrapmaster.com">
            <h2 style="font-size:18px">Fecha: {{date("d/m/Y", strtotime($sql2))}} al {{date("d/m/Y", strtotime($sql4))}}</h2>
            <h3>Solicitado por: {{Auth::user()->nombre}} </h3>
            <div class="card-body">
                <div style="overflow-x:auto;">
                    <div class="table-responsive" >
                        <h3> Ingresos </h3>
                        <table id="egresos" class="table table-bordered table-striped table-sm ">
                            <thead>
                                <tr class="bg-primary">
                                    <th>Fecha</th>
                                    <th>Proyecto</th>
                                    <th>Nombre Clave</th>
                                    <th>Cuenta</th>
                                    <th>Cliente</th>
                                    <th>Monto S/</th>
                                    <th>Monto $</th>
                                    <th>Sustento</th>
                                    <th>Numero</th>
                                    <th>Medio de Pago</th>
                                    <th>Numero</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach($ingresosdetalle as $ing)
                                
                                <tr>
                                    <td class="fecha">{{date("d/m/Y", strtotime($ing->fecha))}}</td>
                                    <td class="tipo">{{$ing->categoria}}</td>
                                    <td class="proveniente">{{$ing->proyecto}}</td>
                                    <td class="detalle">{{$ing->cuenta.' '.$ing->banco.' '.$ing->moneda}} </td>
                                    <td class="detalle">{{$ing->cliente}}</td>
                                    @if($ing->moneda=="Soles")
                                        <td class="monto" style="font-size:10px; text-align:right">{{number_format($ing->monto,2)}}</td>
                                    @else
                                        <td class="monto" style="font-size:10px; text-align:right">{{number_format(0,2)}}</td>
                                    @endif  
                                    @if($ing->moneda=="Dolares")
                                        <td class="monto" style="font-size:10px; text-align:right">{{number_format($ing->monto,2)}}</td>
                                    @else
                                        <td class="monto" style="font-size:10px; text-align:right">{{number_format(0,2)}}</td>
                                    @endif 
                                    <td class="detalle">{{$ing->sustento}}</td>
                                    <td class="detalle">{{$ing->numerosustento}}</td>
                                    <td class="detalle">{{$ing->medioPago}}</td>
                                    <td class="detalle">{{$ing->numero}}</td>
                                </tr>

                                @endforeach
                                <tr>
                                    <td colspan="5"style="text-align:right;">Total </td>
                                    <td style="text-align:right;">{{number_format($ingresobanco,2)}}</td>
                                    <td style="text-align:right;">{{number_format($ingresosdolares,2)}}</td>
                                    <td colspan="4"></td>
                                </tr>
                            
                            </tbody>
                        </table>
                    </div>
                </div>
                            
                <div style="overflow-x:auto;">
                    <div class="table-responsive" >
                        <h3> Egresos </h3>
                        <table id="egresos" class="table table-bordered table-striped table-sm ">
                            <thead>
                                <tr class="bg-primary">
                                    <th>Fecha</th>
                                    <th>Cuenta</th>
                                    <th>Responsable</th>
                                    <th>Monto S/</th>
                                    <th>Monto $</th>
                                    <th>Sustento</th>
                                    <th>Numero</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach($egresosdetalle as $egr)
                                
                                <tr>
                                    <td class="fecha">{{date("d/m/Y", strtotime($egr->fecha))}}</td>
                                    <td class="proveniente">{{$egr->cuenta.' '.$egr->banco.' '.$egr->moneda}}</td>
                                    <td class="detalle">{{$egr->responsable}} </td> 
                                    @if($egr->moneda=="Soles")
                                        <td class="monto" style="font-size:10px; text-align:right">{{number_format($egr->monto,2)}}</td>
                                    @else
                                        <td class="monto" style="font-size:10px; text-align:right">{{number_format(0,2)}}</td>
                                    @endif  
                                    @if($egr->moneda=="Dolares")
                                        <td class="monto" style="font-size:10px; text-align:right">{{number_format($egr->monto,2)}}</td>
                                    @else
                                        <td class="monto" style="font-size:10px; text-align:right">{{number_format(0,2)}}</td>
                                    @endif 
                                    <td class="monto">{{$egr->sustento}}</td>
                                    <td class="monto">{{$egr->numerosustento}}</td>
                                </tr>

                                @endforeach
                                
                                <tr>
                                    <td colspan="3"style="text-align:right;">Total </td>
                                    <td style="text-align:right;">{{number_format($egresobanco,2)}}</td>
                                    <td style="text-align:right;">{{number_format($egresosdolares,2)}}</td>
                                    <td colspan="2"></td>
                                </tr>
                            </tbody>
                        </table>
                            

                    </div>
                </div>
                <div class="table-responsive col-md-3" style="width:50%">
                    <table class="table table-bordered table-striped table-sm resumen ">
                        <thead>
                            <tr class="bg-primary">
                                <th colspan="5" style="text-align:center">Resumen Caja</th>
                            </tr>
                            <tr class="bg-primary">
                                <th></th>
                                <th colspan="2" style="text-align:center">Soles</th>
                                <th colspan="2"style="text-align:center">Dolares</th>
                            </tr>
                            <tr class="bg-primary">
                                <th></th>
                                <th style="text-align:center">Ingresos</th>
                                <th style="text-align:center">Egresos</th>
                                <th style="text-align:center">Ingresos</th>
                                <th style="text-align:center">Egresos</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            <tr>

                                <td>Caja Bancos</td>
                                <td style="text-align:right; font-size:10px">{{number_format($ingresobanco,2)}}</td>
                                <td style="text-align:right; font-size:10px">{{number_format($egresobanco,2)}}</td>
                                <td style="text-align:right; font-size:10px">{{number_format($ingresosdolares,2)}}</td>
                                <td style="text-align:right; font-size:10px">{{number_format($egresosdolares,2)}}</td>
                                
                            </tr>
                            <tr>
                                <td>Saldo ACtual</td>
                                <td style="text-align:right; font-size:10px" colspan="2">{{number_format($ingresobanco-$egresosdolares,2)}}</td>
                                <td  style="text-align:right; font-size:10px" colspan="2">{{number_format($ingresosdolares-$egresosdolares,2)}}</td>
                            </tr>
                            

                        </tbody>
                    </table>
                </div>
                
                
            </div>
        </div>
    </div>
</div>
</body>

</html>