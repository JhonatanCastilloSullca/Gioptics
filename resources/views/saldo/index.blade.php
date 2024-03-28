
@extends('home')
@section('contenido')
<main class="main">
    <div class="container-fluid"  id="seccionRecargar">
        <!-- Ejemplo de tabla Listado -->
        <div class="card">
            <div class="card-header">

            <h2><i class="fa fa-spinner"></i>&nbsp;&nbsp;PEDIDOS por ENTREGAR</h2><br/>
            </div>
            <div class="card-body" >
                <div class="col-md-12" style="overflow-y:auto;margin-bottom: 40px;">
                    <table id="ventas" class="table table-bordered table-striped table-sm">
                        <thead>
                            <tr class="bg-success">
                                <th>Fecha</th>
                                <th>Cliente</th>
                                <th>Vendedor</th>
                                <th>Medio de Pago</th>
                                <th>Total</th>
                                <th>Descuento</th>
                                <th>A cuenta</th>
                                <th>Saldo</th>
                                <th>Estado</th>
                                <th>Ver</th>
                                <th>Pagar</th>
                                <th>Notificar</th>
                                <th><i class="fa fa-download"></i></th>
                            </tr>
                        </thead>
                    <tbody>

                        @foreach($ventas as $vent)
                        <tr>
                            
                            <td>{{date("d/m/Y", strtotime($vent->fecha))}}</td>
                            <td>{{$vent->cliente}}</td>
                            <td>{{$vent->vendedor}}</td>
                            <td>{{$vent->medio}} {{$vent->banco}}</td>
                            <td>{{number_format($vent->total,2)}}</td>
                            <td>{{number_format($vent->descuento,2)}}</td>
                            <td>{{number_format($vent->acuenta,2)}}</td>
                            <td class="saldo">{{number_format($vent->saldo,2)}}</td>
                            <td>
                                @if($vent->estado=="Listo")
                                    <a class="edit3">
                                        <input  type="checkbox" checked data-toggle="toggle" data-on="Listo" data-off="Proceso" data-onstyle="success" data-offstyle="danger">
                                    </a>
                                @else
                                    <a class="edit3">
                                        <input  type="checkbox"  data-toggle="toggle" data-on="Listo" data-off="Proceso" data-onstyle="success" data-offstyle="danger">
                                    </a>
                                @endif
                            </td>
                            <td>
                                <a href="{{URL::action('App\Http\Controllers\VentaController@show',$vent->id)}}" > 
                                    <button type="button" class="btn btn-danger btn-sm">
                                    <i class="fa fa-eye fa-1x"></i>
                                    </button>
                                </a>
                                <input type="hidden" name="id_enviar" id="id_enviar" class="id_enviar" value="{{$vent->id}}">
                                
                            </td>
                            <td>
                                <a class="edit" data-toggle="modal" data-id_usuario="'$user->id'"  data-target="#pagarSaldo"> 
                                    <button type="button" class="btn btn-info btn-sm">
                                        <i class="fa fa-money fa-1x"></i>
                                    </button>
                                </a>
                            </td>
                            <td>
                                <a class="edit2" data-toggle="modal" data-id_usuario="'$user->id'" > 
                                    <button type="button" class="btn btn-success btn-sm">
                                        <i class="fa fa-whatsapp fa-1x"></i>
                                    </button>
                                </a>



                            </td>
                            <td>
                                <a href="{{url('ventapdf',$vent->id)}}" target="_blank">
                            <button type="button" class="btn btn-danger " style='text-align:right;border-radius: 0.7em;'>
                                <i class="fa fa-file"></i>
                            </button>

                        </a>



                            </td>
                        </tr>

                        @endforeach
                    
                    </tbody>
                </table>
                
                </div>
                
                <form id="delete-form" action="{{route('venta.destroy','test')}}" method="POST" autocomplete="off">
                
                    {{method_field('delete')}}
                    {{csrf_field()}} 
                    <input type="hidden" id="id_venta2" name="id_venta2" value="">
                    <input type="hidden" id="id_estado" name="id_estado" value="1">
                </form>

            </div>
        </div>
        <!-- Fin ejemplo de tabla Listado -->
    </div>


    <!--Inicio del modal cambiar Estado-->
    <div class="modal fade" id="pagarSaldo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-danger modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Pagar Saldo</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
            
                <div class="modal-body">
                    
                    
                    <form action="{{route('saldo.store')}}" method="post"  class="form-horizontal">
                        {{csrf_field()}}
                        @include('saldo.form')
                        <input type="hidden" id="id_venta" name="id_venta" value="">
                        <div class="modal-footer"> 
                        <button type="submit" class="btn btn-success" style="border-radius:0.7em;"><i class="fa fa-save fa-1x"></i> Entregar</button>
                        <button type="button" class="btn btn-danger" style="border-radius:0.7em;" data-dismiss="modal"><i class="fa fa-times fa-1x"></i> Cerrar</button>
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
<script>

$(document).ready(function() {
    $('#ventas').DataTable({
        "lengthMenu":[[10,25,50,-1],[10,25,50,"Todos"]]
    });
} );
    
$(document).on('click', '.edit', function()
{
    var _this = $(this).parents('tr');
    var id=_this.find('.id_enviar').val();
    $('#id_venta').val(id);
    $('#saldo').val(_this.find('.saldo').text());
    
});

$(document).on('click', '.edit3', function()
    {
        var _this = $(this).parents('tr');
        $('#id_venta2').val(_this.find('.id_enviar').val());
        event.preventDefault();
        document.getElementById('delete-form').submit();
    });


$(document).on('click', '.edit2', function()
    {
        var _this = $(this).parents('tr');
        var id=_this.find('.id_enviar').val();
        cadena="";
        <?php foreach ($detalles  as $det): ?>
            if('{{$det->idVenta}}'==id){
                cadena=""+cadena+""+'{{$det->categoria}}'+" ";
                
            }
        <?php endforeach ?> 
        <?php foreach ($ventas  as $vet): ?>
            if('{{$vet->id}}'==id){
                let url =`https://api.whatsapp.com/send?phone=51{{$vet->celular}}&text=%0A *HOLA {{$vet->cliente}}*%0A%0Atu pedido de `+cadena+`está listo! Ya puedes acercarte a nuestra tienda de {{$vet->direccion}} para recogerlo. Puedes hacernos todas tus consultas a través chat o llámanos directamente y te atenderemos de inmediato. ¡Te esperamos!`;
                window.open(url);
            }
        <?php endforeach ?> 
        
    });    
</script>



@endpush

@endsection
