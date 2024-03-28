<div class="form-group row">
    <label class="col-md-3 form-control-label" for="nombre">Titular</label>
    <div class="col-md-9">
        <input type="text"  id="nombre" name="nombre" class="form-control" placeholder="Ingrese el Nombre" value="{{old('nombre')}}">
        @error('nombre')
            <span class="error-message" style="color:red">{{ $message }}</span>
        @enderror
    </div>
</div>

<div class="form-group row">
    <label class="col-md-3 form-control-label" for="dni">Nombre</label>
    <div class="col-md-9">
        <input type="text" id="banco" name="banco" class="form-control" placeholder="Ingrese nombre" value="{{old('banco')}}">
    
        @error('banco')
            <span class="error-message" style="color:red">{{ $message }}</span>
        @enderror
    </div>
</div>

<div class="form-group row">
    <label class="col-md-3 form-control-label" for="dni">Numero</label>
    <div class="col-md-9">
        <input type="text" id="numero" name="numero" class="form-control" placeholder="Ingrese numero" value="{{old('numero')}}">
    
        @error('numero')
            <span class="error-message" style="color:red">{{ $message }}</span>
        @enderror
    </div>
</div>

<div class="form-group row">
    <label class="col-md-3 form-control-label" for="rol">Moneda</label>
    
    <div class="col-md-9">
        <select class="form-control selectpiker" name="moneda" id="moneda">                   
            <option value="0" disabled>Seleccione</option>
            <option value="Soles" {{ old('rol') == "Soles" ? 'selected' : '' }}>Soles</option>
            <option value="Dolares" {{ old('rol') == 'Dolares' ? 'selected' : '' }}>Dolares</option>
           
        </select>
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
            <button type="button" class="btn btn-danger" style="border-radius:0.7em;" data-dismiss="modal"><i class="fa fa-times fa-1x"></i> Cancelar</button>
    
</div>
