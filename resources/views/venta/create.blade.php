@extends('home')
@section('contenido')
<main class="main">
    <div class="card-body">
    <form action="{{route('venta.store')}}" method="POST">
    {{csrf_field()}}
            <div class="form-group row">
                <div class="col-md-6">
                    <h3 style="display: inline;"><span class="fa fa-shopping-cart"></span> &nbsp; Agregar PEDIDO</h3>&nbsp;&nbsp;&nbsp;&nbsp;
                    <span style="display: block;font-style: italic;"> (*) Campo obligatorio</span><br/>
                    
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-3">  
                    <label class="form-control-label" for="nombre">Nombre del Cliente</label>
                        <span class="input-group-btn"> 
                            <select class="form-control selectpicker" name="idCliente" id="idCliente" data-live-search="true" required>
                                <option value="0" >Buscar</option>
                                @foreach($clientes as $client)
                                    <option value="{{$client->id}}" {{ old('idCliente') == $client->id ? 'selected' : '' }}>{{$client->nombre}}</option>
                                @endforeach
                            </select>
                            <button  id="enviar_1" type="button" class="btn btn-default btn-success btn-number enviar" data-toggle="modal" data-target="#abrirmodalEditar" style="border-radius:0px;">
                                <span class="fa fa-plus"></span>
                            </button>
                        </span>
                    @error('idCliente')
                        <span class="error-message" style="color:red">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="form-control-label" for="rubro">Paciente</label>
                        <span class="input-group-btn"> 
                            <select wire:model='idMedida'  class="form-control selectpicker" name="idMedida" id="idMedida" data-live-search="true" required>
                                @foreach($medidas as $medida)
                                    <option value="{{$medida->id}}_{{$medida->paciente}}_{{$medida->num_documento}}_{{$medida->tipo_documento}}_{{$medida->celular}}_{{$medida->email}}" {{ old('idMedida') == $medida->id."_".$medida->paciente."_".$medida->num_documento."_".$medida->tipo_documento."_".$medida->celular."_".$medida->email ? 'selected' : '' }}>{{$medida->paciente}}</option>
                                @endforeach
                            </select>  
                        </span>
                    </div>
                </div>
            </div>
            <div class="form-group row" id="tablamedida">
                <div class="table-responsive col-md-12">
                    <table id="medidas" class="table table-bordered table-striped table-sm" style="text-align-last: center;vertical-align: middle;">
                        <tbody>
                            <tr class="bg-primary">
                                <td colspan="7">Medidas Oftalmologicas</td>
                            </tr>
                            <tr class="bg-secondary">
                                <td rowspan="2"></td>
                                <td colspan="3">Ojo Derecho</td>
                                <td colspan="3">Ojo Izquierdo</td>
                            </tr>
                            <tr class="bg-secondary">
                                <td>Esferico</td>
                                <td>Cilindro</td>
                                <td>Eje</td>
                                <td>Esferico</td>
                                <td>Cilindro</td>
                                <td>Eje</td>
                            </tr>
                            <tr>
                                <td>Para visión de lejos</td>
                                <td id="odvle">
                                </td>
                                <td  id="odvlc">
                                </td>
                                
                                <td  id="odvleje">
                                </td>
                                <td  id="oivle">
                                </td>
                                <td  id="oivlc">
                                </td>
                                <td  id="oivleje">
                                </td>
                            </tr>
                            <tr>
                                <td>Para visión de cerca</td>
                                <td  id="odvce">
                                </td>
                                <td  id="odvcc">
                                </td>
                                
                                <td  id="odvceje">
                                </td>                                </td>
                                <td  id="oivce">
                                </td>
                                <td  id="oivcc">
                                </td>
                                <td  id="oivceje">
                                </td>
                            </tr>
                            <tr>
                                <td>DIP</td>
                                <td  id="dip">
                                </td>
                                <td rowspan="2">Indicaciones</td>
                                <td colspan="4" rowspan="2"  id="indicaciones">
                                
                                </td>
                            </tr>
                            <tr>
                                <td>ADD</td>
                                <td  id="add">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    
                </div>
            </div>
                <h4>Detalle Venta</h4>
                <div class="form-group row">
                    <div class="col-md-1">
                            <label class="form-control-label" for="cantidad">Cantidad</label>
                            <input type="number" id="cantidad" name="cantidad" style="text-transform:uppercase;" class="form-control" value="1" >
                    </div>
                    
                    <div class="col-md-6 ">
                        <label class="form-control-label" for="nombre">Producto</label>      
                        <select  class="form-control selectpicker" name="idProducto" id="idProducto" data-live-search="true" required  >
                        <option value="0"> SELECCIONE</option>
                        @foreach($productos as $producto)
                            <option value="{{$producto->id}}_{{$producto->precio}}_{{$producto->codigo}}_{{$producto->categoria->nombre}}_{{$producto->stock}}_{{$producto->categoria->tipo}}" >
                                {{$producto->codigo}} {{$producto->categoria->nombre}}@foreach($producto->caracteristicas as $caracteristica) {{$caracteristica->nombre}}@endforeach
                            </option>
                        @endforeach
                        </select>  
                    </div>
                    
                    <div class="col-md-3">
                            <label class="form-control-label" for="impuesto">Precio </label>
                                <input type="number" id="precio_v" name="precio_v" class="form-control" placeholder="Ingrese precio" disabled>
                            
                    </div>
                    <div class="col-md-2">
                        <button type="button" id="agregar" class="btn btn-success" style="margin-top: 28px;: " ><i class="fa fa-plus fa-1x"></i> Agregar Producto</button>
                    </div>
                </div>
            <div class="form-group row">
                <div class="table-responsive col-md-12">
                    <table id="detalles" class="table table-bordered table-striped table-sm">
                        <thead>
                            <tr class="bg-success">
                                <th style="width:20px !important">Cantidad</th>
                                <th>Producto</th>
                                <th>PU</th>
                                <th>SubTotal</th>
                                <th style="width:20px !important"><i class="fa fa-trash fa-1x"></th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="form-group row" style="justify-content: right;">
                <div class="col-md-3">  
                    <label class="form-control-label" for="nombre">Total</label>
                </div>
                <div class="col-md-3">  
                    <input type="hidden" name="total_pagar" id="total_pagar">
                    <input type="text" class="form-control" id="total_pagar22" name="total_pagar22" value="0" disabled>
                    @error('descuento')
                        <span class="error-message" style="color:red">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="form-group row" style="justify-content: right;">
                <div class="col-md-3">  
                    <label class="form-control-label" for="nombre">Descuento</label>
                </div>
                <div class="col-md-3">  
                    <span class="input-group-btn"> 
                        <input type="hidden" class="form-control" id="valor_descuento" name="valor_descuento" value="$">
                        <input type="number" class="form-control" id="descuento" name="descuento" value="0">
                        <button  id="descuento_e" type="button" class="btn btn-default btn-success btn-number" style="border-radius:0">
                            %
                        </button>
                        <button  id="descuento_o" type="button" class="btn btn-default btn-success btn-number" style="border-radius:0">
                            $
                        </button>
                    </span>
                    @error('descuento')
                    <span class="error-message" style="color:red">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="form-group row" style="justify-content: right;">
                <div class="col-md-3">  
                    <label class="form-control-label" for="nombre">IMPORTE A PAGAR</label>
                </div>
                <div class="col-md-3">  
                    <input type="text" class="form-control" id="importepagar" name="importepagar" value="0" disabled>
                </div>
            </div>
            
            <div class="form-group row">
                <div class="col-md-12" id="acuenta2">
                    <label class="form-control-label" for="impuesto">Observacion</label>
                    <input type="text" id="observacion" name="observacion" class="form-control" placeholder="Ingrese observacion">
                    @error('observacion')
                        <span class="error-message" style="color:red">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="form-group row" id="guardar">
                <div class="col-md-3">  
                    <label class="form-control-label" for="nombre">Medio de Pago</label>
                        <select class="form-control selectpicker"  data-style="btn-success" name="idMedios" id="idMedios" data-live-search="true" required>
                        <option value="0" disabled>Seleccione</option>
                            @foreach($medios as $med)
                                <option value="{{$med->id}}" {{ old('idMedios') == $med->id ? 'selected' : '' }}> {{$med->banco}}</option>
                            @endforeach
                        </select>
                    @error('idMedios')
                        <span class="error-message" style="color:red">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-3" id="acuenta2">
                    <label class="form-control-label" for="impuesto">A cuenta</label>
                    <input type="number" id="acuenta" name="acuenta" class="form-control" placeholder="Ingrese cantidad" required>
                    @error('acuenta')
                        <span class="error-message" style="color:red">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-3" id="saldo2">
                    <label class="form-control-label" for="impuesto">Saldo</label>
                    <input type="number" disabled id="saldo" name="saldo" class="form-control" placeholder="" >
                    @error('saldo')
                        <span class="error-message" style="color:red">{{ $message }}</span>
                    @enderror
                </div>
            
                <div class="col-md-3" >
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <button type="submit" class="btn btn-success" style="margin-top: 28px; "><i class="fa fa-save fa-1x"></i> Registrar</button>&nbsp;&nbsp;
                    <button type="button" class="btn btn-danger" style="border-radius:0.7em;margin-top: 28px;">
                        <a href="{{url('venta/create')}}" onclick="event.preventDefault(); document.getElementById('venta-create-form').submit();" style="color:#ffffff"><i class="fa fa-times fa-1x"></i> Cancelar</a>
                        <form id="venta-create-form" action="{{url('venta/create')}}" method="GET" style="display: none">
                        {{csrf_field()}} 
                        </form>
                    </button>
                </div>
            </div>


        </form>
        <!--Inicio del modal actualizar-->
        <div class="modal fade" id="abrirmodalEditar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Agregar Cliente</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">X</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{route('cliente.store')}}" method="post" class="form-horizontal" enctype="multipart/form-data" autocomplete="off" >
                                {{csrf_field()}}
                                @include('cliente.form')
                                <input type="hidden" name="idMedida" id="idMedida">
                                <input type="hidden" name="idCliente" id="idCliente" value="{{$ultimo}}">
                            </form>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!--Fin del modal-->

    </div><!--fin del div card body-->
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


