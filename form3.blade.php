<button type="button" id="boton_agregar" onclick="agregarPasajero()" class="btn btn-success"><i class="fa fa-save fa-1x"></i> Agregar</button>
<div id="aparecer">
    <div class="form-group row">
        <label class="col-md-2 form-control-label" for="nombre">Nombre</label>
        <div class="col-md-4">
            <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Ingrese el Nombre" required>
            
        </div>
        <label class="col-md-2 form-control-label" for="direccion">Apellidos</label>
        <div class="col-md-4">
            <input type="text" id="apellidos" name="apellidos" class="form-control" placeholder="Ingrese los Apellidos" required >
        </div>
    </div>
    <div class="form-group row">
        <label class="col-md-2 form-control-label" for="dni">Tipo de documento</label>
        <div class="col-md-4">
            <select class="form-control selectpicker" name="tipo_documento" id="tipo_documento" data-live-search="true" >
                <option value="DNI">DNI</option>
                <option value="PASAPORTE">PASAPORTE</option>         
                <option value="CARNET">CARNET</option>         
                <option value="RUC">RUC</option>         
            </select>
        </div>
        <label class="col-md-2 form-control-label" for="dni">Número documento</label>
        <div class="col-md-4">
            <input type="text" id="num_documento" name="num_documento" class="form-control" placeholder="Ingrese el número documento" >
        </div>
    </div>

    <div class="form-group row">
        <label class="col-md-2 form-control-label" for="celular">Celular</label>
        <div class="col-md-5">
        
            <input type="text" id="celular" name="celular" class="form-control" placeholder="Ingrese el telefono">
            
        </div>
    </div>
</div>
<div class="modal-footer">
<button type="submit" class="btn btn-success" style="border-radius:0.7em;"><i class="fa fa-save fa-1x"></i> Guardar</button>
    <button type="button" class="btn btn-danger" style="border-radius:0.7em;" data-dismiss="modal"><i class="fa fa-times fa-1x"></i> Cerrar</button>
        
</div>

@push('scripts')
<script>

cont = 0;

function validar(){
    if(cont==1){
        $('#boton_agregar').hide();
    }
};

agregarPasajero = function () {
    var texto='<p> Hola <b>Mundo</b></p>';
    var nuevo_parrafo =document.createElement("p");
    var aparecer =document.getElementById("aparecer");
    nuevo_parrafo.innerHTML = '<div class="form-group row"><label class="col-md-2 form-control-label" for="nombre">Nombre</label><div class="col-md-4"><input type="text" id="nombre" name="nombre" class="form-control" placeholder="Ingrese el Nombre" ></div><label class="col-md-2 form-control-label" for="direccion">Apellidos</label><div class="col-md-4"><input type="text" id="apellidos" name="apellidos" class="form-control" placeholder="Ingrese los Apellidos"></div></div><div class="form-group row"> <label class="col-md-2 form-control-label" for="dni">Tipo de documento</label> <div class="col-md-4"> <select class="form-control" name="tipo_documento" id="tipo_documento" data-live-search="true" ><option value="DNI">DNI</option> <option value="PASAPORTE">PASAPORTE</option><option value="CARNET">CARNET</option><option value="RUC">RUC</option></select></div><label class="col-md-2 form-control-label" for="dni">Número documento</label><div class="col-md-4"><input type="text" id="num_documento" name="num_documento" class="form-control" placeholder="Ingrese el número documento" ></div></div><div class="form-group row"><label class="col-md-2 form-control-label" for="celular">Celular</label><div class="col-md-5"><input type="text" id="celular" name="celular" class="form-control" placeholder="Ingrese el telefono"></div></div>';
    aparecer.appendChild(nuevo_parrafo);
    cont++;
    validar();
}
        
</script>  



@endpush
