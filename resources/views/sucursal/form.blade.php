<div class="form-group row">
    <label class="col-md-3 form-control-label" for="nombre">Tienda</label>
    <div class="col-md-9">
        <input type="text"  id="nombre" name="nombre" class="form-control" placeholder="Ingrese el Nombre" value="{{old('nombre')}}">
        @error('nombre')
            <span class="error-message" style="color:red">{{ $message }}</span>
        @enderror
    </div>
</div>

<div class="form-group row">
    <label class="col-md-3 form-control-label" for="dni">Direccion</label>
    <div class="col-md-9">
        <input type="text" id="direccion" name="direccion" class="form-control" placeholder="Ingrese direccion" value="{{old('direccion')}}">
    
        @error('direccion')
            <span class="error-message" style="color:red">{{ $message }}</span>
        @enderror
    </div>
</div>

<div class="form-group row">
    <label class="col-md-3 form-control-label" for="dni">Telefono</label>
    <div class="col-md-9">
        <input type="text" id="telefono" name="telefono" class="form-control" placeholder="Ingrese telefono" value="{{old('telefono')}}">
    
        @error('telefono')
            <span class="error-message" style="color:red">{{ $message }}</span>
        @enderror
    </div>
</div>

<div class="modal-footer">
        <button type="submit" class="btn btn-success" style="border-radius:0.7em;"><i class="fa fa-save fa-1x"></i> Guardar</button>
        <button type="button" class="btn btn-danger" style="border-radius:0.7em;" data-dismiss="modal"><i class="fa fa-times fa-1x"></i> Cerrar</button>
    
</div>
