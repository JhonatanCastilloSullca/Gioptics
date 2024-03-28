@extends('home')
@section('contenido')
<main class="main">
            <!-- Breadcrumb -->
            <div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
                <div class="card">
                    <div class="card-header" style="vertical-align: middle;">
                        <h2 ><i class="fa fa-check-square-o fa-1x" ></i>&nbsp;&nbsp;Historial de PAcientes</h2><br/>
                    
                    </div>
                    <div class="card-body">
                        <div class="table-responsive" >
                            <table id="medidas" class="table table-bordered table-striped table-sm">
                                <thead>
                                    <tr class="bg-primary">
                                        <th>Paciente</th>
                                        <th>Tipo de Documento</th>
                                        <th>Numero de Documento</th>
                                        <th>Especialista</th>
                                        <th>Ultima Medicion</th>
                                        <th>Ver</th>
                                    </tr>
                                </thead>
                                <tbody>

                                @foreach($medidas as $med)
                                
                                    <tr>
                                        
                                        <td class="nombre">{{$med->paciente}}</td>      
                                        <td class="nombre">{{$med->tipo_documento}}</td>                                        
                                        <td class="codigo">{{$med->num_documento}}</td>
                                        <td class="codigo">{{$med->usuario}} {{$med->apellido}}</td>
                                        <td class="codigo">{{date("d/m/Y", strtotime($med->fecha))}}</td>
                                        <td >
                                            <a href="{{URL::action('App\Http\Controllers\MedidaController@show',$med->idPaciente)}}" > 
                                                <button class="btn btn-success " type="button" style="border-radius: 0.5em;font-size: 1rem">
                                                    <i class="fa fa-eye fa-1x"></i>
                                                </button>
                                            </a>
                                        </td>
                                    </tr>

                                    @endforeach
                                
                                </tbody>
                            </table>
                        </div>
                    </div>

                    </div>
                    
                    <button type="reset" class="btn btn-danger btn-sm">
                    <a class="nav-link" href="{{url('medida')}}" onclick="event.preventDefault(); document.getElementById('medida-form').submit();" style="color:#ffffff">VOLVER A PENDIENTES</a>
                            
                            <form id="medida-form" action="{{url('medida')}}" method="GET" style="display: none">
                            {{csrf_field()}} 
                            </form>
                  </button>
                <!-- Fin ejemplo de tabla Listado -->
                </div>
            
            <!--Inicio del modal actualizar-->
            <div class="modal fade" id="abrirmodalPaciente" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Agregar Paciente</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                    
                        <div class="modal-body">
                            
                            <form action="{{route('medida.store')}}" method="post" class="form-horizontal" enctype="multipart/form-data" autocomplete="off" >
                                {{csrf_field()}}
                                @include('medida.form')

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
    $('#abrirmodalPaciente').modal('show');
});
</script>       
@endif   
<script>     
    $(document).ready(function() {
        $('#medidas').DataTable({
            "lengthMenu":[[10,25,50,-1],[10,25,50,"Todos"]]
        });
    } );
</script>

<script>        
        $(document).on('click', '.edit', function()
        {
            var _this = $(this).parents('tr');
            $('#id_medida2').val(_this.find('.id_med').val());
            $('#nombre').val(_this.find('.nombre').text());
            $('#tipo_documento').val(_this.find('.tipo_documento').text());
            $('#num_documento').val(_this.find('.num_documento').text());
            $('#direccion').val(_this.find('.direccion').text());
            $('#celular').val(_this.find('.celular').text());        
            $('#email').val(_this.find('.email').text());
            $('#num_cuenta').val(_this.find('.num_cuenta').text());
            $('#descripcion').val(_this.find('.descripcion').text());
            $('#estado').val(_this.find('.estado').text());

            $('#tipo_documento').selectpicker('refresh');
        });
        
        
    $(document).on('click', '.edit2', function()
    {
        var _this = $(this).parents('tr');
        $('#id_enviar').val(_this.find('.id_med').val());
    });
</script>  


@endpush

@endsection