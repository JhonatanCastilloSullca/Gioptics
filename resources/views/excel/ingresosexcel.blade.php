<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte de Ingresos al Sistema</title>
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
                            <th colspan="3">Reporte de Ingresos al Sistema</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            @if($sql5==0)
                                <td colspan="1">Usuarios:</td>
                                <td colspan="3">Todos</td>
                            @else
                                <td colspan="1">Usuarios:</td>
                                <td colspan="3">{{$usuario->nombre}}</td>
                
                            @endif
                        </tr>
                        <tr>
                            @if($sql6==0)
                                <td colspan="1">Sucursal:</td>
                                <td colspan="3">Todos</td>
                            @else
                                <td colspan="1">Sucursal:</td>
                                <td colspan="3">{{$sucursal->nombre}}</td>>
                            @endif
                        </tr>
                        <tr style="color:black">
                            <th><b>Usuario</b></th>
                            <th><b>Tipo</b></th>
                            <th><b>Fecha</b></th>
                            <th><b>Sucursal</b></th>
                        </tr>
                            @foreach($ingresos as $ing)
                                <tr>
                                    <td>{{$ing->usuario}}</td>
                                    <td>{{$ing->tipo}}</td>
                                    <td>{{date(" h:i a   d/m/Y  ", strtotime($ing->fecha))}}</td>
                                    <td>{{$ing->sucursal}}</td>
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