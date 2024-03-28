
<div class="form-group row">
    <label class="col-md-2 form-control-label" for="nombre">Saldo:</label>
    <div class="col-md-4">
        <input type="text" id="saldo" name="saldo" class="form-control" value="{{$compra->saldo}}" disabled>
    </div>
    <div class="col-md-6">
        <div id="depositos">
    
            <select class="form-control selectpicker" name="idMedios" id="idMedios" data-live-search="true" required>
            @foreach($medios as $med)
            
            <option value="{{$med->id}}">{{$med->nombre}} {{$med->banco}}</option>
                    
            @endforeach

            </select>
                
        </div>
    </div>
</div>

    
    <div class="form-group row">
                <label class="col-md-2 form-control-label" for="cantidad">Monto</label>
                <div class="col-md-10">
                    <input type="number" id="monto" name="monto"  max="{{$compra->saldo}}" min="0" class="form-control" placeholder="Ingrese la Cantidad" >
                </div>
    </div>
@push('scripts')
<script>


</script>
@endpush