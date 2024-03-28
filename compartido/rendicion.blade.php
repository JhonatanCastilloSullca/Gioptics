@extends('home')
@section('contenido')

<main class="main" style="background-color: white;">
@foreach($requerimientos as $req)
    <div class="card-body">
        <div class="table-responsive" >
            <table class="table table-bordered table-striped table-sm" >
                <tbody>
                    <tr>
                        <td rowspan="2" style="TEXT-ALIGN-LAST: CENTER;"><img src="{{asset('img/geovial.png')}}" width="100px" height="50px"></td>
                        <td colspan="7" style="TEXT-ALIGN-LAST: CENTER;font-size: x-large;"><b>RENDICION</b></td>
                        <td rowspan="2" style="TEXT-ALIGN-LAST: CENTER;"><img src="{{asset('img/geovial.png')}}" width="100px" height="50px"></td>
                    </tr>
                    <tr>
                        
                            <td colspan="4"><b>FECHA: {{date("d-m-Y" )}}</b></td>
                            <td colspan="3"><b>NUMERO: REQ-{{$req->usuario}}-{{$req->numero}}-2021</b></td>
                        
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="table-responsive" >
            <table class=" tableinvcab table table-sm" >
                <tbody>
                    <tr class=" tableinvcab">
                        <td class=" tableinvcab"><b>A QUIEN RINDE: {{Auth::user()->nombre}} {{Auth::user()->apellido}}</b></td>
                        <td class=" tableinvcab"><b>QUIEN RINDE: {{$req->usuario}} {{$req->apellido}} </b></td>
                    </tr>
                    <tr class=" tableinvcab">
                        <td class=" tableinvcab"><b>PROYECTO: {{$req->categoria}}  </b></td>
                        <td class=" tableinvcab"><b>NOMBRE CLAVE: {{$req->proyecto}}  </b></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <b>1.-  RECIBIDO</b>
        <div class="table-responsive" >
            <table class="table table-bordered table-striped table-sm" style="TEXT-ALIGN-LAST: CENTER;">
                <tbody>
                    <tr class="bg-primary">
                        <td><b>Nº</b></td>
                        <td><b>FECHA</b></td>
                        <td><b>DETALLE</b></td>
                        <td><b>FUENTE</b></td>
                        <td><b>OBSERVACIONES</b></td>
                        <td><b>MONTO</b></td>
                    </tr>@php $item1=1; @endphp
                    @php $total_ingreso=0; @endphp
                    @foreach($anteriores as $ant)
                        @if($req->estado!="POR RENDIR")
                            @if($ant->estado=="FINALIZADO")
                                @if($ant->fuente==$req->id)
                                    <tr>
                                        
                                        <td><b>{{$item1}}</b></td>
                                        <td><b>{{date("d/m/Y", strtotime($ant->fecha))}} </b></td>
                                        <td><b>{{$ant->detalle}} </b></td>
                                        <td><b>REQ-{{$ant->numero}}-{{$ant->nombre}}</b></td>
                                        <td><b></b></td>
                                        <td><b>{{$ant->monto}}</b></td>
                                        
                                        @php $item1++; @endphp
                                        @php $total_ingreso=$total_ingreso+$ant->monto; @endphp
                                        
                                    </tr>
                                @endif
                            @endif
                        @else
                            @if($ant->estado=="REGISTRADO")
                                <tr>
                                        
                                    <td><b>{{$item1}}</b></td>
                                    <td><b>{{date("d/m/Y", strtotime($ant->fecha))}} </b></td>
                                    <td><b>{{$ant->detalle}} </b></td>
                                    <td><b>REQ-{{$ant->numero}}-{{$ant->nombre}}</b></td>
                                    <td><b></b></td>
                                    <td><b>{{$ant->monto}}</b></td>
                                    
                                    @php $item1++; @endphp
                                    @php $total_ingreso=$total_ingreso+$ant->monto; @endphp
                                    
                                </tr>
                            @endif
                        @endif
                    @endforeach
                    @foreach($depositos as $dep)
                    <tr>
                        <td><b>{{$item1}}</b></td>
                        <td><b>{{date("d/m/Y", strtotime($dep->fecha))}} </b></td>
                        <td><b>{{$dep->medioPago}} </b></td>
                        <td><b>OFICINA CUSCO</b></td>
                        <td><b></b></td>
                        <td><b>{{$dep->monto}}</b></td>
                        
                        @php $item1++; @endphp
                        @php $total_ingreso=$total_ingreso+$dep->monto; @endphp
                    </tr>
                    @endforeach
                    <tr>
                        <td><b></b></td>
                        <td><b></b></td>
                        <td><b> </b></td>
                        <td><b></b></td>
                        <td><b>TOTAL INGRESO</b></td>
                        <td><b>{{number_format($total_ingreso,2)}}</b></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <b>2.-  GASTOS</b>&nbsp;&nbsp;&nbsp;
        @if($req->estado=="POR RENDIR")
            @if(Auth::user()->id=="TESORERIA" || Auth::user()->id=="LOGISTICA")
                <button type="button" id="agregar_gasto" class="btn btn-success btn-md"  data-toggle="modal" data-target="#abrirmodalEditar">
                    <i class="fa fa-plus fa-1x"></i> Agregar Gasto
                </button><br></br>
            @endif
        @else
        @endif
        <div class="table-responsive" >
            <table class="table table-bordered table-striped table-sm" id="gastos">
                <tbody>
                    <tr class="bg-primary">
                        <td><b>Nº</b></td>
                        <td><b>FECHA</b></td>
                        <td><b>CATEGORIA</b></td>
                        <td><b>INSUMO/EQUIPO</b></td>
                        <td><b>PROVEEDOR</b></td>
                        <td><b>DETALLE</b></td>
                        <td><b>TIPO</b></td>
                        <td><b>Nº</b></td>
                        <td><b>APROBADO</b></td>
                        <td><b>EJECUTADO</b></td>
                        <td>
                            
                        </td>
                    </tr>@php $item=1; $total=0;@endphp
                    @foreach($detalle_requerimientos as $dereq)
                    <tr>
                        <td>{{$item}}<input type="hidden" class="id_detalle_1" value="{{$dereq->id}}"></td>
                        <td>
                        @if($dereq->fechafin!="")
                            {{date("d/m/Y", strtotime($dereq->fechafin))}}</td>
                        @else
                        @endif
                        <td>{{$dereq->rubro}}</td>
                        
                            @if($dereq->rubro=="MAQUINARIA")
                                @foreach($maquinarias as $maq)
                                    @if($maq->id==$dereq->idInsumo)
                                        <td>{{$maq->nombre}}</td>
                                    @endif
                                @endforeach
                            @else
                                @foreach($insumos as $ins)
                                    @if($ins->id==$dereq->idInsumo)
                                        <td>{{$ins->nombre}}</td>
                                    @endif
                                @endforeach
                            @endif
                        
                            
                                
                        @foreach($proveedor as $prov)
                            @if($dereq->idProveedor==$prov->id)
                                <td class="proveedor">{{$prov->nombre}}</td>
                            @endif
                        @endforeach
                        <td>{{$dereq->detalle}}</td>
                        <td>{{$dereq->sustento}}</td>
                        <td>{{$dereq->numero}}</td>
                        <td style="text-align-last: right">{{number_format($dereq->preciosug*$cantidad,2)}}</td>
                        <td style="text-align-last: right">{{number_format($dereq->monto,2)}}</td>
                        <td>
                            <a class="edit" data-toggle="modal" data-contrato="'$dereq->id'"  data-target="#abrirmodal">
                            <button type="button" class="btn btn-info btn-md" >
                                <i class="fa fa-edit fa-1x"></i>
                            </button> </a>&nbsp;
                        </td>
                        @php $item++; $total=$total+$dereq->monto;@endphp
                    </tr>
                    @endforeach
                    <tr>
                        
                    </tr>
                </tbody>
                <form action="{{route('rendicionrequerimiento.store')}}" method="post" class="form-horizontal" enctype="multipart/form-data" >
                    {{csrf_field()}}
                <tfoot>
                        <tr>
                            <td  colspan="9"><p align="right">TOTAL REQUERIMIENTO:</p></td>
                            <td style="text-align-last:right"><b>{{number_format($total,2)}}<input type="hidden" id="totalRendicion" name="totalRendicion" value="{{$total}}"> </b><BR></td>
                        </tr>           
                </tfoot>
            </table>
        </div>
            @php $monto=0; $monto=$total_ingreso  -  $total; @endphp
            <input type="hidden" id="id_requerimiento" name="id_requerimiento" value="{{$req->id}}">
            <input type="hidden" id="id_usuario" name="id_usuario" value="{{$req->idUsuario}}">
            <input type="hidden" id="monto" name="monto" value="{{$monto}}">              
        <div class="table-responsive" >
            <table class="table table-bordered table-striped table-sm" >
                <textarea name="observaciones" rows="5" cols="75">Observaciones</textarea>
            </table>
        </div>
        <div class="modal-footer form-group row" style="text-align: -webkit-right;" id="footerbuttons">
                <div class="col-md">
                    @if($req->estado=="POR RENDIR")
                        @if(Auth::user()->id=="TESORERIA" || Auth::user()->id=="LOGISTICA")
                            <button type="submit" class="btn btn-success"><i class="fa fa-save fa-1x"></i> FINALIZAR</button>
                        @endif
                    @endif
                    <input type="button" value="ATRAS" class="btn btn-danger" onClick="history.go(-1);">
                </div>

            </div>
        </form>
        </div>
    </div><!--fin del div card body-->    


    <div class="modal fade" id="abrirmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">EDITAR GASTO</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                        </div>
                       
                        <div class="modal-body">
                             
                                <form action="{{route('detallerequerimiento.update','test')}}" method="post" class="form-horizontal" enctype="multipart/form-data">
                                
                                 {{method_field('patch')}}
    
                                    {{csrf_field()}}
    
                                    <input type="hidden" id="id_detalle2" name="id_detalle2" value="">
                                    @include('requerimiento.form2')
    
                                </form>
                        </div>
                        
                </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
    </div>
            <!--Fin del modal-->

        <!--Inicio del modal actualizar-->
        <div class="modal fade" id="abrirmodalEditar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Agregar Gasto</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                        </div>
                       
                        <div class="modal-body">
                             
                                <form action="{{route('detallerequerimiento.store')}}" method="post" class="form-horizontal" enctype="multipart/form-data" >
                                
    
                                    {{csrf_field()}}
    
                                    <input type="hidden" id="id_detalle" name="id_detalle" value="{{$req->id}}">
                                    @include('requerimiento.form')
    
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

