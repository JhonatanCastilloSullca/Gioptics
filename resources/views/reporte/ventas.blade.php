@extends('home')
@section('contenido')
<main class="main">
    <div class="container-fluid">
    <!-- Ejemplo de tabla Listado -->
        <div class="card">
            <div class="card-header">
                <h2><i class="fa fa-book fa-1x"></i>&nbsp;&nbsp;Reporte Ventas</h2><br/>                      
            </div>
            <div class="card-body">                        

                {!!Form::open(array('url'=>'ventas','method'=>'GET','autocomplete'=>'off','role'=>'search'))!!}
                <div class="form-group row">
                    <div class="col-md-1">
                        <label style="padding-top: 10px"><strong> Fecha </strong></label>
                    </div>
                    <div class="col-md-6">
                        <div class="input-group" id="buscarFecha">
                            <input type="date" id="buscarFechaInicio" name="buscarFechaInicio" class="form-control" placeholder="Fecha Inicio" value="{{$sql2}}">
                            <label style="padding-top: 10px"><strong> &nbsp;&nbsp; / &nbsp;&nbsp;</strong></label>
                            <input type="date" id="buscarFechaFin" name="buscarFechaFin" class="form-control" placeholder="Fecha Fin" value="{{$sql3}}">
                        </div>
                    </div>
                    <div class="col-md-5">
                    </div>
                    <br></br><br>
                    <div class="col-md-1">
                        <label style="padding-top: 7px"><strong> Vendedor </strong></label>
                    </div>
                    <div class="col-md-3">
                        <div id="buscarProyecto1">
                            <select class="form-control selectpicker" id="buscarUsuario" name="buscarUsuario"  data-live-search="true">
                                <option value="0">Todos</option>
                                @foreach($usuarios as $use)
                                    <option value="{{$use->id}}">{{$use->nombre}}</option>
                                @endforeach
                            </select>      
                        </div>
                        <br>
                    </div>
                    <div class="col-md-1">
                        <label style="padding-top: 7px"><strong> Tienda </strong></label>
                    </div>
                    <div class="col-md-3">
                        <div id="buscarProyecto1">
                            <select class="form-control selectpicker" id="buscarSucursal" name="buscarSucursal"  data-live-search="true">
                                <option value="0">Todos</option>
                                @foreach($sucursales as $suc)
                                    <option value="{{$suc->id}}">{{$suc->nombre}}</option>
                                @endforeach
                            </select>  
                        </div>
                        <br>
                    </div>
                    <div class="col-md-4">
                    </div>
                    <br></br><br>
                    <div class="col-md-1">
                        <label style="padding-top: 7px"><strong> Producto </strong></label>
                    </div>
                    <div class="col-md-3">
                        <div id="buscarProyecto1">
                            <select class="form-control selectpicker" id="buscarProducto" name="buscarProducto"  data-live-search="true">
                                <option value="0">Todos</option>
                                @foreach($productos as $prod)
                                    <option value="{{$prod->id}}">{{$prod->nombre}}</option>
                                @endforeach
                            </select>  
                        </div>
                        <br>
                    </div>
                    <div class="col-md-1">
                        <div class="input-group">
                            <button type="submit"  id="buscar" class="btn btn-success"><i class="fa fa-search"></i> Buscar</button>
                        </div>
                        {{Form::close()}} 
                    </div>
                    @php $sql=[$sql2,$sql4,$sql5,$sql6,$sql7]; @endphp
                            
                    <div class="col-md-3">
                        
                        <a href="{{url('ventaspdf',$sql)}}" target="_blank">
                            <button type="button" class="btn btn-danger " style='text-align:right;border-radius: 0.8em;'>
                                <i class="fa fa-file"></i>&nbsp;&nbsp;Reporte PDF
                            </button>

                        </a>&nbsp;&nbsp;
                        <a href="{{url('ventasexcel',$sql)}}" target="_blank">
                            <button type="button" class="btn btn-success " style='text-align:right'>
                                <i class="fa fa-file"></i>&nbsp;&nbsp;Reporte Excel
                            </button>

                        </a>
                        
                    </div>
                </div>
                <div style="overflow-x:auto;overflow-y:auto;">
                    <div class="table-responsive" >
                        
                        <table id="reservas" class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr class="bg-primary">
                                    <th>fecha</th>
                                    <th>Cantidad</th>
                                    <th>Producto</th>
                                    <th>Precio</th>
                                    <th>Vendedor</th>
                                    <th>Tienda</th>
                                    <th>Ver</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($ventas as $venta)
                             @foreach($venta->detalleventas as $detalle)
                                <tr>
                                    <td>{{date("d/m/Y", strtotime($venta->fecha))}}</td>
                                    <td>{{$detalle->cantidad}}</td>
                                    <td>@foreach($detalle->productos as $producto)
                                            {{$producto->codigo}} {{$producto->categoria->nombre}}
                                            @foreach($producto->caracteristicas as $caracteristica)
                                                {{$caracteristica->nombre}}
                                            @endforeach
                                        @endforeach</td>
                                    <td>{{number_format($detalle->precio,2)}}</td>
                                    <td>{{$venta->vendedor->nombre}}</td>
                                    <td>{{$venta->sucursal->nombre}}</td>
                                    <td>
                                        <a href="{{URL::action('App\Http\Controllers\VentaController@show',$venta->id)}}" > 
                                            <button type="button" class="btn btn-danger btn-md">
                                            <i class="fa fa-eye fa-1x"></i>
                                            </button>
                                        </a>
                                        <input type="hidden" name="id_enviar" id="id_enviar" class="id_enviar" >
                                    </td>
                                </tr>
                               @endforeach
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- Fin ejemplo de tabla Listado -->
    </div>
            
</main>


        @push('scripts')
<script>
    
    $(document).on('click', '.edit', function()
        {
            var _this = $(this).parents('tr');
            $('#id_detalle2').val(_this.find('.id_detalle_1').val());
            $('#saldo').val(_this.find('.saldo').text());
            
        });
        
</script>


@endpush

@endsection