$("#acuenta").keyup(porcentaje);

$("#tablamedida").hide();
$("#descuento_e").hide();
$("#guardar").hide();
$("#idMedida").change(agregarMedida);

$(document).on('click', '.enviar', function()
{
    $("input[name='idMedida']").val($('#idMedida').val());
});

function agregarMedida(){
    datosMedida = document.getElementById('idMedida').value.split('_');
    idmedida= datosMedida[0];
    <?php foreach ($medidas2  as $med): ?>
        if('{{$med->id}}'==idmedida){     
            $("#odvle").text('{{$med->odvle}}');
            $('#odvlc').text('{{$med->odvlc}}');
            $('#odvleje').text('{{$med->odvleje}}');
            $('#oivle').text('{{$med->oivle}}');        
            $('#oivlc').text('{{$med->oivlc}}');
            $('#oivleje').text('{{$med->oivleje}}');-
            $("#odvce").text('{{$med->odvce}}');
            $('#odvcc').text('{{$med->odvcc}}');
            $('#odvceje').text('{{$med->odvceje}}');
            $('#oivce').text('{{$med->oivce}}');        
            $('#oivcc').text('{{$med->oivcc}}');
            $('#oivceje').text('{{$med->oivceje}}');
            $('#dip').text('{{$med->dip}}');        
            $('#indicaciones').text('{{$med->indicaciones}}');
            $('#add').text('{{$med->add}}');
            $("#tablamedida").show();
        }
        if(1==idmedida){
            $("#tablamedida").hide();
        }
    <?php endforeach ?>
    
}


