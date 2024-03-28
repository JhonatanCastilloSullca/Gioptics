<div class="form-group row">
    <label class="col-md-3 form-control-label" for="descripcion">Descripcion</label>
    <div class="col-md-9">
        <input type="text" id="descripcion" name="descripcion" class="form-control" placeholder="Ingrese Descripcion" value="{{old('descripcion')}}">
        
        @error('descripcion')
            <span class="error-message" style="color:red">{{ $message }}</span>
        @enderror
    </div>
</div>


<div class="form-group row">
    <label class="col-md-3 form-control-label" for="monto">Monto</label>
    <div class="col-md-9">
        <input type="text" id="monto" name="monto" class="form-control" placeholder="Ingrese Monto" value="{{old('monto')}}" >
        @error('monto')
            <span class="error-message" style="color:red">{{ $message }}</span>
        @enderror
    </div>
</div>

<div class="form-group row">
    <label class=" col-md-3 form-control-label" for="dni">Tipo de Comprobante</label>
    <div class="col-md-9">
        <select class=" form-control selectpicker" name="documento" id="documento" data-live-search="true" >
            <option value="RECIBO" {{ old('documento') == "RECIBO" ? 'selected' : '' }}>RECIBO</option>
            <option value="BOLETA" {{ old('documento') == "BOLETA" ? 'selected' : '' }}>BOLETA</option>
            <option value="FACTURA" {{ old('documento') == "FACTURA" ? 'selected' : '' }}>FACTURA</option>
            <option value="OTROS" {{ old('documento') == "OTROS" ? 'selected' : '' }}>OTROS</option>        
        </select>
        @error('documento')
            <span class="error-message" style="color:red">*</span>
        @enderror
    </div>
</div>

<div class="form-group row">
    <label class="col-md-3 form-control-label" for="monto">Numero</label>
    <div class="col-md-9">
        <input type="text" id="numero" name="numero" class="form-control" placeholder="Ingrese numero" value="{{old('numero')}}" >
        @error('numero')
            <span class="error-message" style="color:red">{{ $message }}</span>
        @enderror
    </div>
</div>

<div class="form-group row">
    <label class="col-md-3 form-control-label" for="dni">Medio de Pago</label>
    <div class="col-md-9">
        <select class="form-control selectpicker idMedios" name="idMedios" id="idMedios" data-live-search="true" >
            @foreach($medios as $med)
                <option value='{{$med->id}}' {{ old('idMedios') == $med->id ? 'selected' : '' }}>{{$med->nombre}} {{$med->banco}}</option>
            @endforeach
        </select>
        @error('idMedios')
            <span class="error-message" style="color:red">{{ $message }}</span>
        @enderror
    </div>
</div>



<div class="modal-footer">
<button type="submit" class="btn btn-success" style="border-radius:0.7em;"><i class="fa fa-save fa-1x"></i> Guardar</button>
    <button type="button" class="btn btn-danger" style="border-radius:0.7em;" data-dismiss="modal"><i class="fa fa-times fa-1x"></i> Cerrar</button>
    
</div>
