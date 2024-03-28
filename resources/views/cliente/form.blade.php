<div class="form-group row">
    <label class="col-md-3 form-control-label" for="dni">Tipo de documento</label>
    <div class="col-md-9">
        <select class="form-control selectpicker" name="tipo_documento" id="tipo_documento" data-live-search="true" >
            <option value="DNI" {{ old('tipo_documento') == "DNI" ? 'selected' : '' }}>DNI</option>
            <option value="RUC" {{ old('tipo_documento') == "RUC" ? 'selected' : '' }}>RUC</option>
        </select>
        @error('tipo_documento')
            <span class="error-message" style="color:red">{{ $message }}</span>
        @enderror
    </div>
</div>
@livewire('enviar-dni',['title'=>'Este es un titulo de'])

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
    <label class="col-md-3 form-control-label" for="celular">Email</label>
    <div class="col-md-9">
    
        <input type="text" id="email" name="email" class="form-control" placeholder="Ingrese el Email" value="{{old('email')}}">
        @error('email')
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
    <label class="col-md-3 form-control-label" for="dni">Dirección</label>
    <div class="col-md-9">
        <input type="text" id="direccion" name="direccion" class="form-control" placeholder="Ingrese dirección" value="{{old('direccion')}}">
    
        @error('direccion')
            <span class="error-message" style="color:red">{{ $message }}</span>
        @enderror
    </div>
</div>




<div class="modal-footer">
        <button type="submit" class="btn btn-success" style="border-radius:0.7em;"><i class="fa fa-save fa-1x"></i> Guardar</button>
        <button type="button" class="btn btn-danger" style="border-radius:0.7em;" data-dismiss="modal"><i class="fa fa-times fa-1x"></i> CANCELAR</button>
    
</div>
