@extends('home')
@section('contenido')
<main class="main">
    <div class="card-body">
    <form action="{{route('compra.store')}}" method="POST">
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
                            <option value="0">Seleccione</option>
                            @foreach($proveedor as $prove)
                                <option value="{{$prove->id}}">{{$prove->nombre}}</option>
                            @endforeach
                        </select>
                </div>                                
            </div>
                <h4>Detalle Compra</h4>
                <div class="form-group row">
                    <div class="col-md-1">
                            <label class="form-control-label" for="cantidad">Cantidad</label>
                            <input type="number" id="cantidad" name="cantidad" class="form-control" placeholder="Ingrese cantidad" value="1">
                    </div>                    
                    <div class="col-md-2">  
                        <label class="form-control-label" for="idCategoria">Categoria</label>
                            <select class="form-control selectpicker" name="idCategoria" id="idCategoria" data-live-search="true" required>
                                <option value="0">Seleccione</option>
                            </select>
                    </div>
                    
                    <div class="col-md-3">  
                        <label class="form-control-label" for="nombre">Producto</label>
                            <select class="form-control selectpicker" name="idProducto" id="idProducto" data-live-search="true" required>
                               
                                
                            </select>
                    </div>
                    <div class="col-md-3">
                            <label class="form-control-label" for="impuesto">Precio Compra Unitario</label>
                            <input type="number" id="precio_c" name="precio_c" class="form-control" placeholder="Ingrese precio" step="0.01">
                    </div>
                    <div class="col-md-3">
                            <label class="form-control-label" for="impuesto">Precio Venta Unitario</label>
                            <input type="number" id="precio_v" name="precio_v" class="form-control" placeholder="Ingrese precio" step="0.01">
                    </div>
                    <div class="col-md-4" >
                            <label class="form-control-label" for="impuesto">Especificacion</label>
                            <input type="text" id="especificacion" name="especificacion" class="form-control" placeholder="Ingrese especificacion">
                            @error('especificacion')
                                <span class="error-message" style="color:red">{{ $message }}</span>
                            @enderror
                    </div>
                    <div class="col-md-1">
                        <button type="button" id="agregar" class="btn btn-success" style="margin-top: 28px;: " ><i class="fa fa-plus fa-1x"></i> Agregar Producto</button>
                    </div>
                </div>
            <div class="form-group row">
                <div class="table-responsive col-md-12">
                    <table id="detalles" class="table table-bordered table-striped table-sm">
                        <thead>
                            <tr class="bg-primary">
                                <th>Cantidad</th>
                                <th>Codigo</th>
                                <th>Producto</th>
                                <th>Especificacion</th>
                                <th>Precio Compra Unitario</th>
                                <th>Precio Venta Unitario</th>
                                <th>SubTotal</th>
                                <th>Eliminar</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td  colspan="6"><p align="right">TOTAL PAGAR:</p></td>
                                <td><p align="right"><span align="right" id="total_pagar_html">S/. 0.00</span><input type="hidden" name="total_pagar" id="total_pagar"><input type="hidden" name="saldo2" id="saldo2"></p></th>
                            </tr>  
                        </tfoot>
                    </table>
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
            <div class="form-group row">                                            
                <div class="col-md-3" id="cuota2">
                    <label class="form-control-label" for="impuesto">Cuotas</label>
                    <input type="number"  id="cuotas" name="cuotas" class="form-control" placeholder="Ingrese Cantidad de Cuotas" >
                </div>
            </div>
            <h4>Detalle de Pago</h4>
                <div class="form-group row">
                    <div class="col-md-2">
                        <p>Tipo Pago</p>
                        <input type="radio" id="html" name="fav_language" value="HTML">
                        <label for="html">HTML</label><br>
                        <input type="radio" id="css" name="fav_language" value="CSS">
                        <label for="css">CSS</label><br>
                    </div>
                    <div class="col-md-1">
                        
                    </div>
                                          
                    <div class="col-md-3">  
                        <label class="form-control-label" for="nombre">Medio de Pago</label>
                            <select class="form-control selectpicker" name="idMedios" id="idMedios" data-live-search="true" required>
                            <option value="0" disabled>Seleccione</option>
                                @foreach($medios as $med)
                                    <option value="{{$med->id}}" {{ old('idMedios') == $med->id ? 'selected' : '' }}>{{$med->nombre}} {{$med->banco}}</option>
                                @endforeach
                            </select>
                        @error('idMedios')
                            <span class="error-message" style="color:red">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-3">  
                        <label class="form-control-label" for="dni">Tipo de Comprobante</label>
                        <select class="form-control selectpicker" name="comprobante" id="comprobante" data-live-search="true" >
                            <option value="RECIBO" {{ old('tipo_documento') == "RECIBO" ? 'selected' : '' }}>RECIBO</option>
                            <option value="BOLETA" {{ old('tipo_documento') == "BOLETA" ? 'selected' : '' }}>BOLETA</option>
                            <option value="FACTURA" {{ old('tipo_documento') == "FACTURA" ? 'selected' : '' }}>FACTURA</option>
                            <option value="OTROS" {{ old('tipo_documento') == "OTROS" ? 'selected' : '' }}>OTROS</option>        
                        </select>
                        @error('comprobante')
                            <span class="error-message" style="color:red">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="col-md-3">  
                        <label class="form-control-label" for="impuesto">Numero de Comprobante</label>
                        <input type="text" id="numero" name="numero" class="form-control" placeholder="Ingrese comprobante">
                        @error('numero')
                            <span class="error-message" style="color:red">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">                    
                    <div class="col-md-1">  
                        
                    </div>
                    <div class="col-md-2">  
                        <label class="form-control-label" for="cuotas">Cuotas</label>
                        <input type="number" id="cuotas" name="cuotas" class="form-control" placeholder="Ingrese cuotas" value="1">
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
                            <label class="form-control-label" for="proxfecha">Proxima Fecha de Pago</label>
                            <input type="date" id="proxfecha" name="proxfecha" class="form-control" placeholder="Ingrese proxima fecha de pago">                            
                    </div>                    
                </div>
                <div class="form-group row">                    
                    <div class="col-md-3" id="guardar">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <button type="submit" class="btn btn-success" style="margin-top: 28px; "><i class="fa fa-save fa-1x"></i> Registrar Ingreso</button>

                    </div>
                </div>
                

                
            
            
            


        </form>
        <!--Inicio del modal actualizar-->
        <div class="modal fade" id="abrirmodalEditar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Agregar Paciente</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{route('paciente.store')}}" method="post" class="form-horizontal" enctype="multipart/form-data" autocomplete="off" >
                                {{csrf_field()}}
                                @include('paciente.form')
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

