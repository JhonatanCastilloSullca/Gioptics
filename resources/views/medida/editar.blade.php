@extends('home')
@section('contenido')
<main class="main">
            <!-- Breadcrumb -->

            <div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
                <div class="card">
                    <div class="card-header">
                    @foreach($paciente as $paciente)
                       <h2><i class="fa fa-eye fa-1x"></i> &nbsp;Ingresar Medidasa: {{$paciente->nombre}} </h2><br/>
                       <p><b>Numero Documento: </b>{{$paciente->num_documento}} </p> <p><b>Edad: </b>{{$paciente->edad}} </p> <p><b>Ocupacion: </b>{{$paciente->ocupacion}} </p> <p><b>Celular: </b>{{$paciente->celular}} </p> <p><b>Fecha de Nacimiento: </b>{{$paciente->fecha_nac}} </p> <p><b>Email: </b>{{$paciente->email}} </p>
                     @endforeach

                    </div>
                    <form action="{{route('guardareditar','test')}}" method="POST" class="form-horizontal" enctype="multipart/form-data">
                        {{method_field('patch')}}
                        {{csrf_field()}}
                        @foreach($medidas as $med)
                            <input type="hidden" name="id_enviar"  name="id_enviar" value="{{$med->id}}">

                            <input type="hidden" name="idPaciente"  name="idPaciente" value="{{$med->idPaciente}}">

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
                                                <td>Para vision de lejos</td>
                                                <td>
                                                    <input class="inputmedida" type="text"  id="odvle" name="odvle" placeholder="" value="{{$med->odvle}}">
                                                    @error('odvle')
                                                        <span class="error-message" style="color:red">{{ $message }}</span>
                                                    @enderror
                                                </td>
                                                <td>
                                                    <input class="inputmedida" type="text"  id="odvlc" name="odvlc" placeholder="" value="{{$med->odvlc}}">
                                                    @error('odvlc')
                                                        <span class="error-message" style="color:red">{{ $message }}</span>
                                                    @enderror
                                                </td>

                                                <td>
                                                    <input class="inputmedida" type="text"  id="odvleje" name="odvleje" placeholder=""  value="{{$med->odvleje}}">
                                                    @error('odvleje')
                                                        <span class="error-message" style="color:red">{{ $message }}</span>
                                                    @enderror
                                                </td>
                                                <td>
                                                    <input class="inputmedida" type="text"  id="oivle" name="oivle" placeholder=""  value="{{$med->oivle}}">
                                                    @error('oivle')
                                                        <span class="error-message" style="color:red">{{ $message }}</span>
                                                    @enderror
                                                </td>
                                                <td>
                                                    <input class="inputmedida" type="text"  id="oivlc" name="oivlc" placeholder="" value="{{$med->oivlc}}">
                                                    @error('oivlc')
                                                        <span class="error-message" style="color:red">{{ $message }}</span>
                                                    @enderror
                                                </td>
                                                <td>
                                                    <input class="inputmedida" type="text"  id="oivleje" name="oivleje" placeholder="" value="{{$med->oivleje}}">
                                                    @error('oivleje')
                                                        <span class="error-message" style="color:red">{{ $message }}</span>
                                                    @enderror
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Para vision de cerca</td>
                                                <td>
                                                    <input class="inputmedida" type="text"  id="odvce" name="odvce" placeholder="" value="{{$med->odvce}}">
                                                    @error('odvce')
                                                        <span class="error-message" style="color:red">{{ $message }}</span>
                                                    @enderror
                                                </td>
                                                <td>
                                                    <input class="inputmedida" type="text"  id="odvcc" name="odvcc" placeholder="" value="{{$med->odvcc}}">
                                                    @error('odvcc')
                                                        <span class="error-message" style="color:red">{{ $message }}</span>
                                                    @enderror
                                                </td>

                                                <td>
                                                    <input class="inputmedida" type="text"  id="odvceje" name="odvceje" placeholder="" value="{{$med->odvceje}}">
                                                    @error('odvceje')
                                                        <span class="error-message" style="color:red">{{ $message }}</span>
                                                    @enderror
                                                </td>
                                                <td>
                                                    <input class="inputmedida" type="text"  id="oivce" name="oivce" placeholder="" value="{{$med->oivce}}">
                                                    @error('oivce')
                                                        <span class="error-message" style="color:red">{{ $message }}</span>
                                                    @enderror
                                                </td>
                                                <td>
                                                    <input class="inputmedida" type="text"  id="oivcc" name="oivcc" placeholder=""  value="{{$med->oivcc}}">
                                                    @error('oivcc')
                                                        <span class="error-message" style="color:red">{{ $message }}</span>
                                                    @enderror
                                                </td>
                                                <td>
                                                    <input class="inputmedida" type="text"  id="oivceje" name="oivceje" placeholder=""  value="{{$med->oivceje}}">
                                                    @error('oivceje')
                                                        <span class="error-message" style="color:red">{{ $message }}</span>
                                                    @enderror
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>DIP</td>
                                                <td>
                                                    <input class="inputmedida" type="text"  id="dip" name="dip" value="{{$med->dip}}">
                                                    @error('dip')
                                                        <span class="error-message" style="color:red">{{ $message }}</span>
                                                    @enderror
                                                </td>
                                                <td rowspan="2">Indicaciones</td>
                                                <td colspan="4" rowspan="2">

                                                    <textarea style="text-align-last: left;" class="inputmedida"  id="indicaciones" name="indicaciones" style="height: 80px;">{{$med->indicaciones}}</textarea>
                                                    @error('indicaciones')
                                                        <span class="error-message" style="color:red">{{ $message }}</span>
                                                    @enderror

                                                </td>
                                            </tr>
                                            <tr>
                                                <td>ADD</td>
                                                <td>
                                                    <input class="inputmedida" type="text"  id="add" name="add" value="{{$med->add}}">
                                                    @error('add')
                                                        <span class="error-message" style="color:red">{{ $message }}</span>
                                                    @enderror
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>

                                </div>

                                <div class="col-md" style="text-align: right;" >
                                    <button type="submit" class="btn btn-success btncreate"><i class="fa fa-save fa-1x"></i> GUARDAR</button>
                                    <button type="button" class="btn btn-danger" style="border-radius:0.7em;">
                                        <a href="{{url('medida')}}" onclick="event.preventDefault(); document.getElementById('medida-form').submit();" style="color:#ffffff"><i class="fa fa-times fa-1x"></i> CANCELAR</a>
                                        <form id="medida-form" action="{{url('medida')}}" method="GET" style="display: none">
                                        {{csrf_field()}}
                                        </form>
                                    </button>
                                </div>

                            </div>
                        </form>
                        @endforeach
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
