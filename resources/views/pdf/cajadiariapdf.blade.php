<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Caja Diaria</title>
    <style>



        body {
            margin: 0;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            font-size: 0.6rem;
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
            <img class="derecha" style="padding-top:0; margin-top:0; margin-right:1rem;" src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('img/logogstore.png'))) }}"  width="100px"  alt="admin@bootstrapmaster.com">
            <h3 style="text-align:center; font-size:15px;color:#94c11f;"> Caja Diaria {{date("d/m/Y", strtotime($sql2))}}</h3>
            @foreach($usuario as $use)
                <h4>SUCURSAL: {{$use->sucursal}}</h4><br>
            @endforeach
            <div class="card-body" style="margin-top:0.5rem;">
                    <div style="overflow-x:auto;">
                            <div class="table-responsive" >
                                <table id="cajas" class="table table-bordered table-striped table-sm" style="width: 100%;">
                                <thead>                                                                    
                                    <tr class="bg-primary">
                                        <th rowspan="2">documento</th>
                                        <th rowspan="2">detalle</th>
                                        <th colspan="2" style="text-align:center;">Ingreso</th>
                                        <th colspan="2" style="text-align:center;">egreso</th>
                                        <th rowspan="2">usuario</th>
                                    </tr>
                                    <tr class="bg-primary">
                                        <th>Monto</th>
                                        <th>Medio de Pago</th>
                                        <th>Monto</th>
                                        <th>Medio de Pago</th>
                                    </tr>
                                </thead>
                                <tbody style="text-align-last: center;">
                                @php $ingresosefectivo=0 @endphp
                                @php $ingresosdeposito=0 @endphp
                                @foreach($cajas as $caja)                                
                                    <tr style="text-align:center !important;">
                                        <td class="nombre"><input type="hidden" name="id_caja" id="id_caja" class="id_caja" value="{{$caja->id}}">
                                            {{$caja->documento}} - {{$caja->numero}}
                                        </td>                                        
                                        <td class="codigo">{{$caja->descripcion}}</td>
                                        @if($caja->tipo=="Ingreso")
                                            
                                            <td class="efectivo">{{number_format($caja->monto,2)}}</td>
                                            <td class="color">{{$caja->medio}} {{$caja->banco}}</td>
                                            <td class="color"></td>
                                            <td class="color"></td>
                                        @else
                                            <td class="color"></td>
                                            <td class="efectivo"></td>
                                            <td class="efectivo">{{number_format($caja->monto,2)}}</td>
                                            <td class="color">{{$caja->medio}} {{$caja->banco}}</td>
                                        @endif                            
                                        
                                        <td>
                                            {{$caja->usuario}}
                                        </td>
                                    </tr>
                                @endforeach
                                
                                </tbody>
                                <tfoot>
                                    <td colspan="2" style="text-align:right">BALANCE TOTAL: </td>
                                    <td class="color">{{number_format($ingresos,2)}}</td>
                                    <td class="color"></td>
                                    <td class="color">{{$egresos}}</td>
                                    <td></td>
                                </tfoot>
                            </table>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>

</html>