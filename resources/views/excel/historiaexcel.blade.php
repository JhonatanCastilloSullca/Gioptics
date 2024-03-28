<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte de Historia</title>
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
                            <th colspan="3">Reporte de Historia</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            @if($sql5==0)
                                <td colspan="1">Optometra:</td>
                                <td colspan="3">Todos</td>
                            @else
                                <td colspan="1">Optometra:</td>
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
                                <td colspan="1">Paciente:</td>
                                <td colspan="3">Todos</td>
                            @else
                                <td colspan="1">Paciente:</td>
                                <td colspan="3">{{$paciente->nombre}}<</td>>
                            @endif
                        </tr>
                        <tr style="color:black">
                            <th><b>fecha</b></th>
                            <th><b>Paciente</b></th>
                            <th><b>Optometra</b></th>
                            <th><b>Sucursal</b></th>
                        </tr>
                        <tbody>
                            @foreach($historias as $his)
                                <tr>
                                    <td>{{date("d/m/Y", strtotime($his->fecha))}}</td>
                                    <td>{{$his->paciente}}</td>
                                    <td>{{$his->usuario}}</td>
                                    <td>{{$his->sucursal}}</td>
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