$(document).ready(function(){
    $("#descuento_e").click(function(){
        verdescuento();
    });
});

function verdescuento(){
    $('#descuento_e').hide();
    $('#descuento_o').show();
    $('#valor_descuento').val("$");
    porcentaje();
    saldo();
}

$(document).ready(function(){
    $("#descuento_o").click(function(){
        verdescuento2();
    });
});

function verdescuento2(){
    $('#descuento_e').show();
    $('#descuento_o').hide();
    $('#valor_descuento').val("%");
    porcentaje();
    saldo();
}


$('#idProducto').change(agregarPrecio);
$('#idMedida').change(agregarCliente);

function agregarCliente(){
    datosMedida = document.getElementById('idMedida').value.split('_');
    $("#nombre").val(datosMedida[1]);
    $('#tipo_documento').val(datosMedida[3]);
    $('#num_documento').val(datosMedida[2]);
    $('#celular').val(datosMedida[4]);        
    $('#email').val(datosMedida[5]);
    $('#tipo_documento').selectpicker('refresh');
}

$('#num_documento').change(limpiarcliente);

function limpiarcliente(){
    $('#tipo_documento').val('DNI');
    $('#celular').val('');        
    $('#email').val('');
    $('#tipo_documento').selectpicker('refresh');
}


$(document).ready(function(){
    $("#agregar").click(function(){
        agregar();
    });
});

