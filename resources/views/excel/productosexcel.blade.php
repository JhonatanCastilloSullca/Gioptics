<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte de Productos</title>
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
                            <th colspan="3">Reporte de Productos</th>
                        </tr>
                    </thead>@php $cont=1 @endphp
                     <tbody>
                         <tr></tr>
                        <tr></tr>
                         <tr style="white-space: nowrap; font-size:10px" class="bg-primary">
                                <th>Cant.</th>
                                <th>Unidad</th>                                                                                
                                <th>Codigo</th>
                                <th>Producto</th>
                                @foreach($categorias as $categoria)
                                    @foreach($categoria->adicionales as $prad)
                                        @if($sql==$prad->pivot->categoria_id)  
                                            <th>
                                                {{$prad->nombre}}
                                                
                                            </th>
                                        @endif
                                    @endforeach
                                @endforeach
                                <th>Precio de Venta</th>
                                <th>Precio de Compra</th>
                                <th>Proveedor</th> 
                                <th>ubicacion</th>
                            </tr>
                            
                        @foreach($productos as $producto)
                        
                            <tr style="white-space: nowrap; font-size:10px">
                                <td class="stock">{{$producto->stock}}</td>
                                <td class="unidad_id">{{$producto->unidad->nombre}}</td>
                                <td class="codigo">{{$producto->codigo}}</td>                                        
                                <td class="categoria_id">{{$producto->categoria->nombre}}</td>
                                @foreach($producto->categoria->adicionales as $adicional)
                                    <td>
                                        @foreach($producto->caracteristicas as $caracteristica)
                                        
                                            @if($caracteristica->adicional_id == $adicional->id)
                                                {{$caracteristica->nombre}}
                                            @endif
                                        
                                        @endforeach
                                        </td>
                                @endforeach
                                <td class="precio">{{$producto->precio}}</td>
                                <td class="precio_compra">{{$producto->precio_compra}}</td>
                                <td class="sucursal_id">{{$producto->proveedor->nombre}}</td>
                                <td class="sucursal_id">{{$producto->sucursal->nombre}}</td>
                            </tr>
                            @php $cont=$cont+1 @endphp
                            @endforeach
                        
                        </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</body>

</html>