$('#cuota2').hide();
$('#idCategoria').change(agregarProductos);

function agregarProductos(){
    $('#idProducto').empty();
    $('#idProducto').append("<option value='0' >Seleccione</option>");
    <?php foreach ($productos as $pro): ?>    
        if('{{$pro->idCategoria}}'==$("#idCategoria option:selected").val()){
            $('#idProducto').append("<option value='{{$pro->id}}_{{$pro->nombre}}_{{$pro->precio}}_{{$pro->codigo}}' >{{$pro->nombre}}</option>");
        }
        <?php endforeach ?> 
    $('#idProducto').selectpicker('refresh');  
}

$(document).ready(function(){
    $("#agregar").click(function(){
        agregar();
    });
});

var cont=0;
total=0;
subtotal=[];


function agregar(){

    datosProducto = document.getElementById('idProducto').value.split('_');
    id_producto= datosProducto[0];
    producto= datosProducto[1];
    codigo= datosProducto[3];
    cantidad= $("#cantidad").val();
    precio_v= $("#precio_v").val();
    precio_c= $("#precio_c").val();
    especificacion= $("#especificacion").val();
    if(id_producto !="" && cantidad!="" && cantidad>0  && precio_v!="" && precio_v>0 && precio_c!="" && precio_c>0)
    {
        subtotal[cont]=(1*cantidad)*(1*precio_c);
        total= total+subtotal[cont];

        var fila= '<tr class="selected" id="fila'+cont+'"> <td><input type="hidden" name="cantidade[]" value="'+cantidad+'">'+cantidad+'</td> <td>'+codigo+'</td>  <td><input type="hidden" name="id_productoe[]" value="'+id_producto+'">'+producto+'</td><td><input type="hidden" name="especificacione[]" value="'+especificacion+'">'+especificacion+'</td><td><input type="hidden" name="precioc[]" value="'+parseFloat(precio_c).toFixed(2)+'">'+parseFloat(precio_c).toFixed(2)+' </td><td><input type="hidden" name="precioe[]" value="'+parseFloat(precio_v).toFixed(2)+'">'+parseFloat(precio_v).toFixed(2)+' </td><td><input type="hidden" name="precio_compra[]" value="'+parseFloat(subtotal[cont]).toFixed(2)+'"> S/. '+parseFloat(subtotal[cont]).toFixed(2)+'</td><td><button type="button" class="btn btn-danger btn-sm" onclick="eliminar('+cont+');"><i class="fa fa-times fa-1x"></i></button></td></tr>';
        cont++;
            
        totales();
        limpiar();
        evaluar();
        $('#detalles').append(fila);
    }else{

        //alert("Rellene todos los campos del detalle de la compra");
    
        Swal.fire({
        type: 'error',
        //title: 'Oops...',
        text: 'Rellene todos los campos del detalle de la compra',
        
        })
    
    }
    
}

