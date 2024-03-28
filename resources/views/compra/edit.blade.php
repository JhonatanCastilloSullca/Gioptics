@extends('home')
@section('contenido')
<main class="main">
@foreach($compra as $compra)
    <?php $colspans = 6; ?>
    <div class="card-body">
    {{method_field('patch')}}
    {{csrf_field()}}
            <div class="form-group row">
                <div class="col-md-6">
                    <h3 style="display: inline;"><i class="fa fa-arrow-right fa-1x"></i>&nbsp;&nbsp;ingreso a inventario</h3>&nbsp;&nbsp;                    
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-3">  
                    <label class="form-control-label" for="idProveedor">Proveedor</label>
                        <select class="form-control selectpicker" name="idProveedor" id="idProveedor" data-live-search="true" required>
                            @foreach($proveedor as $prove)
                                <option value="{{$prove->id}}">{{$prove->nombre}}</option>
                            @endforeach
                        </select>
                </div>   
                <div class="col-md-3"> 
                </div> 
                <div class="col-md-3">  
                </div>
                <div class="col-md-3">  
                    <label class="form-control-label" for="idProveedor">Fecha</label>
                    <input type="date" id="fecha" name="fecha" class="form-control" value="<?php echo date("Y-m-d" );?>">    
                </div>                            
            </div>      
                <div style="display: flex;flex-wrap: nowrap;align-items: center;margin-bottom: 15px; padding-top: 20px;">
                    <h4  ">Detalle Compra</h4>
                    <button class="btn btn-success" type="button" data-toggle="modal" data-target="#abrirmodalEditarCategoria" style="border-radius: 0.5em;margin-left: 10px; font-size:0.75 !important;">
                        <i class="fa fa-plus fa-1x"></i>&nbsp;&nbsp;Agregar Producto
                    </button>
                </div>                     
            <div class="form-group row">
            @php $colspans=0 @endphp
            @php $totalpedido=0 @endphp
                @foreach($compra->categorias as $categoria)
                <div class="col-md-12" style="overflow-y:auto;margin-bottom: 40px;" id="{{$categoria->id}}">
                    <h6>{{$categoria->nombre}}</h6>
                    <table class="table table-bordered table-striped table-sm"style="min-width: max-content;">
                        <thead>
                            <tr class="bg-primary"  style="white-space: nowrap;" >
                                <th STYLE="width: 20px !important;">Cant.</th>
                                <th>Unidad</th>
                                <th STYLE="width: 100px !important;">Codigo</th>
                                <th>Producto</th>
                                
                                
                                @foreach($categoria->adicionales as $adi)                                    
                                    <th style="justify-content: space-between;">{{$adi->nombre}}</th>
                                @endforeach
                                <th STYLE="width: 120px !important;">PCM</th>
                                <th STYLE="width: 120px !important;">PVP</th>
                                <th>UBICACION</th>
                                <th>ACEPTAR</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($compra->detallecompras as $detalle)
                                @foreach($detalle->productos as $producto)
                                @if($producto->categoria_id==$categoria->id)
                                <tr  style="white-space: nowrap;" >
                                    <td>
                                        {{$producto->stock}}
                                    </td>
                                    <td>
                                        {{$producto->unidad->nombre}}
                                    </td>
                                    <td>
                                        {{$producto->codigo}}
                                    </td>
                                    <td>
                                        {{$producto->categoria->nombre}}
                                    </td>
                                    @foreach($producto->categoria->adicionales as $adicional)
                                        <td>
                                        @foreach($producto->caracteristicas as $caracteristica)
                                        
                                            @if($caracteristica->adicional_id == $adicional->id)
                                                {{$caracteristica->nombre}}
                                            @endif
                                        
                                        @endforeach
                                        </td>
                                    @endforeach
                                    <td>
                                        {{$producto->precio_compra}}
                                    </td>
                                    <td>
                                        {{$producto->precio}}
                                    </td>
                                    <td>
                                        {{$producto->sucursal->nombre}}
                                    </td>
                                    <td>
                                        <button type="submit" class="btn btn-success btn-sm guardar" >
                                            <i class="fa fa-check fa-1x"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    
                                    @php $colspans=$colspan+count($producto->categoria->adicionales) @endphp
                                    <td style="text-align:right !important" colspan="{{$colspans}}" >
                                        SUB TOTAL
                                    </td>
                                    <td >
                                        {{number_format($producto->precio_compra*$producto->stock,2)}}
                                    </td>
                                    @php $totalpedido=$totalpedido+$producto->precio_compra*$producto->stock @endphp
                                </tr>
                                @endif
                                @endforeach
                            @endforeach
                            <tr  style="white-space: nowrap;" >
                                <form action="{{route('detallecompra.store')}}" method="post" class="form-horizontal" enctype="multipart/form-data" autocomplete="off" >
                                    {{csrf_field()}}
                                    <input class="form-control" type="hidden" name="compra_id" id="compra_id" value="{{$compra->id}}">
                                    <input class="form-control" type="hidden" name="proveedor_id" id="proveedor_id">
                                <td>
                                    <input class="form-control" type="text" name="stock" id="stock">
                                    @error('stock')
                                        <span class="error-message" style="color:red">*</span>
                                    @enderror
                                </td>
                                <td>
                                    <select class="form-control"  name="unidad_id" id="unidad_id" live-data-search="true" style="text-transform: uppercase;">
                                        @foreach($unidades as $unidad)
                                            <option value="{{$unidad->id}}">{{$unidad->nombre}}</option>
                                        @endforeach
                                    </select>
                                    @error('unidad_id')
                                        <span class="error-message" style="color:red">*</span>
                                    @enderror
                                </td>
                                <td>
                                    <input class="form-control" type="text" name="codigo" id="codigo">
                                    @error('codigo')
                                        <span class="error-message" style="color:red">*</span>
                                    @enderror
                                </td>
                                <td>{{$categoria->nombre}}
                                    <input class="form-control" type="hidden" name="categoria_id" id="categoria_id" value="{{$categoria->id}}">
                                </td>
                                @foreach($categoria->adicionales as $adicional)
                                    <td>
                                        <select class="form-control "  name="caracteristica_id[]" id="caracteristica_id[]" live-data-search="true">
                                            @foreach($adicional->caracteristicas as $caracteristica)
                                                <option value="{{$caracteristica->id}}">{{$caracteristica->nombre}}</option>
                                            @endforeach
                                        </select>
                                        @error('caracteristica_id')
                                            <span class="error-message" style="color:red">*</span>
                                        @enderror
                                    </td>
                                @endforeach
                                <td>
                                    <input class="form-control" type="number" name="precio_compra" id="precio_compra"min="0.00" step="0.01">
                                    @error('precio_compra')
                                        <span class="error-message" style="color:red">*</span>
                                    @enderror
                                </td>
                                <td>
                                    <input class="form-control" type="number" name="precio" id="precio"min="0.00" step="0.01">
                                    @error('precio')
                                        <span class="error-message" style="color:red">*</span>
                                    @enderror
                                </td>
                                <td>
                                    <select class="form-control "  name="sucursal_id" id="sucursal_id" live-data-search="true">
                                        @foreach($sucursales as $sucursal)
                                            <option value="{{$sucursal->id}}">{{$sucursal->nombre}}</option>
                                        @endforeach
                                    </select>
                                    @error('sucursal_id')
                                        <span class="error-message" style="color:red">*</span>
                                    @enderror
                                </td>
                                <td>
                                    <button type="submit" class="btn btn-info btn-sm guardar" >
                                        <i class="fa fa-save fa-1x"></i>
                                    </button>
                                </td>
                                </form>
                            </tr>
                        </tbody>
                    </table>
                </div>
                @endforeach
            </div>
            <form action="{{route('compra.update','test')}}" method="POST" class="form-horizontal" enctype="multipart/form-data">
                {{method_field('patch')}}
                {{csrf_field()}}  
            <div class="form-group row">
                <div class="col-md-12" id="acuenta2">
                    <label class="form-control-label" for="impuesto">Observacion</label>
                    <input type="text" id="observacion" name="observacion" class="form-control" placeholder="Ingrese observacion">
                    @error('observacion')
                        <span class="error-message" style="color:red">*</span>
                    @enderror
                </div>
            </div>
            <div class="form-group row">                                            
                <div class="col-md-9" >
                </div>                                          
                <div class="col-md-3">
                    <label class="form-control-label" for="impuesto">Total Pedido</label>
                    <input type="text"  id="total" name="total" class="form-control" min="0.00" step="0.01" value="{{ number_format($totalpedido ,2) }}" disabled>
                    <input type="hidden"  id="totalpagar" name="totalpagar" value="{{ $totalpedido  }}" >
                </div>
            </div>
              
                <input type="hidden" id="fecha_enviar" name="fecha_enviar" >
                <input type="hidden" id="id_enviar" name="id_enviar" value="{{$compra->id}}" >
                @if($totalpedido>0)
                <div class="form-group row">                    
                    <div class="col-md-3" id="guardar">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <button type="submit" class="btn btn-success fechaenviar" style="margin-top: 28px; "><i class="fa fa-save fa-1x"></i> Registrar Ingreso</button>

                    </div>
                </div>
                @endif
            </form>

