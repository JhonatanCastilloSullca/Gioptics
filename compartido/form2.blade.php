    <div class="form-group row">
                <label class="col-md-3 form-control-label" for="nombre">Fecha</label>
                <div class="col-md-9">
                    <input type="date" id="fechafin" name="fechafin" class="form-control">
                    
                </div>
    </div>
    
     <div class="form-group row">
            <label class="col-md-3 form-control-label" for="ruc">PROVEEDOR</label>
            
            <div class="col-md-9">
                <select class="form-control" name="idProveedor" id="idProveedor" data-live-search="true" required>
                    <option  value="0" disabled >SELECCIONE</option>
                    @foreach($proveedor as $prov)
                        <option value="{{$prov->id}}">{{$prov->nombre}}</option>
                    @endforeach
                </select>
            
            </div>
                                       
    </div>
    

    <div class="form-group row">
                <label class="col-md-3 form-control-label" for="telefono">SUSTENTO</label>
                <div class="col-md-9">
                  
                    <select class="form-control" name="sustento" id="sustento">
                        <option value="NINGUNO">NINGUNO</option>
                        <option value="FACTURA">FACTURA</option>         
                        <option value="BOLETA">BOLETA</option>         
                        <option value="RECIBO DE HONRARIO">RECIBO DE HONORARIO</option>
                        <option value="LIQUIDACION">LIQUIDACION</option>
                        <option value="CRONOGRAMA">CRONOGRAMA</option>
                        <option value="PLANILLA">PLANILLA</option>
                        <option value="RECIBO">RECIBO</option>                
                    </select> 
                       
                </div>
    </div>

    <div class="form-group row">
                <label class="col-md-3 form-control-label" for="email">NUMERO DE SUSTENTO</label>
                <div class="col-md-9">
                  
                    <input type="text" class="form-control" id="numero_sustento" name="numero_sustento" >
                       
                </div>
    </div>

    <div class="form-group row">
                <label class="col-md-3 form-control-label" for="descripcion">EJECUTADA</label>
                <div class="col-md-9">
                  
                    <input type="number" class="form-control" id="monto" name="monto" >
                       
                </div>
    </div>

    <div class="modal-footer">
    <button type="submit" class="btn btn-success" style="border-radius:0.7em;"><i class="fa fa-save fa-1x"></i> Guardar</button>
    <button type="button" class="btn btn-danger" style="border-radius:0.7em;" data-dismiss="modal"><i class="fa fa-times fa-1x"></i> Cerrar</button>
        
    </div>