function limpiar(){
    $("#cantidad").val("1");
    acuenta= $("#acuenta").val();
    saldo=total - acuenta;
    $("#saldo").val(saldo.toFixed(2));
}

function totales()
{
    $("#total_pagar_html").html("S/. " + total.toFixed(2));
    total_pagar=total;
    $("#total_pagar_html").html("S/. " + total_pagar.toFixed(2));
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
    $("#total_pagar").val(total_pagar_html.toFixed(2));
    
    $("#fila" + index).remove();
    evaluar();
    acuenta2= $("#acuenta").val();
    saldo2=total-acuenta2;
    $("#saldo").val(saldo2.toFixed(2));
    $("#saldo2").val(saldo2);
}

$("#acuenta").keyup(saldo);

function saldo(){

    acuenta= $("#acuenta").val();
    saldo=total_pagar - acuenta;
    $("#saldo").val(saldo.toFixed(2));
    '<input type="number" name="saldoe" value="'+parseFloat(saldo).toFixed(2)+'">';
    '<input type="number" name="acuentae" value="'+parseFloat(acuenta).toFixed(2)+'">';
    
    if(parseInt(saldo)>0){
        $('#cuota2').show();
    }else{
        $('#cuota2').hide();
    }
}

window.axios.get('/categoriarealtime')
    .then((response)=>{
        const CategoriaElement = document.getElementById('idCategoria');
        

        let categorias=response.data;
        categorias.forEach((categoria,index)=>{
            let element = document.createElement('option');

            element.innerText=categoria.nombre;
            element.setAttribute('value',categoria.id);
            
            CategoriaElement.appendChild(element);
        });

        $('#idCategoria').selectpicker('refresh');
});

window.Echo.channel('categoriacreate')
.listen('CategoriaCreate',(e)=>{

    const CategoriaElement = document.getElementById('idCategoria');

    
    let element = document.createElement('option');

    element.innerText=e.categoria.nombre;
    element.setAttribute('value',e.categoria.id);
    
    CategoriaElement.appendChild(element);
    $('#idCategoria').selectpicker('refresh');
});

$('#idCategoria').change(agregarProducto);

function agregarProducto()
{
    window.axios.get('/productosinve')
    .then((response)=>{
        const ProductoElement = document.getElementById('idProducto');
        let productos=response.data;
        $('#idProducto').empty();
        let elemento = document.createElement('option');
        elemento.innerText="Seleccione";
        elemento.setAttribute('value',0);
        ProductoElement.appendChild(elemento);

        productos.forEach((producto,index)=>{

            if($("#idCategoria option:selected").val()==producto.idCategoria){
                let element = document.createElement('option');

                element.innerText=producto.nombre;
                element.setAttribute('value',''+producto.id+'_'+producto.nombre+'_'+producto.precio+'_'+producto.codigo+'');
                
                ProductoElement.appendChild(element);
            }
            
        });

        $('#idProducto').selectpicker('refresh');
    });
}



window.Echo.channel('productocreate')
.listen('ProductoCreate',(e)=>{

    const ProductoElement = document.getElementById('idProducto');

    if($("#idCategoria option:selected").val()==e.producto.idCategoria){
        let element = document.createElement('option');

        element.innerText=e.producto.nombre;
        element.setAttribute('value',''+e.producto.id+'_'+e.producto.nombre+'_'+e.producto.precio+'_'+e.producto.codigo+'');
        
        ProductoElement.appendChild(element);

        $('#idProducto').selectpicker('refresh');
    }
});


</script>
@endpush

@endsection