@extends('home')
@section('contenido')
<main class="main">
            <!-- Breadcrumb -->
          
            <div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
                <div class="card">
                    <div class="card-header">

                    <h2><i class="fa fa-users fa-1x"></i>&nbsp;&nbsp;Listado de Usuarios</h2><br/>                      

                      
                       <button class="btn btn-success btn-lg" type="button" data-toggle="modal" data-target="#abrirmodalEditar" style="border-radius: 0.5em;">
                            <i class="fa fa-plus fa-1x"></i>&nbsp;&nbsp;Agregar Usuario
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive" style="overflow-x:auto;overflow-y:auto;" >
                            <table id="usuarios" class="table table-bordered table-striped table-sm ">
                                <thead>
                                    <tr class="bg-primary">
                                        <th>Nº</th>
                                        <th>Nombre</th>
                                        <th>Usuario</th>
                                        <th>Rol</th>
                                        <th>Estado</th>
                                        <th>Ver</th>
                                        <th><i class="fa fa-trash fa-1x"></i></th>
                                    </tr>
                                </thead>
                                <tbody>
                                @php $cont=1 @endphp
                                @foreach($usuarios as $user)
                                
                                    <tr>
                                        <td class="nombre">{{$cont}} </td>
                                        <td class="nombre">{{$user->nombre}} {{$user->apellido}}<input type="hidden" name="id_usuario" id="id_usuario" class="id_usuario" value="{{$user->id}}"></td>
                                        <td  class="usuario">{{$user->usuario}}</td>
                                        <td  class="rol">{{$user->rol}}</td>
                                        
                                        <td >
                                            @if($user->estado)
                                                <a class="edit2">
                                                    <input  type="checkbox" checked data-toggle="toggle"  data-on="Activado" data-off="Desactivado" data-onstyle="success" data-offstyle="danger">
                                                </a>
                                            @else
                                                <a class="edit2">
                                                    <input  type="checkbox"  data-toggle="toggle"  data-on="Activado" data-off="Desactivado" data-onstyle="success" data-offstyle="danger">
                                                </a>
                                            @endif
                                        </td>
                                        <td>
                                        <a class="edit" data-toggle="modal" data-id_usuario="'$user->id'"  data-target="#abrirmodal">
                                            <button type="button" class="btn btn-info btn-sm" >
                                                <i class="fa fa-eye fa-1x"></i>
                                            </button> </a>&nbsp;
                                        </td>
                                        <td>
                                        <a href="deleteusuario/{{$user->id}}">
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
                <!-- Fin ejemplo de tabla Listado -->
                <form id="delete-form" action="{{route('user.destroy','test')}}" method="POST" autocomplete="off">
                
                    {{method_field('delete')}}
                    {{csrf_field()}} 
                    <input type="hidden" id="id_user" name="id_user" value="">
                </form>
            </div>
            <!--Inicio del modal agregar-->
            <div class="modal fade" id="abrirmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Actualizar Usuario</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                        </div>
                       
                        <div class="modal-body">
                            <form action="{{route('user.update','test')}}" method="post" class="form-horizontal" enctype="multipart/form-data" autocomplete="off">
                                
                            {{method_field('patch')}}

                                {{csrf_field()}}

                                <input type="hidden" id="id_usuario2" name="id_usuario2" value="">
                                @include('user.form')

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
                            <h4 class="modal-title">Agregar Usuario</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                        </div>
                       
                        <div class="modal-body">
                            
                            <form action="{{route('user.store')}}" method="post" class="form-horizontal" enctype="multipart/form-data" autocomplete="off">
                                {{csrf_field()}}
                                @include('user.form')

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
        $('#abrirmodalEditar').modal('show');
    });
</script>       
@endif   
<script>     
    $(document).ready(function() {
        $('#usuarios').DataTable({
            "lengthMenu":[[10,25,50,-1],[10,25,50,"Todos"]]
        });
    } );

        
    $(document).on('click', '.edit', function()
    {
        var _this = $(this).parents('tr');
        $('#id_usuario2').val(_this.find('.id_usuario').val());
        
        <?php foreach ($usuarios as $use): ?>    
            if('{{$use->id}}' == _this.find('.id_usuario').val()){
                $('#id_usuario2').val(_this.find('.id_usuario').val());
                $('#nombre').val('{{$use->nombre}}');
                $('#apellido').val('{{$use->apellido}}');
                $('#tipo_documento').val('{{$use->tipo_documento}}');
                $('#num_documento').val('{{$use->num_documento}}');
                $('#celular').val('{{$use->celular}}');
                $('#email').val('{{$use->email}}');
                $('#rol').val('{{$use->rol}}');
                $('#usuario').val('{{$use->usuario}}');
                $('#tipo_documento').selectpicker('refresh');
                $('#rol').selectpicker('refresh');
            }
        <?php endforeach ?> 
        
    });

    $(document).on('click', '.edit2', function()
    {
        var _this = $(this).parents('tr');
        $('#id_user').val(_this.find('.id_usuario').val());
        event.preventDefault();
        document.getElementById('delete-form').submit();
    });

</script>  


@endpush

@endsection