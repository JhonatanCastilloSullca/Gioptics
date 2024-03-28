
@extends('home')
@section('contenido')
<main class="main">
    <div class="container-fluid"  id="seccionRecargar">
        <!-- Ejemplo de tabla Listado -->
        <div class="card">
            <div class="card-header">

            <h2><i class="fa fa-list  fa-1x"></i>&nbsp;&nbsp;REGISTRO DE INGRESO</h2><br/>
            </div>
            <div class="card-body" >
                <div style="overflow-y:auto;margin-bottom: 40px;" >
                    <table id="ventas" class="table table-bordered table-striped table-sm">
                        <thead>
                            <tr style="white-space: nowrap;" class="bg-success">
                                <th>Fecha</th>
                                <th>Proveedor</th>
                                <th>Productos</th>
                                <th>Total</th>
                                <th>Acuenta</th>
                                <th>Saldo</th>
                                <th>Proxima Fecha de Pago</th>
                                <th>Monto</th>
                                <th>Estado</th>
                                <th>Ver</th>
                                
                            </tr>
                        </thead>
                    <tbody>
                        
                        @foreach($compras as $compra)
                        <tr>
                            <td>{{date("d/m/Y", strtotime($compra->fecha))}}</td>
                            <td>@php $cont=1 @endphp
                                @foreach($compra->detallecompras as $detalle)
                                    
                                    @foreach($detalle->productos as $producto)
                                        @if($cont==1)
                                            {{$producto->proveedor->nombre}}
                                            @php $cont++ @endphp
                                        @endif
                                    @endforeach
                                @endforeach
                            </td>
                            <td>@php $cont=1 @endphp
                                @foreach($compra->categorias as $categoria)
                                    {{$categoria->nombre}} &nbsp;&nbsp;
                                @endforeach
                            </td>
                            <td>{{number_format($compra->total,2)}}</td>
                            <td>{{number_format($compra->acuenta,2)}}</td>
                            <td >{{number_format($compra->saldo,2)}}</td>
                            @if(count($saldocs)>0)
                                @foreach($saldocs as $sal)
                                    @if($compra->id == $sal->idCompra)
                                        <td>{{date("d/m/Y", strtotime($sal->fecha))}}</td>
                                        <td class="monto">{{number_format($sal->monto,2)}}</td>
                                        <td>{{$compra->estado}}</td>
                                        <td>
                                            <a href="{{URL::action('App\Http\Controllers\CompraController@show',$compra->id)}}" > 
                                                <button type="button" class="btn btn-danger btn-md">
                                                <i class="fa fa-eye fa-1x"></i>
                                                </button>
                                            </a>
                                        </td>
                                    @else
                                        <td></td>
                                        <td class="monto"></td>
                                        <td>{{$compra->estado}}</td>
                                        <td>
                                            <a href="{{URL::action('App\Http\Controllers\CompraController@show',$compra->id)}}" > 
                                                <button type="button" class="btn btn-danger btn-md">
                                                <i class="fa fa-eye fa-1x"></i>
                                                </button>
                                            </a>
                                            
                                        </td>
                                    @endif
                                @endforeach
                            @else
                                <td></td>
                                <td></td>
                                <td>{{$compra->estado}}</td>
                                <td>
                                    <a href="{{URL::action('App\Http\Controllers\CompraController@show',$compra->id)}}" > 
                                        <button type="button" class="btn btn-danger btn-md">
                                        <i class="fa fa-eye fa-1x"></i>
                                        </button>
                                    </a>
                                    <input type="hidden" name="id_enviar" id="id_enviar" class="id_enviar" >
                                </td>
                            @endif
                        </tr>

                        @endforeach
                    
                    </tbody>
                </table>
                
                </div>
                
                
            </div>
        </div>
        <!-- Fin ejemplo de tabla Listado -->
    </div>



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
    $('#id_compra').val(id);
    $('#saldo').val(_this.find('.monto').text());
    
});

</script>
@endpush

@endsection
