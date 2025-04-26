<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte de Cajas</title>
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
            
            <img class="derecha" style="padding-top:0; margin-top:0; margin-right:1rem;" src="{{asset('img/logo-gstore.png')}}"  width="120px"  alt="admin@bootstrapmaster.com">
            <h3 style="text-align:center; font-size:15px;color:#94c11f;"> Reporte de Cajas</h3>
            <br>
            @if($sql5==0)
                <h4>Usuario: Todos</h4>
            @else
                <h4>Usuario: {{$usuario->nombre}}</h4>
            @endif
            @if($sql6==0)
                <h4>Sucursal: Todos</h4>
            @else
                <h4>Sucursal: {{$sucursal->nombre}}</h4>
            @endif
            @if($sql7==0)
                <h4>Medio de Pago: Todos</h4>
            @else
                <h4>Medio de Pago: {{$medio->nombre}}</h4>
            @endif
            <div class="card-body" style="margin-top:0.5rem;">
                    <div style="overflow-x:auto;">
                            <div class="table-responsive" >
                                <table id="egresos" class="table table-bordered table-striped table-sm">
                                    <thead>
                                        <tr style="background-color: #94c11f; color:#ffffff; font-size:12px ">
                                            <th>fecha</th>
                                            <th>Tipo</th>
                                            <th>Descripcion</th>
                                            <th>Monto</th>
                                            <th>Medio de Pago</th>
                                            <th>Usuario</th>
                                            <th>Sucursal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($cajas as $caj)
                                        <tr>
                                            <td>{{date("d/m/Y", strtotime($caj->fecha))}}</td>
                                            <td>{{$caj->tipo}}</td>
                                            <td>{{$caj->descripcion}}</td>
                                            <td>{{number_format($caj->monto,2)}}</td>
                                            <td>{{$caj->medio}} {{$caj->banco}}</td>
                                            <td>{{$caj->usuario}}</td>
                                            <td>{{$caj->sucursal}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
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