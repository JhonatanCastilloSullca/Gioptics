<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte de Productos</title>
    <style>



        body {
            margin: 0;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            font-size: 0.4rem;
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
            
            <img class="derecha" style="padding-top:0; margin-top:0; margin-right:1rem;" src="{{asset('img/logogo.png')}}" width="100px"  alt="admin@bootstrapmaster.com">
            <h3 style="text-align:center; font-size:15px;color:#94c11f;"> Reporte de Productos</h3>
            <br></br><br></br><br></br>
            <div class="card-body" style="margin-top:0.8rem;">
                    <div style="overflow-x:auto;">
                            <div class="table-responsive" >
                               <table  class="table table-bordered table-striped table-sm">
                                <thead>
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
                                </thead>
                                <tbody>@php $cont=1 @endphp
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
        </div>
    </div>
</div>
</body>

</html>