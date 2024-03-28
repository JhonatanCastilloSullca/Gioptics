<div class="form-group row">
    <label class="col-md-3 form-control-label" for="nombreas">Nombre</label>
    <div class="col-md-9">
        <input type="text"  id="nombreas" name="nombreas" class="form-control" placeholder="Ingrese el nombre de la unidad" value="{{old('nombreas')}}">
        @error('nombre')
            <span class="error-message" style="color:red">{{ $message }}</span>
        @enderror
    </div>
</div>

<div class="modal-footer">
<button wire:click="$emit('refrescar')" type="submit" class="btn btn-success" style="border-radius:0.7em;"><i class="fa fa-save fa-1x"></i> Guardar</button>
    <button type="button" class="btn btn-danger" style="border-radius:0.7em;" data-dismiss="modal"><i class="fa fa-times fa-1x"></i> Cerrar</button>
    
</div>
