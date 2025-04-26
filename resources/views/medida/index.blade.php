@extends('home')
@section('contenido')
<main class="main">
            <!-- Breadcrumb -->
          
            <div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
                <div class="card">
                    <div class="card-header">
                        <h2><i class="fa fa-circle-o-notch fa-1x"></i>&nbsp;&nbsp;Listado de Medidas Pendientes</h2><br/>                      
                       
                    </div>
                    <div class="card-body">
                        <div class="table-responsive" >
                            <table id="medidas" class="table table-bordered table-striped table-sm">
                                <thead>
                                    <tr class="bg-primary">
                                        <th>N°</th>
                                        <th>Paciente</th>
                                        <th>Tipo de Documento</th>
                                        <th>Numero de Documento</th>
                                        <th>Vendedor</th>
                                        <th>Agregar</th>
                                        <th>Eliminar</th>
                                    </tr>
                                </thead>
                                <tbody id="tablebody">

                                
                                
                                </tbody>
                            </table>
                        </div>
                    </div>

                    </div>
                    
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


window.axios.get('/medidasrealtime')
.then((response)=>{
        const MedidaElement = document.getElementById('tablebody');
        let medidas=response.data;
        cont=1;
        medidas.forEach((medida,index)=>{
            var ruta="/crearmedicion/"+medida.id;
            var ruta2="deletemedida/"+medida.id;
            var html="@if(Auth::user()->rol=='Especialista' || Auth::user()->rol=='Gerencia')<a href="+ruta+"><button class='btn btn-success' type='button ' style='border-radius: 0.5em;font-size: 1rem'><i class='fa fa-plus fa-1x'></i></button></a>@else<button class='btn btn-success' type='button' style='border-radius: 0.5em;font-size: 1rem;'><i class='fa fa-plus fa-1x' ></i></button>@endif";
            var html2="<a href="+ruta2+"><button type='button' style='border-radius: 0.5em;font-size: 1rem;' class='btn btn-danger'><i class='fa fa-times fa-1x'></i></button></a>";
            $('#medidas').DataTable().destroy();
            $('#medidas').find('tbody').append("<tr id='"+medida.id+"'><td>"+cont+"</td><td>"+medida.paciente+"</td><td>"+medida.tipo_documento+"</td><td>"+medida.num_documento+"</td><td>"+medida.usuario+"</td><td style='text-align:center;vertical-align:middle'>"+html+"</td><td style='text-align:center;vertical-align:middle'>"+html2+"</td></tr>");
            cont++;
            $('#medidas').DataTable().draw();
        });
        
});     

window.Echo.channel('medidacreate')
.listen('MedidaCreate',(e)=>{
    var ruta="/crearmedicion/"+e.medidas.id+"";
    var ruta2="deletemedida/"+e.medidas.id;
    var html="@if(Auth::user()->rol=='Especialista' || Auth::user()->rol=='Gerencia')<a href="+ruta+"><button class='btn btn-success' type='button' style='border-radius: 0.5em;font-size: 1rem;'><i class='fa fa-plus fa-1x'></i></button></a>@else<button class='btn  btn-success' type='button' style='border-radius: 0.5em;font-size: 1rem;'><i class='fa fa-plus fa-1x'></i></button>@endif";
    var html2="<a href="+ruta2+"><button type='button' style='border-radius: 0.5em;font-size: 1rem;' class='btn btn-danger'><i class='fa fa-times fa-1x'></i></button></a>";
    $('#medidas').DataTable().destroy();
    $('#medidas').find('tbody').append("<tr id='"+e.medidas.id+"'><td>"+cont+"</td><td>"+e.medidas.paciente+"</td><td>"+e.medidas.tipo_documento+"</td><td>"+e.medidas.num_documento+"</td><td>"+e.medidas.usuario+"</td><td style='text-align:center;vertical-align:middle'>"+html+"</td><td style='text-align:center;vertical-align:middle'>"+html2+"</td></tr>");
    cont++;
    $('#medidas').DataTable().draw();
})
.listen('MedidaUpdate',(e)=>{
    var myTable=$('#medidas').DataTable();
    myTable.row($('#'+e.medida+'')).remove().draw();
});


</script>  
@if(session('openPopup'))
    <script>
        window.open("{{ session('openPopup') }}", "_blank");
    </script>
    @endif

@endpush

@endsection