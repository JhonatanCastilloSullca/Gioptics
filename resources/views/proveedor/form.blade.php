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
    <label class="col-md-3 form-control-label" for="dni">Direccion</label>
    <div class="col-md-9">
        <input type="text" id="direccion" name="direccion" class="form-control" placeholder="Ingrese direccion de Proveedor" value="{{old('direccion')}}">
    
        @error('direccion')
            <span class="error-message" style="color:red">{{ $message }}</span>
        @enderror
    </div>
</div>


<div class="form-group row">
    <label class="col-md-3 form-control-label" for="celular">Celular</label>
    <div class="col-md-9">
    
        <input type="text" id="celular" name="celular" class="form-control" placeholder="Ingrese el telefono" value="{{old('celular')}}">
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
    <label class="col-md-3 form-control-label" for="dni">Numero de Cuenta</label>
    <div class="col-md-9">
        <input type="text" id="num_cuenta" name="num_cuenta" class="form-control" placeholder="Ingrese Numero de cuenta" value="{{old('num_cuenta')}}">
    
        @error('num_cuenta')
            <span class="error-message" style="color:red">{{ $message }}</span>
        @enderror
    </div>
</div>
<div class="form-group row">
    <label class="col-md-3 form-control-label" for="dni">Descripcion</label>
    <div class="col-md-9">
        <input type="text" id="descripcion" name="descripcion" class="form-control" placeholder="Ingrese descripcion" value="{{old('descripcion')}}">
    
        @error('descripcion')
            <span class="error-message" style="color:red">{{ $message }}</span>
        @enderror
    </div>
</div>



<div class="modal-footer">
<button type="submit" class="btn btn-success" style="border-radius:0.7em;"><i class="fa fa-save fa-1x"></i> Guardar</button>
    <button type="button" class="btn btn-danger" style="border-radius:0.7em;" data-dismiss="modal"><i class="fa fa-times fa-1x"></i> Cerrar</button>
    
</div>
