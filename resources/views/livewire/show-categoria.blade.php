<div class="col-md-6" style="display: inline-flex;">
    
    <div class="col-md-6">
        <label class="form-control-label" for="nombre">Categorias</label>
        
        <select wire:model="selectCategorias" class="form-control " name="idCategoria" id="idCategoria" data-live-search="true" required >
        <option value="0">Seleccione</option>
            @foreach($categorias as $cat)
                <option value="{{$cat->id}}" {{ old('idCategoria') == $cat->id ? 'selected' : '' }}>{{$cat->nombre}} </option>
            @endforeach
        </select>
        
    </div>
    
        <div class="col-md-6 ">
                <label class="form-control-label" for="nombre">Productos</label>
                @if(!is_null($productos))         
                <select  class="form-control" name="idProducto" id="idProducto" data-live-search="true" required  >
                <option value="0" >Seleccione</option>
                    @foreach($productos as $pro)
                        <option value="{{$pro->id}}_{{$pro->nombre}}_{{$pro->precio}}" {{ old('idProducto') == $pro->id ? 'selected' : '' }}>{{$pro->nombre}} </option>
                    @endforeach
                </select>  
            
                @endif
        </div>
</div>

@push('scripts')
@endpush