$("#idTipo1").change(agregarValores2);
    function agregarValores2(){
        limpiarselect2();
        if('MAQUINARIA'==$("#idTipo1 option:selected").text()){
            <?php foreach ($maquinarias  as $maq): ?>
                $('#idInsumo1').append("<option value='{{$maq->id}}' >{{$maq->nombre}}</option>");
            <?php endforeach ?> 
        }else{
                <?php foreach ($insumos as $ins): ?>    
                if('{{$ins->idTipo}}'==$("#idTipo1 option:selected").val()){
                    $('#idInsumo1').append("<option value='{{$ins->id}}' >{{$ins->nombre}}</option>");
                }
                <?php endforeach ?>   
        }
        $('#idInsumo1').selectpicker('refresh');  
    }
    function limpiarselect2(){
        $('#idInsumo1').empty();
    }

    $(document).on('click', '.edit', function()
        {
            var _this = $(this).parents('tr');
            $('#id_detalle2').val(_this.find('.id_detalle_1').val());
            var id123=_this.find('.proveedor').text();
            mostrarValor(id123);
        });
    function mostrarValor(id123){
        <?php foreach ($proveedor as $prov): ?>
            if(id123=='{{$prov->nombre}}'){
                $("#idProveedor option[value='{{$prov->id}}']").attr("selected", true);}
        <?php endforeach ?>
        
        $('#idProveedor').selectpicker('refresh');
    }
</script>

@endpush
@endsection