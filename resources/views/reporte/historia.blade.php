@extends('home')
@section('contenido')
<main class="main">
    <div class="container-fluid">
    <!-- Ejemplo de tabla Listado -->
        <div class="card">
            <div class="card-header">
                <h2><i class="fa fa-book fa-1x"></i>&nbsp;&nbsp;Reporte de Historia</h2><br/>                      
            </div>
            <div class="card-body">                        

                {!!Form::open(array('url'=>'historia','method'=>'GET','autocomplete'=>'off','role'=>'search'))!!}
                <div class="form-group row">
                    <div class="col-md-1">
                        <label style="padding-top: 10px"><strong> Fecha </strong></label>
                    </div>
                    <div class="col-md-6">
                        <div class="input-group" id="buscarFecha">
                            <input type="date" id="buscarFechaInicio" name="buscarFechaInicio" class="form-control" placeholder="Fecha Inicio" value="{{$sql2}}">
                            <label style="padding-top: 10px"><strong> &nbsp;&nbsp; / &nbsp;&nbsp;</strong></label>
                            <input type="date" id="buscarFechaFin" name="buscarFechaFin" class="form-control" placeholder="Fecha Fin" value="{{$sql3}}">
                        </div>
                    </div>
                    <div class="col-md-5">
                    </div>
                    <br></br><br>
                    <div class="col-md-1">
                        <label style="padding-top: 7px"><strong> Especilista </strong></label>
                    </div>
                    <div class="col-md-3">
                        <div id="buscarProyecto1">
                            <select class="form-control selectpicker" id="buscarUsuario" name="buscarUsuario"  data-live-search="true">
                                <option value="0">Todos</option>
                                @foreach($usuarios as $use)
                                    <option value="{{$use->id}}">{{$use->nombre}}</option>
                                @endforeach
                            </select>      
                        </div>
                        <br>
                    </div>
                    <div class="col-md-1">
                        <label style="padding-top: 7px"><strong> Tienda </strong></label>
                    </div>
                    <div class="col-md-3">
                        <div id="buscarProyecto1">
                            <select class="form-control selectpicker" id="buscarSucursal" name="buscarSucursal"  data-live-search="true">
                                <option value="0">Todos</option>
                                @foreach($sucursales as $suc)
                                    <option value="{{$suc->id}}">{{$suc->nombre}}</option>
                                @endforeach
                            </select>  
                        </div>
                        <br>
                    </div>
                    <div class="col-md-4">
                    </div>
                    <br></br><br>
                    <div class="col-md-1">
                        <label style="padding-top: 7px"><strong> Paciente </strong></label>
                    </div>
                    <div class="col-md-3">
                        <div id="buscarProyecto1">
                            <select class="form-control selectpicker" id="buscarPaciente" name="buscarPaciente"  data-live-search="true">
                                <option value="0">Todos</option>
                                @foreach($paciente as $pac)
                                    <option value="{{$pac->id}}">{{$pac->nombre}}</option>
                                @endforeach
                            </select>  
                        </div>
                        <br>
                    </div>
                    <div class="col-md-1">
                        <div class="input-group">
                            <button type="submit"  id="buscar" class="btn btn-success"><i class="fa fa-search"></i> Buscar</button>
                        </div>
                        {{Form::close()}} 
                    </div>
                    @php $sql=[$sql2,$sql4,$sql5,$sql6,$sql7]; @endphp
                            
                    <div class="col-md-3">
                        
                        <a href="{{url('historiapdf',$sql)}}" target="_blank">
                            <button type="button" class="btn btn-danger " style='text-align:right;border-radius: 0.7em;'>
                                <i class="fa fa-file"></i>&nbsp;&nbsp;Reporte PDF
                            </button>

                        </a>&nbsp;&nbsp;
                        <a href="{{url('historiaexcel',$sql)}}" target="_blank">
                            <button type="button" class="btn btn-success " style='text-align:right'>
                                <i class="fa fa-file"></i>&nbsp;&nbsp;Reporte Excel
                            </button>

                        </a>
                        
                    </div>
                </div>
                <div style="height: 500px;overflow-x:auto;overflow-y:auto;">
                    <div class="table-responsive" >
                        
                        <table id="reservas" class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr class="bg-primary">
                                    <th>fecha</th>
                                    <th>Paciente</th>
                                    <th>Optometra</th>
                                    <th>Sucursal</th>
                                    <th>Ver</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($historias as $his)
                                <tr>
                                    <td>{{date("d/m/Y", strtotime($his->fecha))}}</td>
                                    <td>{{$his->paciente}}</td>
                                    <td>{{$his->usuario}}</td>
                                    <td>{{$his->sucursal}}</td>
                                    <td>
                                        <a href="{{URL::action('App\Http\Controllers\MedidaController@show',$his->id)}}" > 
                                            <button type="button" class="btn btn-danger btn-md">
                                            <i class="fa fa-eye fa-1x"></i>
                                            </button>
                                        </a>
                                        <input type="hidden" name="id_enviar" id="id_enviar" class="id_enviar" >
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- Fin ejemplo de tabla Listado -->
    </div>
            
</main>


@push('scripts')
<script>
    
    $(document).on('click', '.edit', function()
        {
            var _this = $(this).parents('tr');
            $('#id_detalle2').val(_this.find('.id_detalle_1').val());
            $('#saldo').val(_this.find('.saldo').text());
            
        });
        
</script>


@endpush

@endsection