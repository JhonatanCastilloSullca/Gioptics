@extends('home')
@section('contenido')
<main class="main">
  @foreach($compras as $compra)
  <div class="card-body">

  <h2 class="text-center">Detalle de Compra </h2><br/><br/><br/>

            <div class="col-md-12">
                <div class="form-group row">
                
                    <div class="col-md-4">
                            <label class="form-control-label" for="num_venta"><b>Fecha de compra</b></label>
                            
                            <p>{{date("d/m/Y", strtotime($compra->fecha))}}</p>
                    </div>

                    <div class="col-md-4">
                            <label class="form-control-label" for="num_venta"><b>comprador</b></label>
                            
                            <p>{{$compra->vendedor->nombre}} {{$compra->vendedor->apellido}}</p>
                    </div>
                 </div>   
            </div>

           <div class="form-group">
           @php $colspans=0 @endphp
                @foreach($compra->categorias as $categoria)
                <div>
                <div class="col-md-12" style="overflow-y:auto;margin-bottom: 40px;" id="{{$categoria->id}}">
                    <h4>{{$categoria->nombre}}</h4>
                    <table class="table table-bordered table-striped table-sm"style="min-width: max-content;">
                        <thead>
                            <tr class="bg-primary"  style="white-space: nowrap;" >
                                <th>Cantidad</th>
                                <th>Unidad</th>
                                <th style="width:200px">Codigo</th>
                                <th>Producto</th>
                                
                                
                                @foreach($categoria->adicionales as $adi)                                    
                                    <th style="justify-content: space-between;">{{$adi->nombre}}</th>
                                @endforeach
                                <th>Precio Compra</th>
                                <th>Precio Venta</th>
                                <th>Sucursal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($compra->detallecompras as $detalle)
                                @foreach($detalle->productos as $producto)
                                @if($producto->categoria_id==$categoria->id)
                                <tr  style="white-space: nowrap;" >
                                    <td>
                                        {{$detalle->cantidad}}
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
                                </tr>
                                <tr>
                                    
                                    @php $colspans=$colspan+count($producto->categoria->adicionales) @endphp
                                    <td style="text-align:right !important" colspan="{{$colspans}}" >
                                        SUB TOTAL
                                    </td>
                                    <td >
                                        {{number_format($producto->precio_compra*$producto->stock,2)}}
                                    </td>
                                </tr>
                                @endif
                                @endforeach
                            @endforeach
                            
                        </tbody>
                    </table>
                    <div class="form-group row">
                        <div class="col-md-4">
                            <label class="form-control-label" for="impuesto">Total Pedido:&nbsp;&nbsp; {{ number_format($compra->total ,2) }}</label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-4" >
                            <label class="form-control-label" for="impuesto"> abonado:&nbsp;&nbsp; {{ number_format($compra->acuenta ,2) }}</label>
                        </div> 
                    </div>  
                    <div class="form-group row">
                        <div class="col-md-4" >
                            <label class="form-control-label" for="impuesto">Saldo:&nbsp;&nbsp; {{ number_format($compra->saldo ,2) }}</label>
                        </div>                                           
                        
                    </div>
                    <div id="acuenta2">
                        <label class="form-control-label" for="impuesto">Descripcion: {{$compra->descripcion}}</label>
                    </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group row">
                        <div class="col-md-12">                                 <span> Pagos </span>
                        @if($compra->saldo==0)
                        @else
                        &nbsp;&nbsp;<a data-toggle="modal" data-id_usuario="'$compra->id'"  data-target="#pagarSaldo"> 
                                                <button type="button" class="btn btn-danger btn-sm pago">
                                                    <i class="fa fa-money fa-1x"></i>
                                                </button>
                                            </a>
                        @endif
                        </div>
                    </div>
                
                    <div class="form-group row">
                        <div class="col-md-12">  
                        <table class="table table-bordered table-striped table-sm"style="min-width: max-content;">
                        <thead>
                            <tr class="bg-primary"  style="white-space: nowrap;" >
                                <th>Fecha</th>
                                <th>Monto</th>
                                <th>Medio Pago</th>
                                <th style="width:200px">Estado</th>
                                <th><i class="fa fa-money fa-1x"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{date("d/m/Y", strtotime($compra->fecha))}}</td>
                                <td> {{ number_format($compra->acuenta ,2) }}</td>
                                <td> {{ $compra->medio->banco}}</td>
                                <td>PAGADO</td>
                                <td> </i></td>
                            </tr>
                            @if(count($saldoc)>0)
                                @foreach ($saldoc as $sal)
                                    @if($sal->estado=="Pagado")
                                        <tr >
                                            <td>{{date("d/m/Y", strtotime($sal->fecha))}} </td>
                                            <td >S/ {{$sal->monto}}</td>
                                            <td ></b>{{$sal->banco}}</td>
                                            
                                            <td style="border-top: 0px"> {{$sal->estado}}</td>
                                            <td></td>
                                        </tr>
                                    @else
                                    <tr >
                                            <td style="border-top: 0px"> <input type="hidden" id="id_saldoc" name="id_saldoc" class="id_saldoc" value="{{$sal->id}}"></td>
                                            <td style="border-top: 0px"></td>
                                            <td style="border-top: 0px">S/ {{$compra->saldo/count($saldoc)}} </td>
                                            <td style="border-top: 0px">{{$sal->estado}}</td>
                                            <td style="border-top: 0px">
                                            <a class="edit" data-toggle="modal" data-id_usuario="'$compra->id'"  data-target="#pagarSaldo"> 
                                                <button type="button" class="btn btn-danger btn-sm pago">
                                                    <i class="fa fa-money fa-1x"></i>
                                                </button>
                                            </a>
                                            </td>
                                        </tr>
                                    @endif
                                    
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                        </tbody>
                    </table>
                        </div>
                    </div>
                 </div>
                @endforeach
                <div class="col-md-12">
                    <a href="{{URL::previous()}}">
                        <button type="reset" class="btn btn-danger btn-sm" >VOLVER ATRAS
                        </button>
                    </a> 
                </div>
            </div>


    </div><!--fin del div card body-->

    
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
                    
                    
                    <form action="{{route('saldoc.store')}}" method="post"  class="form-horizontal">
                        {{csrf_field()}}
                        @include('saldoc.form')
                        <input type="hidden" id="id_compra_r" name="id_compra_r" value="}">
                        <input type="hidden" id="id_compra" name="id_compra" value="{{$compra->id}}">
                        <div class="modal-footer"> 
                        <button type="submit" class="btn btn-success" style="border-radius:0.7em;"><i class="fa fa-save fa-1x"></i> Pagar</button>
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
    @endforeach
  </main>
@push('scripts')
<script>
$(document).on('click', '.pago', function()
{
    var _this = $(this).parents('tr');
    var id=_this.find('.id_saldoc').val();
    $('#id_compra_r').val(id);
    
});

</script>
@endpush
@endsection