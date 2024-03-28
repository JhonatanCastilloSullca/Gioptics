@extends('home')
@section('contenido')
<main class="main">
            <!-- Breadcrumb -->
          
            <div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
                <div class="card">
                    <div class="card-header">

                    <h2><i class="fa fa-gift fa-1x"></i>&nbsp;&nbsp;Listado de productos</h2><br/>                                                                 
                    </div>
                    <div class="card-body">
                        <div class="table-responsive" style="overflow-x:auto;overflow-y:auto;" >
                            <table id="adicionals" class="table table-bordered table-striped table-sm ">
                                <thead>
                                    <tr class="bg-primary">
                                        <th>Nº</th>
                                        <th>Producto</th>
                                        <th>disponibilidad</th>
                                        <th>Estado</th>
                                        <th>Editar</th>
                                        <th><i class="fa fa-trash fa-1x"></i></th>
                                    </tr>
                                </thead>
                                <tbody>
                                @php $cont=1 @endphp
                                @foreach($categorias as $categoria)                                
                                    <tr>
                                        <td class="nombre">{{$cont}} </td>
                                        <td class="nombre">{{$categoria->nombre}} <input type="hidden" name="id_categoria" id="id_categoria" class="id_categoria" value="{{$categoria->id}}"></td>    
                                        <td class="nombre">{{$categoria->tipo}} </td>                                                                          
                                        <td >
                                            @if($categoria->estado)
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
                                        <a class="edit" data-toggle="modal" data-id_adicional="'$categoria->id'"  data-target="#abrirmodal">
                                            <button type="button" class="btn btn-info btn-sm" >
                                                <i class="fa fa-edit fa-1x"></i>
                                            </button> </a>&nbsp;
                                        </td>
                                        <td>
                                        <a href="deletecategoria/{{$categoria->id}}">
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
                <form id="delete-form" action="{{route('categoria.destroy','test')}}" method="POST" autocomplete="off">
                
                    {{method_field('delete')}}
                    {{csrf_field()}} 
                    <input type="hidden" id="id_categoria3" name="id_categoria3" value="">
                </form>
            </div>
            <!--Inicio del modal agregar-->
            <div class="modal fade" id="abrirmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Actualizar Producto</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                        </div>
                       
                        <div class="modal-body">
                            <form action="{{route('categoria.update','test')}}" method="post" class="form-horizontal" enctype="multipart/form-data" autocomplete="off">
                                
                            {{method_field('patch')}}

                                {{csrf_field()}}

                                <input type="hidden" id="id_categoria2" name="id_categoria2" value="">
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
        $('#adicionals').DataTable({
            "lengthMenu":[[10,25,50,-1],[10,25,50,"Todos"]]
        });
    } );

        
    $(document).on('click', '.edit', function()
    {
        var _this = $(this).parents('tr');
        $('#id_categoria2').val(_this.find('.id_categoria').val());
        
        <?php foreach ($categorias as $categoria): ?>    
            if('{{$categoria->id}}' == _this.find('.id_categoria').val()){
                $('#id_categoria2').val(_this.find('.id_categoria').val());
                $('#nombre').val('{{$categoria->nombre}}');
                $('#tipo').val('{{$categoria->tipo}}');

            }
        <?php endforeach ?> 
        $('#tipo').selectpicker('refresh');
        
    });

    $(document).on('click', '.edit2', function()
    {
        var _this = $(this).parents('tr');
        $('#id_categoria3').val(_this.find('.id_categoria').val());
        event.preventDefault();
        document.getElementById('delete-form').submit();
    });

</script>  


@endpush

@endsection