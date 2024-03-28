@extends('home')
@section('contenido')
<main class="main">
            <!-- Breadcrumb -->

            <div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
                <div class="card">
                    <div class="card-header">
                    @foreach($paciente as $paciente)
                        <h2><i class="fa fa-eye fa-1x"></i> &nbsp;Ingresar Medidas: {{$paciente->nombre}} </h2><br/>
                        <p><b>Numero Documento: </b>{{$paciente->num_documento}} </p> <p><b>Edad: </b>{{$paciente->edad}} </p> <p><b>Ocupacion: </b>{{$paciente->ocupacion}} </p> <p><b>Celular: </b>{{$paciente->celular}} </p> <p><b>Fecha de Nacimiento: </b>{{$paciente->fecha_nac}} </p> <p><b>Email: </b>{{$paciente->email}} </p>
                    @endforeach


                    <form action="{{route('medida.update','test')}}" method="POST" class="form-horizontal" enctype="multipart/form-data">

                    <div class="form-group row justify-content-end" >
                        <div class="col-md-3" id="acuenta2">
                            <label class="form-control-label" for="impuesto">Fecha</label>
                            <input type="date" id="fechamedicion" name="fechamedicion" class="form-control" value="{{ $fechamedicion }}">
                        </div>
                    </div>

                    </div>
                        {{method_field('patch')}}
                        {{csrf_field()}}
                        @foreach($medidas as $med)
                            <input type="hidden" name="id_enviar"  name="id_enviar" value="{{$med->id}}">
                        @endforeach
                            <div class="form-group row">
                                <div class="table-responsive col-md-12">
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
                                                    <input class="inputmedida" type="text"  id="odvle" name="odvle" placeholder="" value="{{old('odvle')}}">
                                                    @error('odvle')
                                                        <span class="error-message" style="color:red">{{ $message }}</span>
                                                    @enderror
                                                </td>
                                                <td>
                                                    <input class="inputmedida" type="text"  id="odvlc" name="odvlc" placeholder="" value="{{old('odvlc')}}">
                                                    @error('odvlc')
                                                        <span class="error-message" style="color:red">{{ $message }}</span>
                                                    @enderror
                                                </td>

                                                <td>
                                                    <input class="inputmedida" type="text"  id="odvleje" name="odvleje" placeholder=""  value="{{old('odvleje')}}">
                                                    @error('odvleje')
                                                        <span class="error-message" style="color:red">{{ $message }}</span>
                                                    @enderror
                                                </td>
                                                <td>
                                                    <input class="inputmedida" type="text"  id="oivle" name="oivle" placeholder=""  value="{{old('oivle')}}">
                                                    @error('oivle')
                                                        <span class="error-message" style="color:red">{{ $message }}</span>
                                                    @enderror
                                                </td>
                                                <td>
                                                    <input class="inputmedida" type="text"  id="oivlc" name="oivlc" placeholder="" value="{{old('oivlc')}}">
                                                    @error('oivlc')
                                                        <span class="error-message" style="color:red">{{ $message }}</span>
                                                    @enderror
                                                </td>
                                                <td>
                                                    <input class="inputmedida" type="text"  id="oivleje" name="oivleje" placeholder="" value="{{old('oivleje')}}">
                                                    @error('oivleje')
                                                        <span class="error-message" style="color:red">{{ $message }}</span>
                                                    @enderror
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Para visión de cerca</td>
                                                <td>
                                                    <input class="inputmedida" type="text"  id="odvce" name="odvce" placeholder="" value="{{old('odvce')}}">
                                                    @error('odvce')
                                                        <span class="error-message" style="color:red">{{ $message }}</span>
                                                    @enderror
                                                </td>
                                                <td>
                                                    <input class="inputmedida" type="text"  id="odvcc" name="odvcc" placeholder="" value="{{old('odvcc')}}">
                                                    @error('odvcc')
                                                        <span class="error-message" style="color:red">{{ $message }}</span>
                                                    @enderror
                                                </td>

                                                <td>
                                                    <input class="inputmedida" type="text"  id="odvceje" name="odvceje" placeholder="" value="{{old('odvceje')}}">
                                                    @error('odvceje')
                                                        <span class="error-message" style="color:red">{{ $message }}</span>
                                                    @enderror
                                                </td>
                                                <td>
                                                    <input class="inputmedida" type="text"  id="oivce" name="oivce" placeholder="" value="{{old('oivce')}}">
                                                    @error('oivce')
                                                        <span class="error-message" style="color:red">{{ $message }}</span>
                                                    @enderror
                                                </td>
                                                <td>
                                                    <input class="inputmedida" type="text"  id="oivcc" name="oivcc" placeholder=""  value="{{old('oivcc')}}">
                                                    @error('oivcc')
                                                        <span class="error-message" style="color:red">{{ $message }}</span>
                                                    @enderror
                                                </td>
                                                <td>
                                                    <input class="inputmedida" type="text"  id="oivceje" name="oivceje" placeholder=""  value="{{old('oivceje')}}">
                                                    @error('oivceje')
                                                        <span class="error-message" style="color:red">{{ $message }}</span>
                                                    @enderror
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>DIP</td>
                                                <td>
                                                    <input class="inputmedida" type="text"  id="dip" name="dip" value="{{old('dip')}}">
                                                    @error('dip')
                                                        <span class="error-message" style="color:red">{{ $message }}</span>
                                                    @enderror
                                                </td>
                                                <td rowspan="2">Indicaciones</td>
                                                <td colspan="4" rowspan="2">

                                                    <textarea style="text-align-last: left;" class="inputmedida"  id="indicaciones" name="indicaciones" style="height: 80px;">{{old('indicaciones')}}</textarea>
                                                    @error('indicaciones')
                                                        <span class="error-message" style="color:red">{{ $message }}</span>
                                                    @enderror

                                                </td>
                                            </tr>
                                            <tr>
                                                <td>ADD</td>
                                                <td>
                                                    <input class="inputmedida" type="text"  id="add" name="add" value="{{old('add')}}">
                                                    @error('add')
                                                        <span class="error-message" style="color:red">{{ $message }}</span>
                                                    @enderror
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>

                                </div>

                                <div class="col-md" style="text-align: right;" >
                                    <button type="submit" class="btn btn-success btncreate"><i class="fa fa-save fa-1x"></i> Registrar</button>
                                    <button type="button" class="btn btn-danger" style="border-radius:0.7em;">
                                        <a href="{{url('medida')}}" onclick="event.preventDefault(); document.getElementById('medida-form').submit();" style="color:#ffffff"><i class="fa fa-times fa-1x"></i> CANCELAR</a>
                                        <form id="medida-form" action="{{url('medida')}}" method="GET" style="display: none">
                                        {{csrf_field()}}
                                        </form>
                                    </button>
                                </div>

                            </div>
                        </form>
                        @if(count($medidasanteriores)>0)
                                @foreach($medidasanteriores as $med)
                            <div class="form-group row" style="padding:20px">
                                <div class="col-md-3">
                                    <label class="form-control-label" for="num_venta"><b>Fecha de Medicion</b></label>

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
                                            <td>Para vision de lejos</td>
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
                                            <td>Para vision de cerca</td>
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
                            @endif
                </div>
                <!-- Fin ejemplo de tabla Listado -->
            </div>
        </main>


@push('scripts')

@if(!empty(Session::get('error_code')) && Session::get('error_code') == 5)
<script>

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
            $('#nombre').val(_this.find('.  ').text());
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
