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
    <label class="col-md-3 form-control-label" for="codigo">Codigo</label>
    <div class="col-md-9">
        <input type="text" id="codigo" name="codigo" class="form-control" placeholder="Ingrese Codigo" value="{{old('codigo')}}" >
        @error('codigo')
            <span class="error-message" style="color:red">{{ $message }}</span>
        @enderror
    </div>
</div>

<div class="form-group row">
    <label class="col-md-3 form-control-label" for="modelo">Unidad</label>
    <div class="col-md-9">
        <input type="text" id="modelo" name="modelo" class="form-control" placeholder="Ingrese Modelo" value="{{old('modelo')}}" >
        @error('modelo')
            <span class="error-message" style="color:red">{{ $message }}</span>
        @enderror
    </div>
</div>

<div class="form-group row">
    <label class="col-md-3 form-control-label" for="color">Color</label>
    <div class="col-md-9">
        <input type="text" id="color" name="color" class="form-control" placeholder="Ingrese Color" value="{{old('color')}}" >
        @error('color')
            <span class="error-message" style="color:red">{{ $message }}</span>
        @enderror
    </div>
</div>

<div class="form-group row">
    <label class="col-md-3 form-control-label" for="precio">Precio</label>
    <div class="col-md-9">
        <input type="text" id="precio" name="precio" class="form-control" placeholder="Ingrese Precio" value="{{old('precio')}}" >
        @error('precio')
            <span class="error-message" style="color:red">{{ $message }}</span>
        @enderror
    </div>
</div>

<div class="form-group row">
    <label class="col-md-3 form-control-label" for="precio">Precio Compra</label>
    <div class="col-md-9">
        <input type="text" id="precio_compra" name="precio_compra" class="form-control" placeholder="Ingrese Precio Compra" value="{{old('precio_compra')}}" >
        @error('precio_compra')
            <span class="error-message" style="color:red">{{ $message }}</span>
        @enderror
    </div>
</div>





<div class="modal-footer">
<button type="submit" class="btn btn-success" style="border-radius:0.7em;"><i class="fa fa-save fa-1x"></i> Guardar</button>
    <button type="button" class="btn btn-danger" style="border-radius:0.7em;" data-dismiss="modal"><i class="fa fa-times fa-1x"></i> Cerrar</button>

    
</div>
