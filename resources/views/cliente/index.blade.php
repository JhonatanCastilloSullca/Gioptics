@extends('home')
@section('contenido')
<main class="main">
            <!-- Breadcrumb -->
          
            <div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
                <div class="card">
                    <div class="card-header">
                    
                       <h2><i class="fa fa-user fa-1x"></i>&nbsp;&nbsp;Listado de Clientes</h2><br/>                      

                    </div>
                    <div class="card-body">
                        <div style="overflow-y:auto;" >
                            <table id="clientes" class="table table-bordered table-striped table-sm">
                                <thead>
                                    <tr class="bg-primary">
                                        <th>Nº</th>
                                        <th>Nombre</th>
                                        <th>Tipo de Documento</th>
                                        <th>Numero de Documento</th>
                                        <th>Celular</th>
                                        <th>Email</th>
                                        <th>Fecha de Nacimiento</th>
                                        <th>Editar</th>
                                        <th><i class="fa fa-trash fa-1x"></i></th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $cont=1 @endphp

                                @foreach($clientes as $clie)
                                
                                    <tr>
                                        <td> {{$cont}}</td>
                                        
                                        <td class="nombre">{{$clie->nombre}}<input type="hidden" name="id_clie" id="id_clie" class="id_clie" value="{{$clie->id}}"></td>
                                        <td class="tipo_documento">{{$clie->tipo_documento}}</td>
                                        <td class="num_documento">{{$clie->num_documento}}</td>
                                        <td class="celular">{{$clie->celular}}</td>
                                        <td class="email">{{$clie->email}}</td>
                                        <td  class="fecha_nac">{{$clie->fecha_nac}}<input type="hidden" name="direccion1" id="direccion1" class="direccion1" value="{{$clie->direccion}}"></td>
                                        <td>
                                        <a class="edit" data-toggle="modal" data-id_proveedor="'$clie->id'"  data-target="#abrirmodal">
                                            <button type="button" class="btn btn-info btn-sm" >
                                                <i class="fa fa-edit fa-1x"></i>
                                            </button> </a>&nbsp;
                                        </td>
                                        <td>
                                        <a href="deletecliente/{{$clie->id}}">
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
            </div>
            <!--Inicio del modal agregar-->
            <div class="modal fade" id="abrirmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Actualizar Cliente</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                        </div>
                       
                        <div class="modal-body">
                            <form action="{{route('cliente.update','test')}}" method="post" class="form-horizontal" enctype="multipart/form-data" autocomplete="off">
                                
                                {{method_field('patch')}}

                                {{csrf_field()}}

                                <input type="hidden" id="id_cliente2" name="id_cliente2" value="">
                                @include('cliente.form')

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
                            <h4 class="modal-title">Agregar Cliente</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                        </div>
                       
                        <div class="modal-body">
                            
                            <form action="{{route('cliente.store')}}" method="post" class="form-horizontal" enctype="multipart/form-data" autocomplete="off" >
                                {{csrf_field()}}
                                @include('cliente.form')

                            </form>

                            
                        </div>
                        
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!--Fin del modal-->


            <!-- Inicio del modal Cambiar Estado del Proveedor -->
            <div class="modal fade" id="cambiarEstado" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-danger" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Cambiar Estado del Cliente</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                        </div>

                    <div class="modal-body">
                        <form action="{{route('cliente.destroy','test')}}" method="POST" autocomplete="off">
                         {{method_field('delete')}}
                         {{csrf_field()}} 

                            <input type="hidden" id="id_enviar" name="id_enviar" value="">

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
    $(document).ready(function() {
        $('#clientes').DataTable({
            "lengthMenu":[[10,25,50,-1],[10,25,50,"Todos"]]
        });
    } );
</script>

<script>        
        $(document).on('click', '.edit', function()
        {
            var _this = $(this).parents('tr');
            $('#id_cliente2').val(_this.find('.id_clie').val());
            $('#nombre').val(_this.find('.nombre').text());
            $('#tipo_documento').val(_this.find('.tipo_documento').text());
            $('#num_documento').val(_this.find('.num_documento').text());
            $('#celular').val(_this.find('.celular').text());        
            $('#email').val(_this.find('.email').text());
            $('#fecha_nac').val(_this.find('.fecha_nac').text());
            $('#direccion').val(_this.find('.direccion1').val());

            $('#tipo_documento').selectpicker('refresh');
        });
        
</script>  


@endpush

@endsection