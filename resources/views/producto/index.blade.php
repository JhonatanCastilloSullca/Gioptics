@extends('home')
@section('contenido')
<main class="main">
            <!-- Breadcrumb -->
          
            <div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
                <div class="card">
                    <div class="card-header">
                        
                        <h2><i class="fa fa-tag fa-1x"></i>&nbsp;&nbsp;Productos en Inventario</h2><br/>
                    </div>
                    <div class="card-body">
                        {!!Form::open(array('url'=>'producto','method'=>'GET','autocomplete'=>'off','role'=>'search'))!!}
                        <div class="form-group row">
                            <div class="col-md-4">
                                <label class="form-control-label" for="direccion">buscar producto &nbsp;&nbsp;<i class="fa fa-search fa-1x"></i></label>
                                <select class="form-control selectpicker" name="buscarProducto" id="buscarProducto" data-live-search="true" required>
                                    <option value="0" disabled>Seleccione</option>
                                    @foreach($categorias as $categoria)
                                        <option value="{{$categoria->id}}" {{ $sql == $categoria->id ? 'selected' : '' }}>{{$categoria->nombre}}</option>
                                    @endforeach
                                </select>
                                @error('buscarProducto')
                                    <span class="error-message" style="color:red">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label class="form-control-label" for="direccion">filtrar - criterio 1 &nbsp;&nbsp;<i class="fa fa-filter fa-1x"></i></label>
                                <input type="text" id="buscarTexto" name="buscarTexto" class="form-control" placeholder="Ingrese atributo" value="{{$sql2}}" >
                                @error('buscarTexto')
                                    <span class="error-message" style="color:red">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label class="form-control-label" for="direccion">filtrar - criterio 2 &nbsp;&nbsp;<i class="fa fa-filter fa-1x"></i></label>
                                <input type="text" id="buscarTexto2" name="buscarTexto2" class="form-control" placeholder="Ingrese atributo" value="{{$sql3}}" >
                                @error('buscarTexto2')
                                    <span class="error-message" style="color:red">{{ $message }}</span>
                                @enderror
                            </div>
                            
                            <br>
                             <div class="col-md-4" style="padding-top: 15px;">
                                <label class="form-control-label" for="direccion">Buscar más &nbsp;&nbsp;<i class="fa fa-gear fa-1x"></i></label>
                                <input type="text" id="buscarTexto3" name="buscarTexto3" class="form-control" placeholder="codigo, ubicacion, proveedor" value="{{$sql4}}" >
                                @error('buscarTexto3')
                                    <span class="error-message" style="color:red">{{ $message }}</span>
                                @enderror
                            </div>  
                             <div class="col-md-4" style="padding-top: 15px;">
                                
                            </div>
                            @if($sql2=="")
                                @php $sql2="%%" @endphp
                            @endif
                            @if($sql3=="")
                                @php $sql3="%%" @endphp
                            @endif
                            @if($sql4=="")
                                @php $sql4="%%" @endphp
                            @endif
                            @php $sql_e=[$sql,$sql2,$sql3,$sql4]; @endphp
                            <div class="col-md-4" style="padding-top: 15px;">
                                <button type="submit" style="margin-top: 30px;" id="buscar" class="btn btn-success"><i class="fa fa-search"></i> Buscar</button>&nbsp;&nbsp;
                                <a href="{{url('productospdf',$sql_e)}}" target="_blank">
                                    <button type="button" class="btn btn-danger " style='margin-top: 30px;text-align:right;border-radius: 0.7em;'>
                                        <i class="fa fa-file"></i>&nbsp;&nbsp;PDF
                                    </button>
        
                                </a>&nbsp;&nbsp;
                                <a href="{{url('productosexcel',$sql_e)}}" target="_blank">
                                    <button type="button" class="btn btn-success " style='margin-top: 30px;text-align:right;border-radius: 0.7em;'>
                                        <i class="fa fa-file"></i>&nbsp;&nbsp;Excel
                                    </button>
        
                                </a>
                            </div>
                    </div>
                        </div>
                        
                        {{Form::close()}} 
                        <div style="overflow-y:auto;margin-bottom: 40px;" >
                                <h3>{{$categoria12->nombre}}</h3>
                            <table  class="table table-bordered table-striped table-sm">
                                <thead>
                                    <tr style="white-space: nowrap; font-size:12px" class="bg-primary">
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
                                        <th>Proveedor</th> 
                                        <th>ubicacion</th>
                                        @if($categoria12->tipo=="CON STOCK")
                                        <th>Cambiar</th>
                                        @endif
                                        
                                    </tr>
                                </thead>
                                <tbody>@php $cont=1 @endphp
                                @foreach($productos as $producto)
                                
                                    <tr style="white-space: nowrap; font-size:12px">
                                        <td class="stock">{{$producto->stock}}<input type="hidden" name="id_producto" id="id_producto" class="id_producto" value="{{$producto->id}}"></td>
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
                                       
                                        <td class="sucursal_id">{{$producto->proveedor->nombre}}</td>
                                        <td class="sucursal_id">{{$producto->sucursal->nombre}}</td>
                                        @if($categoria12->tipo=="CON STOCK")
                                        <td>
                                            <a class="edit" data-toggle="modal" data-id_usuario="'$producto->id'"  data-target="#abrirmodal">
                                            <button type="button" class="btn btn-info btn-sm" >
                                                <i class="fa fa-edit fa-1x"></i>
                                            </button> </a>&nbsp;
                                            </td>
                                        @endif
                                    </tr>
                                    @php $cont=$cont+1 @endphp
                                    @endforeach
                                
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- Fin ejemplo de tabla Listado -->
            </div>
            <!--Inicio del modal agregar-->
            <div class="modal fade" id="abrirmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Actualizar Producto</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                        </div>
                       
                        <div class="modal-body">
                            <form action="{{route('producto.update','test')}}" method="post" class="form-horizontal" enctype="multipart/form-data" autocomplete="off">
                                
                                {{method_field('patch')}}

                                {{csrf_field()}}

                                <input type="hidden" id="id_producto2" name="id_producto2" value="">
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="nombre">Cantidad: </label>
                                    <div class="col-md-9">
                                        <input type="number" id="cantidad" name="cantidad" class="form-control" placeholder="Ingrese la Cantidad" value="{{old('cantidad')}}" min="1" >
                                        
                                        @error('cantidad')
                                            <span class="error-message" style="color:red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="password">Ubicacion: </label>
                                    <div class="col-md-9">
                                        <select name="idSucursal" id="idSucursal" class="form-control selectpicker" data-live-search="true">
                                            @foreach($sucursales as $sucursal)
                                                <option value="{{$sucursal->id}}">{{$sucursal->nombre}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-success" style="border-radius:0.7em;"><i class="fa fa-save fa-1x"></i> Guardar</button>
                                    <button type="button" class="btn btn-danger" style="border-radius:0.7em;" data-dismiss="modal"><i class="fa fa-times fa-1x"></i> Cancelar</button>
                                    
                                </div>

                            </form>
                            
                        </div>
                        
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!--Fin del modal-->



           
            
        </main>


@push('scripts')

@if(!empty(Session::get('error_code')) && Session::get('error_code') == 5)
<script>
$(function() {
    $('#abrirmodalEditar').modal('show');
});
</script>       
@endif   
@if(!empty(Session::get('error_code')) && Session::get('error_code') == 6)
<script>
$(function() {
    $('#abrirmodalEditarCategoria').modal('show');
});
</script>       
@endif   
<script> 

        
$(document).on('click', '.edit', function()
{
    var _this = $(this).parents('tr');
    var mayor=_this.find('.stock').text();
    var saldosoles = document.getElementById("cantidad").setAttribute('max',mayor);
    $('#id_producto2').val(_this.find('.id_producto').val());
});


</script>  


@endpush

@endsection