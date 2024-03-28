@extends('home')
@section('contenido')
<main class="main">
            <!-- Breadcrumb -->          
            <div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
                <div class="card">
                    <div class="card-header">
                    <h2><i class="fa fa-map-marker fa-1x"></i>&nbsp;&nbsp;puntos de venta</h2><br/>                                                                   
                       <button class="btn btn-success btn-lg" type="button" data-toggle="modal" data-target="#abrirmodalEditar" style="border-radius: 0.5em;">
                            <i class="fa fa-plus fa-1x"></i>&nbsp;&nbsp;Agregar Tienda
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive" >
                            <table id="sucursales" class="table table-bordered table-striped table-sm">
                                <thead>
                                    <tr class="bg-primary">
                                        <th>N°</th>
                                        <th>Tienda</th>
                                        <th>DirecciOn</th>
                                        <th>Telefono</th>
                                        <th>Estado</th>
                                        <th>Editar</th>
                                        <th><i class="fa fa-trash fa-1x"></i></th>
                                    </tr>
                                </thead>
                                <tbody>
                                @php $cont=1 @endphp
                                @foreach($sucursales as $suc)
                                
                                    <tr>
                                        <td > {{$cont}}</td>
                                        <td class="nombre">{{$suc->nombre}}<input type="hidden" name="id_suc" id="id_suc" class="id_suc" value="{{$suc->id}}"></td>   
                                        <td  class="direccion">{{$suc->direccion}}</td>
                                        <td  class="telefono">{{$suc->telefono}}</td>
                                        <td  class="estado">
                                            @if($suc->estado)
                                                <a class="edit2">
                                                    <input  type="checkbox" checked data-toggle="toggle" data-on="Activado" data-off="Desactivado" data-onstyle="success" data-offstyle="danger">
                                                </a>
                                            @else
                                                <a class="edit2">
                                                    <input  type="checkbox"  data-toggle="toggle" data-on="Activado" data-off="Desactivado" data-onstyle="success" data-offstyle="danger">
                                                </a>
                                            @endif
                                        </td>
                                        <td>
                                        <a class="edit" data-toggle="modal" data-id_categoria="'$suc->id'"  data-target="#abrirmodal">
                                            <button type="button" class="btn btn-info btn-sm" >
                                                <i class="fa fa-edit fa-1x"></i>
                                            </button> </a>&nbsp;
                                        </td>
                                        <td>
                                        <a href="deletesucursal/{{$suc->id}}">
                                            <button type="button" class="btn btn-danger btn-sm" >
                                                <i class="fa fa-times fa-1x"></i>
                                            </button> </a>&nbsp;
                                        </td>


                                    </tr>
                                    @php $cont=$cont+1 @endphp
                                    @endforeach
                                
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <form  id="delete-form"  action="{{route('sucursal.destroy','test')}}" method="POST" autocomplete="off">
                         {{method_field('delete')}}
                         {{csrf_field()}} 

                            <input type="hidden" id="id_enviar" name="id_enviar" value="">
                </form>
                <!-- Fin ejemplo de tabla Listado -->
            </div>
            <!--Inicio del modal agregar-->
            <div class="modal fade" id="abrirmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Actualizar Sucursal</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                        </div>
                       
                        <div class="modal-body">
                            <form action="{{route('sucursal.update','test')}}" method="post" class="form-horizontal" enctype="multipart/form-data" autocomplete="off">
                                
                            {{method_field('patch')}}

                                {{csrf_field()}}

                                <input type="hidden" id="id_sucursal2" name="id_sucursal2" value="">
                                @include('sucursal.form')

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
                            <h4 class="modal-title">Agregar Sucursal</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                        </div>
                       
                        <div class="modal-body">
                            
                            <form action="{{route('sucursal.store')}}" method="post" class="form-horizontal" enctype="multipart/form-data" autocomplete="off" >
                                {{csrf_field()}}
                                @include('sucursal.form')

                            </form>

                            
                        </div>
                        
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!--Fin del modal-->

            
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
    $(document).ready(function() {
        $('#sucursales').DataTable({
            "lengthMenu":[[10,25,50,-1],[10,25,50,"Todos"]]
        });
    } );
</script>

<script>        
        $(document).on('click', '.edit', function()
        {
            var _this = $(this).parents('tr');
            $('#id_sucursal2').val(_this.find('.id_suc').val());
            $('#nombre').val(_this.find('.nombre').text());
            $('#direccion').val(_this.find('.direccion').text());
            $('#telefono').val(_this.find('.telefono').text());

        });
         $(document).on('click', '.edit2', function()
    {
        var _this = $(this).parents('tr');
        $('#id_enviar').val(_this.find('.id_suc').val());
        event.preventDefault();
        document.getElementById('delete-form').submit();
    });
       
</script>  


@endpush

@endsection