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
    <label class="col-md-3 form-control-label" for="nombre">Tipo</label>
    <div class="col-md-9">
    <select class="form-control selectpicker" name="tipo" id="tipo" data-live-search="true" >
        <option value="0" disabled>SELECCIONE</option>
        <option value="CON STOCK" {{ old('tipo') == "CON STOCK" ? 'selected' : '' }}>CON STOCK</option>
        <option value="SIN STOCK" {{ old('tipo') == "SIN STOCK" ? 'selected' : '' }}>SIN STOCK</option>    
    </select>
    @error('tipo')
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
<button wire:click="$emit('refrescar')" type="submit" class="btn btn-success" style="border-radius:0.7em;"><i class="fa fa-save fa-1x"></i> Guardar</button>
    <button type="button" class="btn btn-danger" style="border-radius:0.7em;" data-dismiss="modal"><i class="fa fa-times fa-1x"></i> Cerrar</button>
    
</div>
