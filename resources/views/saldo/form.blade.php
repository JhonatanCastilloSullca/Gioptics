
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
    
            <select class="form-control selectpicker" name="idMedios" id="idMedios" data-live-search="true" required>
                                            
            <option value="0">Seleccione</option>
            
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
                    <input type="text" id="monto" name="monto" class="form-control" placeholder="Ingrese la Cantidad"  value="0">
                </div>
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
    if(parseInt(saldo) < parseInt(monto) || parseInt(monto)<0){
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