var cont=0;
total=0;
subtotal=[];

function agregarPrecio(){
    datosProducto = document.getElementById('idProducto').value.split('_');
    $("#precio_v").val(datosProducto[1]);
}

function agregar(){

    datosProducto = document.getElementById('idProducto').value.split('_');
    id_producto= datosProducto[0];
    producto= datosProducto[3];
    codigo= datosProducto[2];
    stock= datosProducto[4];
    tipoproducto= datosProducto[5];
    datosMedida = document.getElementById('idMedida').value.split('_');
    id_paciente= datosMedida[0];
    paciente= datosMedida[1];
    cantidad= $("#cantidad").val();
    precio_v= $("#precio_v").val();
    producto_vista=$("#idProducto  option:selected").text()
    if(tipoproducto=="CON STOCK")
    {
        if(parseInt(stock) >= parseInt(cantidad))
        {
            if(id_producto !="0" && cantidad!="" && cantidad>0  && precio_v!="" && precio_v>0 && id_paciente !="0")
            {
                subtotal[cont]=(1*cantidad)*(1*precio_v);
                total= total+subtotal[cont];

                var fila= '<tr class="selected" id="fila'+cont+'"> <td><input type="hidden" name="cantidade[]" value="'+cantidad+'">'+cantidad+'</td>  <td><input type="hidden" name="id_productoe[]" value="'+id_producto+'">'+producto_vista+'</td><input type="hidden" name="id_pacientee[]" value="'+id_paciente+'"><td><input type="hidden" name="precioe[]" value="'+parseFloat(precio_v).toFixed(2)+'">'+parseFloat(precio_v).toFixed(2)+' </td><td><input type="hidden" name="precio_venta[]" value="'+parseFloat(subtotal[cont]).toFixed(2)+'"> S/. '+parseFloat(subtotal[cont]).toFixed(2)+'</td><td><button type="button" class="btn btn-danger btn-sm" onclick="eliminar('+cont+');"><i class="fa fa-times fa-1x"></i></button></td></tr>';
                cont++;
                    
                totales();
                limpiar();
                evaluar();
                $('#detalles').append(fila);
            }else{

                //alert("Rellene todos los campos del detalle de la venta");
            
                Swal.fire({
                type: 'error',
                //title: 'Oops...',
                text: 'Rellene todos los campos del detalle de la venta',
                
                })
            
            }
        }else{

        //alert("Rellene todos los campos del detalle de la venta");

        Swal.fire({
        type: 'error',
        //title: 'Oops...',
        text: 'La cantidad excede el stock',

        })

        }
    }else{
        if(id_producto !="0" && cantidad!="" && cantidad>0  && precio_v!="" && precio_v>0 && id_paciente !="0")
            {
                subtotal[cont]=(1*cantidad)*(1*precio_v);
                total= total+subtotal[cont];

                var fila= '<tr class="selected" id="fila'+cont+'"> <td><input type="hidden" name="cantidade[]" value="'+cantidad+'">'+cantidad+'</td>   <td><input type="hidden" name="id_productoe[]" value="'+id_producto+'">'+producto_vista+'</td><input type="hidden" name="id_pacientee[]" value="'+id_paciente+'"><td><input type="hidden" name="precioe[]" value="'+parseFloat(precio_v).toFixed(2)+'">'+parseFloat(precio_v).toFixed(2)+' </td><td><input type="hidden" name="precio_venta[]" value="'+parseFloat(subtotal[cont]).toFixed(2)+'"> S/. '+parseFloat(subtotal[cont]).toFixed(2)+'</td><td><button type="button" class="btn btn-danger btn-sm" onclick="eliminar('+cont+');"><i class="fa fa-times fa-1x"></i></button></td></tr>';
                cont++;
                    
                totales();
                limpiar();
                evaluar();
                $('#detalles').append(fila);
            }else{

                //alert("Rellene todos los campos del detalle de la venta");
            
                Swal.fire({
                type: 'error',
                //title: 'Oops...',
                text: 'Rellene todos los campos del detalle de la venta',
                
                })
            
            }
    }
    
}

