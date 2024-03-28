@extends('home')
@section('contenido')
<main class="main">
            <!-- Breadcrumb -->
          
            <div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex;flex-wrap: nowrap;margin-bottom: 20px;">
                            <h2><i class="fa fa-filter fa-1x"></i>&nbsp;&nbsp;Clasificador de Productos</h2>
                            <br/> 
                            <button class="btn btn-success" type="button" data-toggle="modal" data-target="#abrirmodalEditarCategoria" style="border-radius: 0.5em;margin-left: 10px; font-size:0.75 !important;">
                            <i class="fa fa-plus fa-1x"></i>&nbsp;&nbsp;Agregar Producto
                            </button>
                            
                        </div>
                    </div>
                    <div class="card-body">
                    
                        @foreach($categorias as $categoria)                            
                            
                            
                            <div style="display: flex;margin-bottom: 20px;">
                                <h4 style="padding-top: 10px;">{{$categoria->nombre}}</h4>&nbsp;&nbsp;
                                <button class="btn btn-success botoncategoria" style="font-size:0.75 !important;" type="button" data-toggle="modal" data-target="#abrirmodalEditar"  data-id="{{$categoria->id}}" >
                                    <i class="fa fa-plus fa-1x" ></i>&nbsp;&nbsp;Agregar Categoria
                                </button>
                            </div>
                            
                            <div style="overflow-y:auto;">
                            <table id="productos" class="table table-bordered table-striped table-sm">
                                    <thead>
                                        <tr style="white-space: nowrap;" class="bg-primary">
                                            <th>Cantidad</th>
                                            <th>Unidad</th>
                                            <th>Codigo</th>
                                            <th>Producto</th>
                                            @foreach($categoria->adicionales as $adi)
                                                <th style="justify-content: space-between;">{{$adi->nombre}}<button class="btn-info" type="button" data-toggle="modal" data-target="#abrirmodalEditarCaracteristica" data-id="{{$adi->id}}" style="border-radius: 0.5em;margin-left: 10px;border:none"><i class="fa fa-plus fa-1x" style="font-size: 11px !important;padding-right: 3px;padding-left: 2px;"></i></button></th>
                                            @endforeach
                                            <th>Precio Compra</th>
                                            <th>Precio Venta</th>
                                            <th>Proveedor</th>
                                            <th>UBICACION</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr style="white-space: nowrap; font-size:12px">
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            @foreach($categoria->adicionales as $adi)
                                            <td>
                                                @foreach($adi->caracteristicas as $cara)
                                                    
                                                        {{$cara->nombre}}<br>                                                    
                                                @endforeach
                                            </td>
                                            @endforeach
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>                                    
                                    </tbody>
                                </table>
                            </div>
                            <div style="padding-top: 10px;padding-bottom: 10px;">
                                <hr>
                            </div>                            
                        @endforeach
                    </div>
                </div>
                <!-- Fin ejemplo de tabla Listado -->               
            </div>
            <!--Inicio del modal actualizar-->
            <div class="modal fade" id="abrirmodalEditarCategoria" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Agregar Producto</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                        </div>
                       
                        <div class="modal-body">
                            
                            <form action="{{route('categoria.store')}}" method="post" class="form-horizontal" enctype="multipart/form-data" autocomplete="off">
                                {{csrf_field()}}
                                
                                @include('categoria.form')

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
                            <h4 class="modal-title">Agregar Categoria</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            
                            <form action="{{route('adicional.store')}}" method="post" class="form-horizontal" enctype="multipart/form-data" autocomplete="off">
                                
                                <input type="hidden" name="id_categoria" id="id_categoria">
                                {{csrf_field()}}
                                @include('categoria.formadicional')

                            </form>

                            
                        </div>
                        
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!--Fin del modal-->


            <!--Inicio del modal actualizar-->
            <div class="modal fade" id="abrirmodalEditarCaracteristica" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Agregar Atributo</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            
                            <form action="{{route('caracteristica.store')}}" method="post" class="form-horizontal" enctype="multipart/form-data" autocomplete="off">

                                {{csrf_field()}}
                                <input type="hidden"  id="adicional_id" name="adicional_id" class="form-control">
                                @include('categoria.formcaracteristica')

                            </form>

                            
                        </div>
                        
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!--Fin del modal-->
            
            <!--Inicio del modal actualizar-->
            <div class="modal fade" id="abrirmodalUnidad" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Agregar Unidad</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            
                            <form action="{{route('unidad.store')}}" method="post" class="form-horizontal" enctype="multipart/form-data" autocomplete="off">
                                
                                {{csrf_field()}}
                                @include('categoria.formunidad')

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

@if(!empty(Session::get('error_code')) && Session::get('error_code') == 5)
<script>
$(function() {
    $('#abrirmodalEditarCategoria').modal('show');
});
</script>       
@endif
@if(!empty(Session::get('error_code')) && Session::get('error_code') == 7)
<script>
$(function() {
    $('#abrirmodalEditar').modal('show');
});
</script>       
@endif   
@if(!empty(Session::get('error_code')) && Session::get('error_code') == 8)
<script>
$(function() {
    $('#abrirmodalEditarCaracteristica').modal('show');
});
</script>       
@endif  
<script>     
$('#abrirmodalEditar').on('show.bs.modal', function (event) 
{
    var button = $(event.relatedTarget);
    var id = button.data('id');
    $('#id_categoria').val(id);
});
       
$('#abrirmodalEditarCaracteristica').on('show.bs.modal', function (event) 
{
    var button = $(event.relatedTarget);
    var adicional = button.data('id');
    $('#adicional_id').val(adicional);
});
</script>  


@endpush

@endsection