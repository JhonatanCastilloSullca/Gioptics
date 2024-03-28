
@extends('home')
@section('contenido')
<main class="main">
            
            <div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
                <div class="card">
                    <div class="card-header">

                        <h2>Listado de Compras</h2><br/>
                        
                        <a href="compra/create">
                            <button class="btn btn-success btn-lg" type="button" style="border-radius: 0.5em;">
                                <i class="fa fa-plus fa-1x"></i>&nbsp;&nbsp;Agregar Compra
                            </button>
                        </a>
                        
                    </div>
                    <div class="card-body" >
                        <div class="table-responsive" >
                            <table id="compras" class="table table-bordered table-striped table-sm">
                                <thead>
                                    <tr class="bg-success">
                                        <th>Ver</th>
                                        <th>Proveedor</th>
                                        <th>Medio de Pago</th>
                                        <th>Usuario</th>
                                        <th>Sucursal</th>
                                        <th>Fecha</th>
                                        <th>Comprobante</th>
                                        <th>Acuenta</th>
                                        <th>Saldo</th>
                                        <th>Total</th>
                                        <th>Estado</th>
                                        <th></th>
                                        
                                    </tr>
                                </thead>
                            <tbody>

                                @foreach($compras as $compra)
                                <tr>
                                    <td>
                                        <a href="{{URL::action('App\Http\Controllers\CompraController@show',$compra->id)}}" > 
                                            <button type="button" class="btn btn-danger btn-md">
                                            <i class="fa fa-eye fa-1x"></i>
                                            </button>
                                        </a>
                                        <input type="hidden" name="id_enviar" id="id_enviar" class="id_enviar" value="{{$compra->id}}">
                                    </td>
                                    

                                    <td>{{$compra->nombreprove}}</td>
                                    <td>{{$compra->medio}}</td>
                                    <td>{{$compra->usuario}}</td>
                                    <td>{{$compra->sucursal}}</td>   
                                    <td>{{date("d/m/Y", strtotime($compra->fecha))}}</td>
                                    <td>{{$compra->comprobante}}</td>
                                    <td>{{number_format($compra->acuenta,2)}}</td>
                                    <td>{{number_format($compra->saldo,2)}}</td>       
                                    <td>{{number_format($compra->total,2)}}</td>                                        
                                    <td>{{$compra->estado}}</td>
                                    <td>
                                        @if(Auth::user()->rol=="Administrador")
                                            <a class="edit" data-toggle="modal" data-id_usuario="'$user->id'"  data-target="#anularCompra"> 
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
            <div class="modal fade" id="anularCompra" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-danger modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Anular Compra</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                    
                        <div class="modal-body">
                            
                            
                            <form action="{{route('compra.destroy','test')}}" method="post"  class="form-horizontal">

                                {{method_field('delete')}}
                                {{csrf_field()}}
                                <input type="hidden" id="id_compra" name="id_compra" value="">
                                <p>¿Estas Seguro que ya desea Anular la Compra?</p>
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
    $('#compras').DataTable({
        "lengthMenu":[[10,25,50,-1],[10,25,50,"Todos"]]
    });
} );
    
$(document).on('click', '.edit', function()
{
    var _this = $(this).parents('tr');
    var id=_this.find('.id_enviar').val();
    $('#id_compra').val(id);
    


    
});

</script>




@endpush

@endsection