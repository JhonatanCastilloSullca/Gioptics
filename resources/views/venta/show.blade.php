@extends('home')
@section('contenido')
<main class="main">
  @foreach($ventas as $venta)
  <div class="card-body">
    <h2 class="text-center">Detalle de Venta </h2><br/><br/><br/>
      <div class="col-md-12">
          <div class="form-group row">
            <div class="col-md-2">
                    <label class="form-control-label" for="num_venta"><b>Fecha de Venta</b></label>
                    
                    <p>{{date("d/m/Y", strtotime($venta->fecha))}}</p>
            </div>
            <div class="col-md-2">  

                <label class="form-control-label" for="nombre"><b>Cliente</b></label>
                
                <p>{{$venta->cliente}}</p>
                    
            </div>

            <div class="col-md-2">  

            <label class="form-control-label" for="documento"><b>Tipo de Pago</b></label>

            <p>{{$venta->medio}} {{$venta->banco}}</p>
            
            </div>

            <div class="col-md-2">
                    <label class="form-control-label" for="num_venta"><b>Vendedor</b></label>
                    
                    <p>{{$venta->vendedor}}</p>
            </div>
            <div class="col-md-2">
                    <label class="form-control-label" for="num_venta"><b>TIENDA</b></label>
                    
                    <p>{{$venta->sucursal}}</p>
            </div>
                  
          </div>
          <div class="form-group row">
            <div class="col-md-12">
                    <label class="form-control-label" for="num_venta"><b>Observaciones: </b></label>
                    
                    <p>{{$venta->observacion}}</p>
            </div>
          </div>
        </div>
          <br/><br/>

          <div class="form-group">

            <div class="table-responsive col-md-12">
              <table id="detalles" class="table table-bordered table-striped table-sm">
              <thead>
                  <tr class="bg-success">

                      <th>Cantidad</th>
                      <th>Codigo</th>
                      <th>Producto</th>
                      <th>Paciente</th>
                      <th>Precio Unitario</th>
                      <th>Subtotal</th>
                  </tr>
              </thead>
              <tbody>
                @foreach($detalles as $det)
                  <tr>
                    <td>{{$det->cantidad}}</td>
                    <td>{{$det->codigo}}</td>
                    <td>{{$det->producto}}</td>
                    <td>{{$det->paciente}}</td>
                    <td align="right">{{number_format($det->precio,2)}}</td>
                    <td align="right">{{number_format($det->precio*$det->cantidad,2)}}</td>
                  </tr>
                @endforeach
              </tbody>
              <tfoot>
                <tr>
                      <td  colspan="5"><p align="right">descuento:</p></td>
                      <td><p align="right">S/ {{number_format($venta->descuento,2)}}</p></td>
                  </tr>
                <tr>
                      <td  colspan="5"><p align="right">A CUENTA:</p></td>
                      <td><p align="right">S/ {{number_format($venta->acuenta,2)}}</p></td>
                  </tr>

                  <tr>
                      <td colspan="5"><p align="right">SALDO:</p></td>
                      <td><p align="right">S/ {{number_format($venta->saldo,2)}}</p></td>
                  </tr>

                  <tr>
                      <td  colspan="5"><p align="right">TOTAL:</p></td>
                      <td><p align="right">S/ {{number_format($venta->total,2)}}</p></td>
                  </tr>  
                   
              </tfoot>
              
              </table>
            </div>
            @if(count($saldo)>0)
              <div class="col-md-12">
                <div class="table-responsive" >
                  <h4> Pagos </h4>
                    <table id="reservas" class="table table-sm">
                        <tbody>
                            @foreach ($saldo as $sal)
                              <tr >
                                  <td style="border-top: 0px"><b>Fecha:</b> {{date("d/m/Y", strtotime($sal->fecha))}} </td>
                                  <td style="border-top: 0px"><b>Medio de Pago:</b> {{$sal->medio}} {{$sal->banco}}</td>
                                  <td style="border-top: 0px"><b>Usuario: </b> {{$sal->usuario}}</td>
                                  <td style="border-top: 0px"><b>S/</b>  {{$sal->monto}}</td>
                              </tr>
                                
                            @endforeach
                        </tbody>
                    </table>
                </div>
              </div>
            @endif
            <div class="col-md-12">
              <a href="{{URL::previous()}}">
                  <button type="reset" class="btn btn-danger btn-sm" >VOLVER ATRAS
                  </button>
              
              </a> 
            </div>
          </div>


  </div><!--fin del div card body-->
  @endforeach
</main>

@endsection