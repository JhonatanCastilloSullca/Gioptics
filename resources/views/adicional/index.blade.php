@extends('home')
@section('contenido')
<main class="main">
            <!-- Breadcrumb -->
          
            <div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
                <div class="card">
                    <div class="card-header">

                    <h2><i class="fa fa-table fa-1x"></i>&nbsp;&nbsp;Listado de categorias</h2><br/>                                                                 
                    </div>
                    <div class="card-body">
                        <div class="table-responsive" style="overflow-x:auto;overflow-y:auto;" >
                            <table id="adicionals" class="table table-bordered table-striped table-sm ">
                                <thead>
                                    <tr class="bg-primary">
                                        <th>Nº</th>
                                        <th>Categoria</th>
                                        <th>producto</th>
                                        <th>Estado</th>
                                        <th>Editar</th>
                                        <th><i class="fa fa-trash fa-1x"></i></th>
                                    </tr>
                                </thead>
                                <tbody>
                                @php $cont=1 @endphp
                                @foreach($adicionals as $adicional)                                
                                    <tr>
                                        <td class="nombre">{{$cont}} </td>
                                        <td class="nombre">{{$adicional->nombre}} {{$adicional->apellido}}<input type="hidden" name="id_adicional" id="id_adicional" class="id_adicional" value="{{$adicional->id}}"></td>
                                        @foreach($adicional->categorias as $cat)
                                            <td class="nombre">{{$cat->nombre}}<input type="hidden" name="id_adicional" id="id_adicional" class="id_adicional" value="{{$adicional->id}}"></td>
                                        @endforeach                                                                                
                                        <td >
                                            @if($adicional->estado)
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
                                        <a class="edit" data-toggle="modal" data-id_adicional="'$adicional->id'"  data-target="#abrirmodal">
                                            <button type="button" class="btn btn-info btn-sm" >
                                                <i class="fa fa-edit fa-1x"></i>
                                            </button> </a>&nbsp;
                                        </td>   
                                        <td>
                                        <a href="deleteadicional/{{$adicional->id}}">
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
                <form id="delete-form" action="{{route('adicional.destroy','test')}}" method="POST" autocomplete="off">
                
                    {{method_field('delete')}}
                    {{csrf_field()}} 
                    <input type="hidden" id="id_adicional3" name="id_adicional3" value="">
                </form>
            </div>
            <!--Inicio del modal agregar-->
            <div class="modal fade" id="abrirmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Actualizar Categoria</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                        </div>
                       
                        <div class="modal-body">
                            <form action="{{route('adicional.update','test')}}" method="post" class="form-horizontal" enctype="multipart/form-data" autocomplete="off">
                                
                            {{method_field('patch')}}

                                {{csrf_field()}}

                                <input type="hidden" id="id_adicional2" name="id_adicional2" value="">
                                @include('adicional.form')

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
                                {{csrf_field()}}
                                @include('adicional.form')

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
        $('#id_adicional2').val(_this.find('.id_adicional').val());
        
        <?php foreach ($adicionals as $adicional): ?>    
            if('{{$adicional->id}}' == _this.find('.id_adicional').val()){
                $('#id_adicional2').val(_this.find('.id_adicional').val());
                $('#nombre').val('{{$adicional->nombre}}');
            }
        <?php endforeach ?> 
        
    });

    $(document).on('click', '.edit2', function()
    {
        var _this = $(this).parents('tr');
        $('#id_adicional3').val(_this.find('.id_adicional').val());
        event.preventDefault();
        document.getElementById('delete-form').submit();
    });

</script>  


@endpush

@endsection