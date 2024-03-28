<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte de Caja</title>
    <style>
        
    </style>
</head>
<body>
<div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
    <div class="card">
        <div class="row">
            <div class="table-responsive" >
                <table id="egresos" class="table table-bordered table-striped table-sm">
                    <thead >
                        <tr >
                            <th colspan="3">Reporte de Caja</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            @if($sql5==0)
                                <td colspan="1">Usuario:</td>
                                <td colspan="3">Todos</td>
                            @else
                                <td colspan="1">Usuario:</td>
                                <td colspan="3">{{$usuario->nombre}}</td>
                
                            @endif
                        </tr>
                        <tr>
                            @if($sql6==0)
                                <td colspan="1">Sucursal:</td>
                                <td colspan="3">Todos</td>
                            @else
                                <td colspan="1">Sucursal:</td>
                                <td colspan="3">{{$sucursal->nombre}}<</td>>
                            @endif
                        </tr>
                        <tr>
                            @if($sql7==0)
                                <td colspan="1">Medio de Pagos:</td>
                                <td colspan="3">Todos</td>
                            @else
                                <td colspan="1">Medio de Pagoso:</td>
                                <td colspan="3">{{$medio->nombre}}<</td>>
                            @endif
                        </tr>
                        <tr style="color:black">
                            <th><b>fecha</b></th>
                            <th><b>Tipo</b></th>
                            <th><b>Descripcion</b></th>
                            <th><b>Monto</b></th>
                            <th><b>Medio de Pago</b></th>
                            <th><b>Usuario</b></th>
                            <th><b>Sucursal</b></th>
                        </tr>
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
</body>

</html>