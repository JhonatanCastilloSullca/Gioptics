@extends('home')
@section('contenido')
<main class="main">
            <!-- Breadcrumb -->
          
            <div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
                <div class="card">
                    <div class="card-header">

                    <h2><i class="fa fa-star fa-1x"></i>&nbsp;&nbsp;Listado de atributos</h2><br/>                      

                      
                       <button class="btn btn-success btn-lg" type="button" data-toggle="modal" data-target="#abrirmodalEditar" style="border-radius: 0.5em;">
                            <i class="fa fa-plus fa-1x"></i>&nbsp;&nbsp;Agregar Atributo
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive" style="overflow-x:auto;overflow-y:auto;" >
                            <table id="caracteristicas" class="table table-bordered table-striped table-sm ">
                                <thead>
                                    <tr class="bg-primary">
                                        <th>Nº</th>
                                        <th>Atributo</th>
                                        <th>Categoria</th>
                                        <th>Estado</th>
                                        <th>Editar</th>
                                        <th><i class="fa fa-trash fa-1x"></i></th>
                                    </tr>
                                </thead>
                                <tbody>
                                @php $cont=1 @endphp
                                @foreach($caracteristicas as $caracteristica)                                
                                    <tr>
                                        <td class="nombre">{{$cont}} </td>
                                        <td class="nombre">{{$caracteristica->nombre}}<input type="hidden" name="id_caracteristica" id="id_caracteristica" class="id_caracteristica" value="{{$caracteristica->id}}"></td>
                                        
                                            <td class="nombre">{{$caracteristica->adicional->nombre}}<input type="hidden" name="id_caracteristica" id="id_caracteristica" class="id_caracteristica" value="{{$caracteristica->adicional->id}}"></td>
                                        
                                        <td >
                                            @if($caracteristica->estado)
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
                                        <a class="edit" data-toggle="modal" data-id_caracteristica="'$caracteristicas->id'"  data-target="#abrirmodal">
                                            <button type="button" class="btn btn-info btn-sm" >
                                                <i class="fa fa-edit fa-1x"></i>
                                            </button> </a>&nbsp;
                                        </td>
                                        <td>
                                        <a href="deletecaracteristica/{{$caracteristica->id}}">
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
                <form id="delete-form" action="{{route('caracteristica.destroy','test')}}" method="POST" autocomplete="off">
                
                    {{method_field('delete')}}
                    {{csrf_field()}} 
                    <input type="hidden" id="id_caracteristica3" name="id_caracteristica3" value="">
                </form>
            </div>
            <!--Inicio del modal agregar-->
            <div class="modal fade" id="abrirmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Actualizar Atributo</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                        </div>
                       
                        <div class="modal-body">
                            <form action="{{route('caracteristica.update','test')}}" method="post" class="form-horizontal" enctype="multipart/form-data" autocomplete="off">
                                
                            {{method_field('patch')}}

                                {{csrf_field()}}

                                <input type="hidden" id="id_caracteristica2" name="id_caracteristica2" value="">
                                @include('caracteristica.form')

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
                            <h4 class="modal-title">Agregar Atributo</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                        </div>
                       
                        <div class="modal-body">
                            
                            <form action="{{route('caracteristica.store')}}" method="post" class="form-horizontal" enctype="multipart/form-data" autocomplete="off">
                                {{csrf_field()}}
                                @include('caracteristica.form')

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
        $('#caracteristicas').DataTable({
            "lengthMenu":[[10,25,50,-1],[10,25,50,"Todos"]]
        });
    } );

        
    $(document).on('click', '.edit', function()
    {
        var _this = $(this).parents('tr');
        $('#id_caracteristica2').val(_this.find('.id_caracteristica').val());
        
        <?php foreach ($caracteristicas as $caracteristica): ?>    
            if('{{$caracteristica->id}}' == _this.find('.id_caracteristica').val()){
                $('#id_caracteristica2').val(_this.find('.id_caracteristica').val());
                $('#nombre').val('{{$caracteristica->nombre}}');
            }
        <?php endforeach ?> 
        
    });

    $(document).on('click', '.edit2', function()
    {
        var _this = $(this).parents('tr');
        $('#id_caracteristica3').val(_this.find('.id_caracteristica').val());
        event.preventDefault();
        document.getElementById('delete-form').submit();
    });

</script>  


@endpush

@endsection