function limpiar(){
    $("#cantidad").val("1");
    acuenta= $("#acuenta").val();
    saldo=total - acuenta;
    $("#saldo").val(saldo.toFixed(2));
    $("#tablamedida").hide();
}

function totales()
{
    $("#total_pagar_html").html("S/. " + total.toFixed(2));
    total_pagar=total;
    $("#total_pagar_html").html("S/. " + total_pagar.toFixed(2));
    $("#total_pagar22").val(total_pagar.toFixed(2));
    $("#importepagar").val(total_pagar.toFixed(2));
    $("#total_pagar").val(total_pagar.toFixed(2));
}
function evaluar(){

    if(parseInt(total)>0)
    {
        $("#guardar").show();
        $("#acuenta2").show();
        $("#saldo2").show();
    } 
    else
    {
        $("#guardar").hide();
        $("#acuenta2").hide();
        $("#saldo2").hide();
    }
    var mayor=total_pagar;
    var saldosoles = document.getElementById("acuenta").setAttribute('max',mayor);
}

function eliminar(index){

    total=total-subtotal[index];
    total_pagar_html = total;
    $("#total_pagar_html").html("S/." + total_pagar_html);
    $("#importepagar").val(total_pagar_html.toFixed(2));
    $("#total_pagar22").val(total_pagar_html.toFixed(2));
    $("#total_pagar").val(total_pagar_html.toFixed(2));
    
    $("#fila" + index).remove();
    evaluar();
    acuenta2= $("#acuenta").val();
    saldo2=total-acuenta2;
    $("#saldo").val(saldo2.toFixed(2));
    $("#saldo2").val(saldo2);
    porcentaje();
    saldo();
}

$("#descuento").keyup(porcentaje);

function porcentaje(){
    descuento=0;
    if($('#descuento').val()==""){
        descuento=0;
    }else{
        descuento=$('#descuento').val();
    }
    if($('#valor_descuento').val()=="%"){
        descuento=(descuento*total_pagar)/100;
    }else{
        descuento=descuento;
    }
    acuenta=$("#acuenta").val();
    saldo=total_pagar - descuento-acuenta;
    
    total_pagar2=total_pagar-descuento-acuenta;
    total_pagar3=total_pagar-descuento;
    $("#saldo").val(saldo.toFixed(2));
    $("#importepagar").val(total_pagar3.toFixed(2));
    '<input type="number" name="saldoe" value="'+parseFloat(saldo).toFixed(2)+'">';
    saldo();
}


function saldo(){

    acuenta= $("#acuenta").val();
    saldo=total_pagar2 - acuenta;
    $("#saldo").val(saldo.toFixed(2));
    '<input type="number" name="saldoe" value="'+parseFloat(saldo).toFixed(2)+'">'
    $("#acuenta").val(acuenta.toFixed(2));
    '<input type="number" name="acuentae" value="'+parseFloat(acuenta).toFixed(2)+'">'
    porcentaje();
}


</script>
@endpush

@endsection