
@extends('home')
@section('contenido')
<main class="main">
            <!-- Breadcrumb -->
          
            <div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
                <div class="card">
                    <div class="card-header" style="padding-bottom: 20px;">                       
                       <h2 style="margin-top: 10px;"><i class="fa fa-usd fa-1x"></i>&nbsp;&nbsp;Balance de Caja Diario</h2>
                       <div class="tile_stats_count" style="float: right;margin-top: -20px;">
                            <span class="count_top"><i class="fa fa-usd"></i> Balance de Caja </span>
                            <div class="count">{{number_format($ingresos-$egresos,2)}}</div>
                            <span class="count_bottom"> Del dia</span>
                        </div> <br/>     
                        <div style="margin-top: 10px;">                 
                            <button class="btn btn-success btn-lg ingreso" type="button" data-toggle="modal" data-target="#abrirmodalEditar" style="border-radius: 0.5em;">
                                    <i class="fa fa-plus fa-1x"></i>&nbsp;&nbsp;INGRESO
                            </button>&nbsp;&nbsp;&nbsp;&nbsp;

                            <button class="btn btn-danger btn-lg egreso" type="button" data-toggle="modal" data-target="#abrirmodalEditar" style="border-radius: 0.5em;">
                                    <i class="fa fa-minus fa-1x"></i>&nbsp;&nbsp;EGRESO
                            </button>
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <a href="{{url('cajadiaria')}}" target="_blank">
                                <button class="btn btn-dark btn-lg" type="button" style="border-radius: 0.5em;">
                                        <i class="fa fa-file fa-1x"></i>&nbsp;&nbsp;PDF
                                </button>

                                    </a>&nbsp;&nbsp;
                        </div>      
                        
                    </div>
                    <div class="card-body">                  
                        <div class="table-responsive" >
                                <table id="cajas" class="table table-bordered table-striped table-sm" style="width: 100%;">
                                <thead>                                                                    
                                    <tr class="bg-primary">
                                        <th rowspan="2">documento</th>
                                        <th rowspan="2">detalle</th>
                                        <th colspan="2" style="text-align:center;">Ingreso</th>
                                        <th colspan="2" style="text-align:center;">egreso</th>
                                        <th rowspan="2">usuario</th>
                                    </tr>
                                    <tr class="bg-primary">
                                        <th>Monto</th>
                                        <th>Medio de Pago</th>
                                        <th>Monto</th>
                                        <th>Medio de Pago</th>
                                    </tr>
                                </thead>
                                <tbody style="text-align-last: center;">
                                @php $ingresosefectivo=0 @endphp
                                @php $ingresosdeposito=0 @endphp
                                @foreach($cajas as $caja)                                
                                    <tr style="text-align:center !important;">
                                        <td class="nombre"><input type="hidden" name="id_caja" id="id_caja" class="id_caja" value="{{$caja->id}}">
                                            {{$caja->documento}} - {{$caja->numero}}
                                        </td>                                        
                                        <td class="codigo">{{$caja->descripcion}}</td>
                                        @if($caja->tipo=="Ingreso")
                                            
                                            <td class="efectivo">{{number_format($caja->monto,2)}}</td>
                                            <td class="color">{{$caja->medio}} {{$caja->banco}}</td>
                                            <td class="color"></td>
                                            <td class="color"></td>
                                        @else
                                            <td class="color"></td>
                                            <td class="efectivo"></td>
                                            <td class="efectivo">{{number_format($caja->monto,2)}}</td>
                                            <td class="color">{{$caja->medio}} {{$caja->banco}}</td>
                                        @endif                            
                                        
                                        <td>
                                            {{$caja->usuario}}
                                        </td>
                                    </tr>
                                @endforeach
                                
                                </tbody>
                                <tfoot>
                                    <td colspan="2" style="text-align:right">Totales: </td>
                                    <td class="color">{{number_format($ingresos,2)}}</td>
                                    <td class="color"></td>
                                    <td class="color">{{$egresos}}</td>
                                    <td></td>
                                </tfoot>
                            </table>
                                
                        </div>
                    </div>
                </div>
                <!-- Fin ejemplo de tabla Listado -->
            </div>


             <!--Inicio del modal actualizar-->
             <div class="modal fade" id="abrirmodalEditar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="texto"></h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                        </div>
                       
                        <div class="modal-body">
                            
                            <form action="{{route('caja.store')}}" method="post" class="form-horizontal" enctype="multipart/form-data" autocomplete="off">
                                {{csrf_field()}}
                                <input type="hidden" id="tipo" name="tipo" class="form-control"  value="" >
                                @include('caja.form')

                            </form>

                            
                        </div>
                        
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!--Fin del modal-->


            <!-- Inicio del modal Cambiar Estado del Caja -->
            <div class="modal fade" id="cambiarEstado" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-danger" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Cambiar Estado del Caja</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                        </div>

                    <div class="modal-body">
                        <form action="{{route('caja.destroy','test')}}" method="POST" autocomplete="off">
                         {{method_field('delete')}}
                         {{csrf_field()}} 

                            <input type="hidden" id="id_caja" name="id_caja" value="">

                                <p>Estas seguro de cambiar el estado?</p>
        

                            <div class="modal-footer">
                            <button type="submit" class="btn btn-success" style="border-radius:0.7em;"><i class="fa fa-save fa-1x"></i> Guardar</button>
                            <button type="button" class="btn btn-danger" style="border-radius:0.7em;" data-dismiss="modal"><i class="fa fa-times fa-1x"></i> Cerrar</button>
                            </div>

                         </form>
                    </div>
                    <!-- /.modal-content -->
                   </div>
                <!-- /.modal-dialog -->
             </div>
            <!-- Fin del modal Eliminar -->

           
            
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
    $(document).on('click', '.ingreso', function()
    {
        var _this = $(this).parents('tr');
        $('#texto').text('Ingreso');
        $('#tipo').val('Ingreso');
    });

    $(document).on('click', '.egreso', function()
    {
        var _this = $(this).parents('tr');
        $('#tipo').val('Egreso');
        $('#texto').text('Egreso');
    });

</script>  


@endpush

@endsection