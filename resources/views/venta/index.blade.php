
@extends('home')
@section('contenido')
<main class="main">
            <div class="container-fluid"  id="seccionRecargar">
                <!-- Ejemplo de tabla Listado -->
                <div class="card">
                    <div class="card-header">

                    <h2><i class="fa fa-shopping-cart fa-1x"></i>&nbsp;&nbsp;Listado de Ventas</h2><br/>
                        
                        <a href="venta/create">
                            <button class="btn btn-success btn-lg" type="button" style="border-radius: 0.5em;">
                                <i class="fa fa-plus fa-1x"></i>&nbsp;&nbsp;Agregar Venta
                            </button>
                        </a>
                        
                    </div>
                    <div class="card-body" >
                        <div class="col-md-12" style="overflow-y:auto;margin-bottom: 40px;">
                            <table id="ventas" class="table table-bordered table-striped table-sm">
                                <thead>
                                    <tr class="bg-success">
                                        <th>Ver</th>
                                        <th>Fecha</th>
                                        <th>Cliente</th>
                                        <th>Vendedor</th>
                                        <th>Medio de Pago</th>
                                        <th>Sucursal</th>
                                        <th>Acuenta</th>
                                        <th>Saldo</th>
                                        <th>Total</th>
                                        <th>Descuento</th>
                                        <th>Estado</th>
                                        <th></th>
                                        <th></th>
                                        
                                    </tr>
                                </thead>
                            <tbody>

                                @foreach($ventas as $vent)
                                <tr>
                                    <td>
                                        <a href="{{URL::action('App\Http\Controllers\VentaController@show',$vent->id)}}" > 
                                            <button type="button" class="btn btn-danger btn-md">
                                            <i class="fa fa-eye fa-1x"></i>
                                            </button>
                                        </a>
                                        <input type="hidden" name="id_enviar" id="id_enviar" class="id_enviar" value="{{$vent->id}}">
                                    </td>

                                    <td>{{date("d/m/Y", strtotime($vent->fecha))}}</td>
                                    <td>{{$vent->cliente}}</td>
                                    <td>{{$vent->vendedor}}</td>
                                    <td>{{$vent->medio}} {{$vent->banco}}</td>
                                    <td>{{$vent->sucursal}}</td>
                                    <td>{{number_format($vent->acuenta,2)}}</td>
                                    <td>{{number_format($vent->saldo,2)}}</td>
                                    <td>{{number_format($vent->total,2)}}</td>
                                    <td>{{number_format($vent->descuento,2)}}</td>
                                    <td>{{$vent->estado}}</td>
                                    <td>
                                        @if(Auth::user()->rol=="Gerencia")
                                            <a class="edit"     data-toggle="modal" data-id_usuario="'$user->id'"  data-target="#anularVenta"> 
                                                <button type="button" class="btn btn-danger btn-sm">
                                                    <i class="fa fa-times fa-1x"></i>
                                                </button>
                                            </a>
                                        @else
                                            <button type="button" class="btn btn-danger btn-sm">
                                                <i class="fa fa-times fa-1x"></i>
                                            </button>
                                        @endif
                                    </td>
                                    <td></td>
                                    
                                </tr>

                                @endforeach
                            
                            </tbody>
                        </table>
                        
                        </div>
                        
                        
                    </div>
                </div>
                <!-- Fin ejemplo de tabla Listado -->
            </div>


            <!--Inicio del modal cambiar Estado-->
            <div class="modal fade" id="anularVenta" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-danger modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Anular Venta</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                    
                        <div class="modal-body">
                            
                            
                            <form action="{{route('venta.destroy','test')}}" method="post"  class="form-horizontal">

                                {{method_field('delete')}}
                                {{csrf_field()}}
                                <input type="hidden" id="id_venta" name="id_venta" value="">
                                <p>¿Estas Seguro que ya desea Anular la Venta?</p>
                                <div class="modal-footer"> 
                                <button type="submit" class="btn btn-success" style="border-radius:0.7em;"><i class="fa fa-save fa-1x"></i> Guardar</button>
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
    
});



</script>
@endpush

@endsection
