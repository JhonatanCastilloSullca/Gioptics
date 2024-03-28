<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte de Compras</title>
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
                            <th colspan="3">Reporte de Compras</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            @if($sql5==0)
                                <td colspan="1">Proveedor:</td>
                                <td colspan="3">Todos</td>
                            @else
                                <td colspan="1">Proveedor:</td>
                                <td colspan="3">{{$proveedor->nombre}}</td>
                
                            @endif
                        </tr>
                        <tr>
                            @if($sql6==0)
                                <td colspan="1">Producto:</td>
                                <td colspan="3">Todos</td>
                            @else
                                <td colspan="1">Producto:</td>
                                <td colspan="3">{{$producto->categoria->nombre}}</td>>
                            @endif
                        </tr>
                        <tr class="bg-primary">
                            <th>fecha</th>
                            <th>Cantidad</th>
                            <th>Producto</th>
                            <th>Precio</th>
                            <th>Proveedor</th>
                            
                        </tr>
                            @foreach($compras as $compra)
                                @foreach($compra->detallecompras as $detalle)
                                <tr>
                                    <td>{{date("d/m/Y", strtotime($compra->fecha))}}</td>
                                    <td>{{$detalle->cantidad}}</td>
                                    <td>@foreach($detalle->productos as $producto)
                                        {{$producto->codigo}} {{$producto->categoria->nombre}}
                                        @foreach($producto->caracteristicas as $caracteristica)
                                             {{$caracteristica->nombre}}
                                        @endforeach
                                    @endforeach</td>
                                    <td>{{number_format($detalle->precio,2)}}</td>
                                    <td>@foreach($detalle->productos as $producto)
                                        {{$producto->proveedor->nombre}}
                                    @endforeach</td>
                                    
                                </tr>
                                @endforeach
                            @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</body>

</html>