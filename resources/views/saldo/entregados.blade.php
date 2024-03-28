
@extends('home')
@section('contenido')
<main class="main">
    <div class="container-fluid"  id="seccionRecargar">
        <!-- Ejemplo de tabla Listado -->
        <div class="card">
            <div class="card-header">

            <h2><i class="fa fa-circle-o-notch"></i>&nbsp;&nbsp;Pedidos Entregados</h2><br/>
            </div>
            <div class="card-body" >
                <div class="table-responsive" >
                    <table id="ventas" class="table table-bordered table-striped table-sm">
                        <thead>
                            <tr class="bg-success">
                                <th>Nº</th>
                                <th>Fecha</th>
                                <th>Cliente</th>
                                <th>Vendedor</th>
                                <th>Medio de Pago</th>
                                <th>Sucursal</th>
                                <th>Total</th>
                                <th>Ver</th>
                                <th><i class="fa fa-trash fa-1x"></i></th>
                            </tr>
                        </thead>
                    <tbody>
                        @php $cont=1 @endphp

                        @foreach($ventasf as $vent)
                        <tr>
                            <td class="nombre">{{$cont}} </td>
                            <td>{{date("d/m/Y", strtotime($vent->fecha))}}</td>
                            <td>{{$vent->cliente}}</td>
                            <td>{{$vent->vendedor}}</td>
                            <td>{{$vent->medio}} {{$vent->banco}}</td>
                            <td>{{$vent->sucursal}}</td>
                            <td>{{number_format($vent->total,2)}}</td>
                            <td>
                                <a href="{{URL::action('App\Http\Controllers\VentaController@show',$vent->id)}}" > 
                                    <button type="button" class="btn btn-info btn-sm">
                                    <i class="fa fa-eye fa-1x"></i>
                                    </button>
                                </a>
                                <input type="hidden" name="id_enviar" id="id_enviar" class="id_enviar" value="{{$vent->id}}">
                                
                            </td>
                            <td>
                                @if(Auth::user()->rol=="Gerencia")
                                    <a class="edit"     data-toggle="modal" data-id_usuario="'$user->id'"  data-target="#anularVenta"> 
                                        <button type="button" class="btn btn-danger btn-sm">
                                            <i class="fa fa-times fa-1x"></i>
                                        </button>
                                    </a>
                                @else
                                    <button type="button" class="btn btn-danger btn-sm">
                                        <i class="fa fa-times fa-1x"></i>
                                    </button>
                                @endif
                            </td>
                        </tr>
                        @php $cont=$cont+1 @endphp
                        @endforeach
                    
                    </tbody>
                </table>
                
                </div>
                
                
            </div>
        </div>
        <!-- Fin ejemplo de tabla Listado -->
    </div>


    <!--Inicio del modal cambiar Estado-->
    <div class="modal fade" id="pagarSaldo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-danger modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Pagar Saldo</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
            
                <div class="modal-body">
                    
                    
                    <form action="{{route('saldo.store')}}" method="post"  class="form-horizontal">
                        {{csrf_field()}}
                        @include('saldo.form')
                        <input type="hidden" id="id_venta" name="id_venta" value="">
                        <div class="modal-footer"> 
                        <button type="submit" class="btn btn-success" style="border-radius:0.7em;"><i class="fa fa-save fa-1x"></i> Entregar</button>
                        <button type="button" class="btn btn-danger" style="border-radius:0.7em;" data-dismiss="modal"><i class="fa fa-times fa-1x"></i> Cerrar</button>
                        </div>   
                    

                    </form>
                </div>
                
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!--Fin del modal-->


</main>

@push('scripts')
<script>

$(document).ready(function() {
    $('#ventas').DataTable({
        "lengthMenu":[[10,25,50,-1],[10,25,50,"Todos"]]
    });
} );
    
$(document).on('click', '.edit', function()
{
    var _this = $(this).parents('tr');
    var id=_this.find('.id_enviar').val();
    $('#id_venta').val(id);
    $('#saldo').val(_this.find('.saldo').text());
    
});


$(document).on('click', '.edit2', function()
    {
        var _this = $(this).parents('tr');
        var id=_this.find('.id_enviar').val();
        cadena="";
        <?php foreach ($detalles  as $det): ?>
            if('{{$det->idVenta}}'==id){
                cadena=""+cadena+""+'{{$det->producto}}'+", ";
                
            }
        <?php endforeach ?> 
        <?php foreach ($ventasf  as $vet): ?>
            if('{{$vet->id}}'==id){
                let url =`https://api.whatsapp.com/send?phone=51`+id+`&text=---------------------------%0A *HOLA {{$vet->cliente}}*%0A%0Atu pedido de `+cadena+`está listo! Ya puedes acercarte a nuestra tienda de {{$vet->direccion}} para recogerlo. Puedes hacernos todas tus consultas a través chat o llámanos directamente y te atenderemos de inmediato. ¡Te esperamos!`;
                window.open(url);
            }
        <?php endforeach ?> 
        
    });    
</script>



@endpush

@endsection
