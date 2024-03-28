@extends('home')
@section('contenido')
<main class="main">
            <!-- Breadcrumb -->
            <div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
                <div class="card">
                    <div class="card-header">
                        <h2><i class="fa fa-plus fa-1x"></i>&nbsp;&nbsp;Agregar Paciente</h2><br/>
                    </div>
                    <div class="card-body">
                        <div id="mostrar">
                        {!!Form::open(array('url'=>'buscar','method'=>'GET','autocomplete'=>'off','role'=>'search'))!!}
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="dni">Buscar PAciente</label >
                                <div class="col-md-9">
                                    <span class="input-group-btn">
                                        <input type="text" id="buscarTexto" name="buscarTexto" class="form-control typeahead" placeholder="Ingrese Nombre para buscar" value="{{$buscarTexto}}">
                                        <button type="submit" style="margin-left: 10px;" class="btn btn-success"><i class="fa fa-search"></i> Buscar</button>
                                    </span>
                                </div>
                            </div>
                        {{Form::close()}}
                            <form action="{{route('medida.store')}}" method="post" class="form-horizontal" enctype="multipart/form-data" autocomplete="off" >
                            {{csrf_field()}}
                            @if(count($pacientes)>=1)
                                @foreach($pacientes as $pas)
                                <div class="form-group row">
                                    <input type="hidden" value="{{$pas->id}}" id="id_paciente" name="id_paciente">
                                    <label class="col-md-3 form-control-label" for="dni">Tipo de documento</label>
                                    <div class="col-md-9">
                                        <select class="form-control selectpicker" name="tipo_documento" id="tipo_documento" data-live-search="true" >
                                            <option value="0" disabled >Seleccione</option>
                                            <option value="DNI" {{ $pas->tipo_documento == "DNI" ? 'selected' : '' }}>DNI</option>
                                            <option value="RUC" {{ $pas->tipo_documento == "RUC" ? 'selected' : '' }}>RUC</option>
                                            <option value="OTRO DOCUMENTO" {{ $pas->tipo_documento == "OTRO DOCUMENTO" ? 'selected' : '' }}>OTRO DOCUMENTO</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="dni">Número documento</label>
                                    <div class="col-md-9">
                                        <input type="text" value="{{$pas->num_documento}}" id="num_documento" name="num_documento" class="form-control" placeholder="Ingrese el número documento">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="nombre">Nombre</label>
                                    <div class="col-md-9">
                                        <input type="text" value="{{$pas->nombre}}"  id="nombre" name="nombre" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="dni">Edad</label>
                                    <div class="col-md-9">
                                        <input type="text" id="edad" name="edad" class="form-control" placeholder="Ingrese edad del Cliente" value="{{$pas->edad}}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="dni">Ocupación</label>
                                    <div class="col-md-9">
                                        <input type="text" id="ocupacion" name="ocupacion" class="form-control" placeholder="Ingrese la Ocupación" value="{{$pas->ocupacion}}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="celular">Celular</label>
                                    <div class="col-md-9">
                                        <input type="text" id="celular" name="celular" class="form-control " placeholder="Ingrese el celular" value="{{$pas->celular}}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="fecha_nac">Fecha Nacimiento</label>
                                    <div class="col-md-9">
                                        <input type="date" id="fecha_nac" name="fecha_nac" class="form-control" placeholder="Ingrese el Fecha" value="{{$pas->fecha_nac}}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="celular">Email</label>
                                    <div class="col-md-9">
                                        <input type="text" id="email" name="email" class="form-control" placeholder="Ingrese el Email" value="{{$pas->email}}">
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            @foreach($medidas as $med)
                            <div class="form-group row" style="padding:20px">
                                <div class="col-md-3">
                                    <label class="form-control-label" for="num_venta"><b>Fecha de Medición</b></label>

                                    <p>{{date("d/m/Y", strtotime($med->fecha))}}</p>
                                </div>
                                <div class="col-md-3">

                                    <label class="form-control-label" for="nombre"><b>Especialista</b></label>

                                    <p>{{$med->especialista}}</p>

                                </div>

                                <div class="col-md-3">

                                    <label class="form-control-label" for="documento"><b>TIENDA</b></label>

                                    <p>{{$med->sucursal}}</p>

                                </div>
                                <div class="col-md-3" style="TEXT-ALIGN-LAST: RIGHT">
                                    <a href="medidaeliminar/{{$med->id}}"><button type='button' style='font-size: 1rem;' class='btn btn-danger btn-sm'><i class='fa fa-times fa-1x'></i>&nbsp;ELIMINAR</button></a>
                                </div>
                            </div>
                            <div class="table-responsive col-md-12" style="padding-bottom: 20px;">
                                <table id="medidas" class="table table-bordered table-striped table-sm" style="text-align-last: center;vertical-align: middle;">
                                    <tbody>
                                        <tr class="bg-primary">
                                            <td colspan="7">Medidas Oftalmologicas</td>
                                        </tr>
                                        <tr class="bg-secondary">
                                            <td rowspan="2"></td>
                                            <td colspan="3">Ojo Derecho</td>
                                            <td colspan="3">Ojo Izquierdo</td>
                                        </tr>
                                        <tr class="bg-secondary">
                                            <td>Esferico</td>
                                            <td>Cilindro</td>
                                            <td>Eje</td>
                                            <td>Esferico</td>
                                            <td>Cilindro</td>
                                            <td>Eje</td>
                                        </tr>
                                        <tr>
                                            <td>Para visión de lejos</td>
                                            <td>
                                                {{$med->odvle}}
                                            </td>
                                            <td>
                                                {{$med->odvlc}}
                                            </td>

                                            <td>
                                                {{$med->odvleje}}
                                            </td>
                                            <td>
                                                {{$med->oivle}}
                                            </td>
                                            <td>
                                                {{$med->oivlc}}
                                            </td>
                                            <td>
                                                {{$med->oivleje}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Para visión de cerca</td>
                                            <td>
                                                {{$med->odvce}}
                                            </td>
                                            <td>
                                                {{$med->odvcc}}
                                            </td>

                                            <td>
                                                {{$med->odvceje}}
                                            </td>
                                            <td>
                                                {{$med->oivce}}
                                            </td>
                                            <td>
                                                {{$med->oivcc}}
                                            </td>
                                            <td>
                                                {{$med->oivceje}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>DIP</td>
                                            <td>
                                                {{$med->dip}}
                                            </td>
                                            <td rowspan="2" style="vertical-align:middle">Indicaciones</td>
                                            <td colspan="4" rowspan="2">
                                                {{$med->indicaciones}}

                                            </td>
                                        </tr>
                                        <tr>
                                            <td>ADD</td>
                                            <td>
                                                {{$med->add}}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            @endforeach
                        @else
                                <div class="form-group row">

                                    <label class="col-md-3 form-control-label" for="dni">Tipo de documento</label>
                                    <div class="col-md-9">
                                        <select class="form-control selectpicker" name="tipo_documento" id="tipo_documento" data-live-search="true" >
                                            <option value="0" disabled >Seleccione</option>
                                            <option value="DNI" {{ old('tipo_documento') == "DNI" ? 'selected' : '' }}>DNI</option>
                                            <option value="RUC" {{ old('tipo_documento') == "RUC" ? 'selected' : '' }}>RUC</option>
                                            <option value="OTRO DOCUMENTO" {{ old('tipo_documento') == "OTRO DOCUMENTO" ? 'selected' : '' }}>OTRO DOCUMENTO</option>
                                        </select>
                                        @error('tipo_documento')
                                            <span class="error-message" style="color:red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                @livewire('enviar-dni',['title'=>'Este es un titulo de'])
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="dni">Edad</label>
                                    <div class="col-md-9">
                                        <input type="text" id="edad" name="edad" class="form-control" placeholder="Ingrese edad del Cliente" value="{{old('edad')}}">

                                        @error('edad')
                                            <span class="error-message" style="color:red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="dni">Ocupación</label>
                                    <div class="col-md-9">
                                        <input type="text" id="ocupacion" name="ocupacion" class="form-control" placeholder="Ingrese la Ocupación" value="{{old('ocupacion')}}">

                                        @error('ocupacion')
                                            <span class="error-message" style="color:red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="celular">Celular</label>
                                    <div class="col-md-9">

                                        <input type="text" id="celular" name="celular" class="form-control " placeholder="Ingrese el celular" value="{{old('celular')}}">
                                        @error('celular')
                                            <span class="error-message" style="color:red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="fecha_nac">Fecha Nacimiento</label>
                                    <div class="col-md-9">

                                        <input type="date" id="fecha_nac" name="fecha_nac" class="form-control" placeholder="Ingrese el Fecha" value="{{old('fecha_nac')}}">
                                        @error('fecha_nac')
                                            <span class="error-message" style="color:red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="celular">Email</label>
                                    <div class="col-md-9">
                                        <input type="text" id="email" name="email" class="form-control" placeholder="Ingrese el Email" value="{{old('email')}}">
                                        @error('email')
                                            <span class="error-message" style="color:red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                            </div>
                        @endif
                        <button type="submit" class="btn btn-success" style="border-radius:0.7em;"><i class="fa fa-save fa-1x"></i> &nbsp; ACEPTAR</button>

                        <button type="button" class="btn btn-danger" style="border-radius:0.7em;">
                            <a href="{{url('medida/create')}}" onclick="event.preventDefault(); document.getElementById('medida-create-form').submit();" style="color:#ffffff"><i class="fa fa-times fa-1x"></i> CANCELAR</a>
                            <form id="medida-create-form" action="{{url('medida/create')}}" method="GET" style="display: none">
                            {{csrf_field()}}
                            </form>
                        </button>
                    </form>
                    </div>

                    </div>

                <!-- Fin ejemplo de tabla Listado -->
                </div>


        </main>



@push('scripts')
<script>

$(document).on('click', '.edit', function()
{
    $('#mostrar').show();
    $('#combo').hide();
    $("#idPaciente option[value='0']").attr("selected", true);
    $('#idPaciente').selectpicker('refresh');
    $('#tipo_documento').selectpicker('refresh');
});

var path = "{{ route('autocomplete') }}";
    $('input.typeahead').typeahead({
        source:  function (query, process) {
        return $.get(path, { query: query }, function (data) {
                return process(data);
                document.getElementById('delete-form').submit();
            });
        }
    });
</script>

@endpush

@endsection
