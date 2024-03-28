@extends('home')
@section('contenido')
<main class="main">
            <!-- Breadcrumb -->
          
            <div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
                <div class="card">
                    <div class="card-header">

                        <h2><i class="fa fa-credit-card-alt fa-1x"></i>&nbsp;&nbsp;Medios de Pago</h2><br/>

                        
                        <button class="btn btn-success btn-lg" type="button" data-toggle="modal" data-target="#abrirmodalEditar" style="border-radius: 0.5em;">
                            <i class="fa fa-plus fa-1x"></i>&nbsp;&nbsp;Agregar Medio de Pago
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive" >
                            <table id="medios" class="table table-bordered table-striped table-sm">
                                <thead>
                                    <tr class="bg-primary">
                                        <th>Nº</th>
                                        <th>Titular</th>
                                        <th>nombre</th>
                                        <th>Numero</th>
                                        <th>Moneda</th>
                                        <th>Descripcion</th>
                                        <th>Estado</th>
                                        <th>editar</th>
                                        <th><i class="fa fa-trash fa-1x"></i></th>
                                    </tr>
                                </thead>
                                <tbody>
                                @php $cont=1 @endphp
                                @foreach($medios as $med)
                                
                                    <tr>
                                        <td> {{$cont}}</td>
                                        <td class="nombre">{{$med->nombre}}<input type="hidden" name="id_med" id="id_med" class="id_med" value="{{$med->id}}"></td>                                        
                                        <td  class="banco">{{$med->banco}}</td>
                                        <td  class="numero">{{$med->numero}}</td>
                                        <td  class="moneda">{{$med->moneda}}</td>
                                        <td  class="descripcion">{{$med->descripcion}}</td>
                                        <td  class="estado">
                                            @if($med->estado)
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
                                        <a class="edit" data-toggle="modal" data-id_categoria="'$med->id'"  data-target="#abrirmodal">
                                            <button type="button" class="btn btn-info btn-sm" >
                                                <i class="fa fa-edit fa-1x"></i>
                                            </button> </a>&nbsp;
                                        </td>

                                        <td>
                                            <a href="deletemedio/{{$med->id}}">
                                            <button type="button" class="btn btn-danger btn-sm">
                                            <i class="fa fa-times fa-1x"></i>
                                            </button> </a>&nbsp;
                                        </td>
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

            <form id="delete-form" action="{{route('medio.destroy','test')}}" method="POST" autocomplete="off">
                         {{method_field('delete')}}
                         {{csrf_field()}} 

                            <input type="hidden" id="id_enviar" name="id_enviar" value="">
            </form>
            <!--Inicio del modal agregar-->
            <div class="modal fade" id="abrirmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Actualizar Medio de Pagos</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                        </div>
                       
                        <div class="modal-body">
                            <form action="{{route('medio.update','test')}}" method="post" class="form-horizontal" enctype="multipart/form-data" autocomplete="off">
                                
                            {{method_field('patch')}}

                                {{csrf_field()}}

                                <input type="hidden" id="id_medio2" name="id_medio2" value="">
                                @include('medio.form')

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
                            <h4 class="modal-title">Agregar Medio de Pago</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                        </div>
                       
                        <div class="modal-body">
                            
                            <form action="{{route('medio.store')}}" method="post" class="form-horizontal" enctype="multipart/form-data" autocomplete="off" >
                                {{csrf_field()}}
                                @include('medio.form')

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
        $('#medios').DataTable({
            "lengthMenu":[[10,25,50,-1],[10,25,50,"Todos"]]
        });
    } );
</script>

<script>        
        $(document).on('click', '.edit', function()
        {
            var _this = $(this).parents('tr');
            $('#id_medio2').val(_this.find('.id_med').val());
            $('#nombre').val(_this.find('.nombre').text());
            $('#banco').val(_this.find('.banco').text());
            $('#numero').val(_this.find('.numero').text());
            $('#moneda').val(_this.find('.moneda').text());
            $('#descripcion').val(_this.find('.descripcion').text());

            $('#moneda').selectpicker('refresh');

        });
        
        
        $(document).on('click', '.edit2', function()
    {
        var _this = $(this).parents('tr');
        $('#id_enviar').val(_this.find('.id_med').val());
        event.preventDefault();
        document.getElementById('delete-form').submit();
    });
</script>  


@endpush

@endsection