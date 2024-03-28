<div class="form-group row">
    <label class="col-md-3 form-control-label" for="nombre">Nombre</label>
    <div class="col-md-9">
        <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Ingrese el Nombre" value="{{old('nombre')}}">
        
        @error('nombre')
            <span class="error-message" style="color:red">{{ $message }}</span>
        @enderror
    </div>
</div>

<div class="form-group row">
    <label class="col-md-3 form-control-label" for="direccion">Apellidos</label>
    <div class="col-md-9">
        <input type="text" id="apellido" name="apellido" class="form-control" placeholder="Ingrese los Apellidos" value="{{old('apellido')}}" >
        @error('apellido')
            <span class="error-message" style="color:red">{{ $message }}</span>
        @enderror
    </div>
</div>
<div class="form-group row">
    <label class="col-md-3 form-control-label" for="dni">Tipo de documento</label>
    <div class="col-md-9">
        <select class="form-control selectpicker" name="tipo_documento" id="tipo_documento" data-live-search="true" >
            <option value="DNI" {{ old('tipo_documento') == "DNI" ? 'selected' : '' }}>DNI</option>
            <option value="PASAPORTE" {{ old('tipo_documento') == "PASAPORTE" ? 'selected' : '' }}>PASAPORTE</option>
            <option value="CARNET" {{ old('tipo_documento') == "CARNET" ? 'selected' : '' }}>CARNET</option>        
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
    <label class="col-md-3 form-control-label" for="rol">Rol</label>
    
    <div class="col-md-9">
        <select class="form-control selectpiker" name="rol" id="rol">                   
            <option value="0" selected>Seleccione</option>
            <option value="Gerencia" {{ old('rol') == "Gerencia" ? 'selected' : '' }}>Gerencia</option>
            <option value="Administrador de Tienda" {{ old('rol') == "Administrador de Tienda" ? 'selected' : '' }}>Administrador de Tienda</option>
            <option value="Asesor de Venta" {{ old('rol') == 'Asesor de Venta' ? 'selected' : '' }}>Asesor de Venta</option>
            <option value="Especialista" {{ old('rol') == "Especialista" ? 'selected' : '' }}>Especialista</option>
           
        </select>
    </div>
        
</div>

<div class="form-group row">
            <label class="col-md-3 form-control-label" for="usuario">Usuario</label>
            <div class="col-md-9">
            
                <input type="text" id="usuario" name="usuario" class="form-control" placeholder="Ingrese el usuario" value="{{old('usuario')}}">
                @error('usuario')
                    <span class="error-message" style="color:red">{{ $message }}</span>
                @enderror
            </div>
</div>

<div class="form-group row">
            <label class="col-md-3 form-control-label" for="password">Password</label>
            <div class="col-md-9">
            
                <input type="password" id="password" name="password" class="form-control" placeholder="Ingrese el password" value="{{old('password')}}" >
                @error('password')
                    <span class="error-message" style="color:red">{{ $message }}</span>
                @enderror
            </div>
</div>


<div class="modal-footer">
    <button type="submit" class="btn btn-success" style="border-radius:0.7em;"><i class="fa fa-save fa-1x"></i> Guardar</button>
    <button type="button" class="btn btn-danger" style="border-radius:0.7em;" data-dismiss="modal"><i class="fa fa-times fa-1x"></i> Cancelar</button>
    
</div>
