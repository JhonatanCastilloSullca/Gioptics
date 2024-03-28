<div class="form-group row" id="combo">
    <label class="col-md-3 form-control-label" for="nombre">Paciente</label>
    <div class="col-md-9">
        <span class="input-group-btn"> 
            <select class="form-control selectpicker" name="idPaciente" id="idPaciente" data-live-search="true" required>
                <option value="0">Seleccione</option>
                @foreach($pacientes as $pac)
                    <option value="{{$pac->id}}" {{ old('idPaciente') == $pac->id ? 'selected' : '' }}>{{$pac->nombre}}</option>
                @endforeach
            </select>
            <button  id="enviar_1" type="button" class="btn btn-default btn-primary btn-number edit" >
                <span class="fa fa-plus"></span>
            </button>
        </span>
    </div>
</div>
<div id="mostrar">
    <div class="form-group row">
        <label class="col-md-3 form-control-label" for="nombre">Nombre</label>
        <div class="col-md-9">
            <input type="text"  id="nombre" name="nombre" class="form-control" placeholder="Ingrese el Nombre" value="{{old('nombre')}}">
            @error('nombre')
                <span class="error-message" style="color:red">{{ $message }}</span>
            @enderror
        </div>
    </div>


    <div class="form-group row">
        <label class="col-md-3 form-control-label" for="dni">Tipo de documento</label>
        <div class="col-md-9">
            <select class="form-control selectpicker" name="tipo_documento" id="tipo_documento" data-live-search="true" >
                <option value="0" selected >Seleccione</option>
                <option value="DNI" {{ old('tipo_documento') == "DNI" ? 'selected' : '' }}>DNI</option>
                <option value="RUC" {{ old('tipo_documento') == "RUC" ? 'selected' : '' }}>RUC</option>
            </select>
            @error('tipo_documento')
                <span class="error-message" style="color:red">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="form-group row">
        <label class="col-md-3 form-control-label" for="dni">Número documento</label>
        <div class="col-md-9">
            <input type="text" id="num_documento" name="num_documento" class="form-control" placeholder="Ingrese el número documento" value="{{old('num_documento')}}">
        
            @error('num_documento')
                <span class="error-message" style="color:red">{{ $message }}</span>
            @enderror
        </div>
    </div>

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
        <label class="col-md-3 form-control-label" for="celular">Celular</label>
        <div class="col-md-9">
        
            <input type="text" id="celular" name="celular" class="form-control" placeholder="Ingrese el celular" value="{{old('celular')}}">
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
    <div class="form-group row">
        <label class="col-md-3 form-control-label" for="dni">Ocupación</label>
        <div class="col-md-9">
            <input type="text" id="ocupacion" name="ocupacion" class="form-control" placeholder="Ingrese la Ocupación" value="{{old('ocupacion')}}">
        
            @error('ocupacion')
                <span class="error-message" style="color:red">{{ $message }}</span>
            @enderror
        </div>
    </div>
</div>




<div class="modal-footer">
        <button type="submit" class="btn btn-success" style="border-radius:0.7em;"><i class="fa fa-save fa-1x"></i> Guardar</button>
        <button type="button" class="btn btn-danger" style="border-radius:0.7em;" data-dismiss="modal"><i class="fa fa-times fa-1x"></i> Cerrar</button>
    
</div>

@push('scripts')
<script>
$('#mostrar').hide();

$(document).on('click', '.edit', function()
{
    $('#mostrar').show();
    $('#combo').hide();
    $("#idPaciente option[value='0']").attr("selected", true);
    $('#idPaciente').selectpicker('refresh');
    $('#tipo_documento').selectpicker('refresh');
});
</script>
@endpush