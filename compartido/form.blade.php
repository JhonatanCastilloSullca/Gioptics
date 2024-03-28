   

    

    <div class="form-group row">
                <label class="col-md-2 form-control-label" for="nombre">Saldo:</label>
                <div class="col-md-4">
                    <input type="text" id="saldo" name="saldo" class="form-control" placeholder="Ingrese el Saldo" disabled>
                </div>
                <div class="col-md-2 form-control-label">
                    <input type="checkbox" id="Deposito"  ><label style="padding-top: 10px;" >&nbsp;&nbsp;&nbsp;Deposito</label><br>
                </div>
                <div class="col-md-4">
                    <div id="depositos">
                
                        <select class="form-control selectpicker" name="id_pago" id="id_pago" data-live-search="true" required>
                                                        
                        <option value="0">Seleccione</option>
                        
                        @foreach($tipo_pagos as $pago)
                        
                        <option value="{{$pago->id}}">{{$pago->nombre}}</option>
                                
                        @endforeach

                        </select>
                            
                    </div>
                </div>
    </div>

    
    <div class="form-group row">
                <label class="col-md-2 form-control-label" for="cantidad">Cantidad</label>
                <div class="col-md-10">
                    <input type="text" id="cantidad" name="cantidad" class="form-control" placeholder="Ingrese la Cantidad"  value="0">
                </div>
    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-danger" id="botoncancelar" data-dismiss="modal"><i class="fa fa-times fa-1x"></i> Cerrar</button>
        <button type="submit" class="btn btn-success " id="guardar"><i class="fa fa-save fa-1x"></i> Guardar</button>
        <button type="submit" class="btn btn-primary " id="entregar"><i class="fa fa-check fa-1x"></i> Entregar</button>
        
    </div>
@push('scripts')
<script>


   
    
   $("#depositos").hide();
   $("#guardar").hide();
   $("#cantidad").change(Evaluar);

    $(document).ready(function(){
     
     $("#Deposito").click(function(){

         MostrarDeposito();
     });

  });

    


   function MostrarDeposito(){
        if( $('#Deposito').prop('checked') ) {
            $("#depositos").show();
        }
        else
        {
            $("#depositos").hide();
            $("#depositos option:selected").prop("selected", false);
        }    
    }

    function Evaluar(){

    saldo=$("#saldo").val();
    cantidad=$('#cantidad').val();
    if(parseInt(saldo) < parseInt(cantidad) || parseInt(cantidad)<0){
        $('#cantidad').val(0);
        Swal.fire({
            type: 'error',
            //title: 'Oops...',
            text: 'El monto ingresado no es correcto',
        
            })
    }
    else{
            if (parseInt(saldo)==parseInt(cantidad)) {
            $("#entregar").show();
            $("#guardar").hide();
            }else{
                $("#guardar").show();
                $("#entregar").hide();
            }
                
            
        }
    }
    



</script>
@endpush