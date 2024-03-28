<div>
    <div class="form-group row">
        <div class="col-md-2">
            <div class="form-group">
                <label class="form-control-label" for="numero">Pasajeros</label>
                <input wire:model='numero' type="number" class="form-control" id="numero_e" name="numero_e"  min="0">
                @error('numero')
                    <span class="error-message" style="color:red">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col-md-5">
            <div class="form-group">
                <label class="form-control-label" for="rubro">Tour</label>
                <span class="input-group-btn"> 
                    <select wire:model='idTour' class="form-control" name="idTour_e" id="idTour_e" data-live-search="true" required>
                        <option  value="0" disabled >SELECCIONE </option>
                        @foreach($tours as $tour)
                        <option value='{{$tour->id}}'>{{$tour->nombre}}</option>
                        @endforeach
                    </select>  
                </span>
                @error('idTour')
                    <span class="error-message" style="color:red">{{ $message }}</span>
                @enderror
            </div>
        </div>
        
        <div class="col-md-5">
            <div class="form-group">
                <label for="detallea">Fecha de Viaje</label> 
                <input wire:model='fecha' id="fecha_e" type="date" name="fecha_e" min="<?php echo date("Y-m-d");?>" class="form-control" placeholder="Ingrese Descripción" >
                @error('fecha')
                    <span class="error-message" style="color:red">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label class="form-control-label" for="numero">Precio Unitario</label><input id="moneda_e" type="hidden" name="moneda_e" value="S/">
                <span class="input-group-btn"> 
                    
                    <button type="button" class="btn btn-default btn-primary btn-number"  id="soles_e">
                        <span><b>S/</b></span>
                    </button>
                    <button type="button" class="btn btn-default btn-primary btn-number" id="dolares_e">
                        <span><b>$</b></span>
                    </button>
                    <input wire:model='precio' id="precio_e" type="number" name="precio_e" class="form-control"  min="0.00">
                </span>
                @error('precio')
                    <span class="error-message" style="color:red">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label class="form-control-label" for="numero">Ingreso</label><input id="moneda_ingreso_e" type="hidden" name="moneda_ingreso_e" value="S/">
                <span class="input-group-btn"> 
                    
                    <button type="button" class="btn btn-default btn-primary btn-number"  id="soles_ingreso_e">
                        <span><b>S/</b></span>
                    </button>
                    <button type="button" class="btn btn-default btn-primary btn-number" id="dolares_ingreso_e">
                        <span><b>$</b></span>
                    </button>
                    <input wire:model='ingreso' id="ingreso_e" type="number" name="ingreso_e" class="form-control"  min="0.00">
                </span>
                @error('ingreso')
                    <span class="error-message" style="color:red">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col-md-4" >
            <label class=" form-control-label" for="proyecto">Hotel</label>
            <span class="input-group-btn"> 
                <select class="form-control selectpicker" name="idHotel_e" id="idHotel_e" data-live-search="true" required>
                    <option  value="0" disabled >SELECCIONE </option>
                    
                    @foreach($hoteles as $hot)
                        <option value='{{$hot->id}}'>{{$hot->nombre}}</option>
                    @endforeach
                </select>
                    
            </span>
            @error('idHotel')
                <span class="error-message" style="color:red">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label for="precioprod">Descripciones </label>
                <input wire:model.debounce.500ms='observacion' type="text"  id="observaciones_e" name="observaciones_e" class="form-control" >
                @error('observacion')
                    <span class="error-message" style="color:red">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>
    <div class="modal-footer">
    <button type="submit" class="btn btn-success" style="border-radius:0.7em;"><i class="fa fa-save fa-1x"></i> Guardar</button>
    <button type="button" class="btn btn-danger" style="border-radius:0.7em;" data-dismiss="modal"><i class="fa fa-times fa-1x"></i> Cerrar</button>
    </div>
</div>
@push('scripts')
<script>
    
$('#dolares_e').hide();
$('#dolares_ingreso_e').hide();
$(document).ready(function(){
    
    $("#soles_e").click(function(){
        solesagregar_e();
    });
});

$(document).ready(function(){
    
    $("#dolares_e").click(function(){
        dolaresagregar_e();
    });
});

function dolaresagregar_e(){
    $('#dolares_e').hide();
    $('#soles_e').show();
    $('#moneda_e').val("S/");
    
   
}

function solesagregar_e(){
    $('#dolares_e').show();
    $('#soles_e').hide();
    $('#moneda_e').val("$");
   
}
$(document).ready(function(){
    
    $("#soles_ingreso_e").click(function(){
        solesagregaringreso_e();
    });
});

$(document).ready(function(){
    
    $("#dolares_ingreso_e").click(function(){
        dolaresagregaringreso_e();
    });
});

function dolaresagregaringreso_e(){
    $('#dolares_ingreso_e').hide();
    $('#soles_ingreso_e').show();
    $('#moneda_ingreso_e').val("S/");
    
   
}

function solesagregaringreso_e(){
    $('#dolares_ingreso_e').show();
    $('#soles_ingreso_e').hide();
    $('#moneda_ingreso_e').val("$");
   
}

</script>

@endpush