<div class="modal fade" id="abrirmodalEditarCategoria" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-primary modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Agregar Producto</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="{{route('categoriacompra.store')}}" method="post" class="form-horizontal" enctype="multipart/form-data" autocomplete="off" >
            {{csrf_field()}}
            <div class="modal-body">
                <input class="form-control" type="hidden" name="compra_id" id="compra_id" value="{{$compra->id}}">
                <select class="form-control selectpicker" name="categoria_id" id="categoria_id" data-live-search="true" >
                    @foreach($categorias as $categoria)
                        <option value="{{$categoria->id}}" >{{$categoria->nombre}}</option>
                    @endforeach
                </select>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success " style="border-radius:0.7em;" ><i class="fa fa-save fa-1x"></i> &nbsp; ACEPTAR</button>
                <button type="button" class="btn btn-danger" style="border-radius:0.7em;" data-dismiss="modal"><i class="fa fa-times fa-1x"></i> CERRAR</button>
                
            </div>
        </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!--Fin del modal-->
@endforeach
</main>

@push('scripts')
@if(!empty(Session::get('error_code')) && Session::get('error_code') == 5)
<script>
    $(function() {
        $('#abrirmodalEditar').modal('show');
    });
</script>       
@endif
<script>

$(document).on('click', '.enviar', function()
{
    var id=$("#tipo option:selected").val();
    $('#'+id+'').show();
    var proveedor=$("#idProveedor option:selected").val();
    $('#proveedor_id').val(proveedor);
});
$(document).on('click', '.guardar', function()
{
    var proveedor=$("#idProveedor option:selected").val();
    $('#proveedor_id').val(proveedor);
});

$(document).on('click', '.fechaenviar', function()
{
    var fecha=$("#fecha").val();
    $('#fecha_enviar').val(fecha);
});

$('#acuenta').keyup(saldo);
function saldo() {
    var total=$('#totalpagar').val();
    var acuenta=$('#acuenta').val();
    var saldo=total-acuenta;
    $('#saldo').val(saldo);
}



function valueChanged()
{
    var elementVar = document.getElementById("acuenta");
    var acuenta2=$('#totalpagar').val();
    if($('.coupon_question').is(":checked")){
        $(".cuotasr").show();
        elementVar.setAttribute("min", "0");
    }
    else{
        $(".cuotasr").hide();
        $("#cuotas").val('');
        $("#proxfecha").val('');
        elementVar.setAttribute("min", acuenta2);
    }
        
}
</script>
@endpush

@endsection