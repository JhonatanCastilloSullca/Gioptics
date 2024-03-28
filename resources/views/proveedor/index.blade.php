@extends('home')
@section('contenido')
<main class="main">
            <!-- Breadcrumb -->
          
            <div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
                <div class="card">
                    <div class="card-header">                       
                       <h2><i class="fa fa-truck fa-1x"></i>&nbsp;&nbsp;Listado de Proveedores</h2><br/>                      

                      
                       <button class="btn btn-success btn-lg" type="button" data-toggle="modal" data-target="#abrirmodalEditar" style="border-radius: 0.5em;">
                            <i class="fa fa-plus fa-1x"></i>&nbsp;&nbsp;Agregar Proveedor
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive" style="overflow-x:auto;overflow-y:auto;"  >
                            <table id="proveedores" class="table table-bordered table-striped table-sm">
                                <thead>
                                    <tr class="bg-primary">
                                        <th>NÂº</th>                                        
                                        <th>Nombre</th>
                                        <th>Tipo de Documento</th>
                                        <th>Numero de Documento</th>
                                        <th>Direccion</th>
                                        <th>Celular</th>
                                        <th>Email</th>
                                        <th>Numero de Cuenta</th>
                                        <th>Descripcci¨®n</th>
                                        <th>Estado</th>
                                        <th>Editar</th>
                                        <th>Eliminar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @php $cont=1 @endphp
                                @foreach($proveedors as $proveedor)
                                
                                    <tr>
                                        <td class="numero">{{$cont}}</td>
                                        
                                        <td class="nombre">{{$proveedor->nombre}}<input type="hidden" name="id_prove" id="id_prove" class="id_prove" value="{{$proveedor->id}}"></td>
                                        <td class="tipo_documento">{{$proveedor->tipo_documento}}</td>
                                        <td class="num_documento">{{$proveedor->num_documento}}</td>
                                        <td class="direccion">{{$proveedor->direccion}}</td>
                                        <td class="celular">{{$proveedor->celular}}</td>
                                        <td class="email">{{$proveedor->email}}</td>
                                        <td  class="num_cuenta">{{$proveedor->num_cuenta}}</td>
                                        <td  class="descripcion">{{$proveedor->descripcion}}</td>
                                        <td  class="estado">
                                            @if($proveedor->estado=="ACTIVO")
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
                                        <a class="edit" data-toggle="modal" data-id_proveedor="'$proveedor->id'"  data-target="#abrirmodal">
                                            <button type="button" class="btn btn-info btn-sm" >
                                                <i class="fa fa-edit fa-1x"></i>
                                            </button> </a>&nbsp;
                                        </td>

                                        <td>
                                        <a class="edit2" data-toggle="modal" data-id_proveedor="'$proveedor->id'"  data-target="#cambiarEstado">
                                            <button type="button" class="btn btn-danger btn-sm">
                                            <i class="fa fa-times fa-1x"></i>
                                            </button> </a>&nbsp;
                                        </td>

                                    </tr>
                                    @php $cont=$cont+1 @endphp

                                    @endforeach
                                
                                </tbody>
                            </table>
                        </div>
                        <form id="delete-form" action="{{route('proveedor.destroy','test')}}" method="POST" autocomplete="off">
                         {{method_field('delete')}}
                         {{csrf_field()}} 

                            <input type="hidden" id="id_enviar" name="id_enviar" value="">
                        </form>
                    </div>
                </div>
                <!-- Fin ejemplo de tabla Listado -->
            </div>
            <!--Inicio del modal agregar-->
            <div class="modal fade" id="abrirmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Actualizar Proveedor</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">Ã—</span>
                            </button>
                        </div>
                       
                        <div class="modal-body">
                            <form action="{{route('proveedor.update','test')}}" method="post" class="form-horizontal" enctype="multipart/form-data" autocomplete="off">
                                
                            {{method_field('patch')}}

                                {{csrf_field()}}

                                <input type="hidden" id="id_proveedor2" name="id_proveedor2" value="">
                                @include('proveedor.form')

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
                            <h4 class="modal-title">Agregar Proveedor</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">Ã—</span>
                            </button>
                        </div>
                       
                        <div class="modal-body">
                            
                            <form action="{{route('proveedor.store')}}" method="post" class="form-horizontal" enctype="multipart/form-data" autocomplete="off" >
                                {{csrf_field()}}
                                @include('proveedor.form')

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
        $('#proveedores').DataTable({
            "lengthMenu":[[10,25,50,-1],[10,25,50,"Todos"]]
        });
    } );
</script>

<script>        
        $(document).on('click', '.edit', function()
        {
            var _this = $(this).parents('tr');
            $('#id_proveedor2').val(_this.find('.id_prove').val());
            $('#nombre').val(_this.find('.nombre').text());
            $('#idCategoria').val(_this.find('.idCategoria').text());
            $('#tipo_documento').val(_this.find('.tipo_documento').text());
            $('#num_documento').val(_this.find('.num_documento').text());
            $('#direccion').val(_this.find('.direccion').text());
            $('#celular').val(_this.find('.celular').text());        
            $('#email').val(_this.find('.email').text());
            $('#num_cuenta').val(_this.find('.num_cuenta').text());
            $('#descripcion').val(_this.find('.descripcion').text());
            $('#estado').val(_this.find('.estado').text());

            $('#idCategoria').selectpicker('refresh');
            $('#tipo_documento').selectpicker('refresh');
        });
        
    
    $(document).on('click', '.edit2', function()
    {
        var _this = $(this).parents('tr');
        $('#id_enviar').val(_this.find('.id_prove').val());
        event.preventDefault();
        document.getElementById('delete-form').submit();
    });
</script>  


@endpush

@endsection