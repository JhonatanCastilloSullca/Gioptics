
@extends('home')
@section('contenido')
<main class="main">
            <div class="container-fluid"  id="seccionRecargar">
                <!-- Ejemplo de tabla Listado -->
                <div class="card">
                    <div class="card-header">

                    <h2><i class="fa fa-shopping-cart fa-1x"></i>&nbsp;&nbsp;Listado de Facturas</h2><br/>
                        
                        <a href="/facturacion/create">
                            <button class="btn btn-success btn-lg" type="button" style="border-radius: 0.5em;">
                                <i class="fa fa-plus fa-1x"></i>&nbsp;&nbsp;Agregar Factura
                            </button>
                        </a>
                        
                    </div>
                    <div class="card-body" >
                        <div id="filtroVentas">
                            <form action="{{ route('facturacion.lista') }}" method="GET">
                                <div class="row pb-4">
                                    <div class="col-md-3">
                                        <label for="searchFechaInicio" class="form-label">Fecha Inicio</label>
                                        <input type="date" class="form-control" id="searchFechaInicio"
                                            name="searchFechaInicio" value="{{ $fechaInicio2 }}">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="searchFechaFin" class="form-label">Fecha Fin</label>
                                        <input type="date" class="form-control" id="searchFechaFin" name="searchFechaFin"
                                            value="{{ $fechaFin2 }}">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="searchCliente" class="form-label">Cliente</label>
                                        <div class="form-group">
                                            <select name="searchCliente" class="form-control form-select cliente"
                                                data-bs-placeholder="Select Cliente">
                                                <option value="">SELECCIONE</option>
                                                @foreach ($clientes as $cliente)
                                                    <option value="{{ $cliente->id }}"
                                                        {{ $searchCliente2 == $cliente->id ? 'selected' : '' }}>
                                                        {{ $cliente->nombre }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-2">
                                        <button id="tuBotonEnviar" class="btn btn-primary mt-4">
                                            <i data-bs-toggle="tooltip" data-bs-title="Crear" class="fas fa-search"></i><b>
                                                &nbsp; Buscar</b>
                                        </button>
                                        <a href="{{ route('facturacion.reporte', ['searchFechaInicio' => $fechaInicio2, 'searchFechaFin' => $fechaFin2, 'searchCliente2' => $searchCliente2, 'searchDocumento2' => $searchDocumento2, 'nume_documento2' => $nume_documento2]) }}" target="_blank" class="btn btn-success mt-4 ">
                                            <i data-bs-toggle="tooltip" data-bs-title="Crear" class="fas fa-file-pdf"></i><b>
                                                &nbsp; Excel</b>
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-12" style="overflow-y:auto;margin-bottom: 40px;">
                            <table id="ventas" class="table table-bordered table-striped table-sm">
                                <thead>
                                    <tr class="bg-success">
                                        <th>Ver</th>
                                        <th>Fecha</th>
                                        <th>Cliente</th>
                                        <th>Documento</th>
                                        <th>Total</th>
                                        <th>Sucursal</th>
                                        <th>Mensaje</th>
                                        <th>Estado</th>
                                        <th></th>
                                        
                                    </tr>
                                </thead>
                            <tbody>

                                @foreach($ventas as $vent)
                                <tr>
                                    <td>
                                        <a href="{{URL::action('App\Http\Controllers\VentaController@show',$vent->id)}}" > 
                                            <button type="button" class="btn btn-warning btn-md">
                                            <i class="fa fa-eye fa-1x"></i>
                                            </button>
                                        </a>
                                        <input type="hidden" name="id_enviar" id="id_enviar" class="id_enviar" value="{{$vent->id}}">
                                    </td>

                                    <td>{{date("d/m/Y", strtotime($vent->fecha))}}</td>
                                    <td>{{$vent->cliente->nombre}}</td>
                                    <td>{{ $vent->documento->nombre }} {{ $vent->nume_doc }}</td>
                                    <td>{{number_format($vent->total,2)}}</td>
                                    <td>{{$vent->sucursal->nombre}}</td>
                                    <td>{{ $vent->sunat == 1 ? $vent->documentosunat?->descripcionCdr : $vent->documentosunat?->messageError }}</td>
                                    <td>{{ $vent->sunat == 1 ? 'Aceptado' : ($vent->sunat == 2 ? 'Anulado' : 'Rechazado') }}</td>
                                    <td> 
                                        <div class="btn-group">
                                            @if($vent->sunat == 1 && $vent->documento->nombre != 'NOTA DE CRÉDITO')
                                                <button type="button" class="btn btn-icon btn-danger" data-toggle="modal" data-target="#EliminarUsuario" data-id="{{$vent->id}}" >
                                                    <i class="fa fa-times"></i>
                                                </button> 
                                            @endif
                                            <a href="{{route('facturacion.ticketpdf',$vent->id)}}" target="_blank">
                                                <button type="button" class="btn btn-icon btn-success" >
                                                    <i class="fa fa-file"></i>
                                                </button> 
                                            </a>
                                            <a href="{{route('facturacion.xml',$vent->id)}}" target="_blank">
                                                <button type="button" class="btn btn-icon btn-warning" >
                                                    xml
                                                </button> 
                                            </a>
                                            @if($vent->sunat == 0)
                                            <a href="{{route('facturacion.enviarfactura',$vent->id)}}">
                                                <button type="button" class="btn btn-icon btn-success" data-bs-toggle="tooltip" data-bs-title="Enviar">
                                                    <i class="fa fa-paper-plane"></i>
                                                </button> 
                                            </a>
                                            @endif
                                        </div>
                                    </td>
                                    
                                </tr>

                                @endforeach
                            
                            </tbody>
                        </table>
                        
                        </div>
                        
                        
                    </div>
                </div>
                <!-- Fin ejemplo de tabla Listado -->
            </div>

            <!-- /Container -->
            <div class="modal fade" id="EliminarUsuario" aria-hidden="true" tabindex="-1" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Anular Venta</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="btn-close">x</button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('facturacion.destroyfactura', 'test') }}" method="POST" autocomplete="off">
                                {{ method_field('delete') }}
                                {{ csrf_field() }}
                                <div class="mb-3">
                                    <label for="fecha" class="form-label">Fecha:</label>
                                    <input type="date" class="form-control" name="fecha" min="{{ date('Y-m-d', strtotime('-2 days')) }}" max="{{ date('Y-m-d') }}" value="{{ date('Y-m-d') }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="type_anular" class="form-label">Motivo:</label>
                                    <select class="form-control type_anular" id="type_anular" name="type_anular" value="{{old('type_anular')}}" required>
                                        <option value="">SELECCIONE</option>
                                        <option value="01">Anulación de la operación</option>
                                        <option value="02">Anulación por error en el RUC</option>
                                        <option value="03">Corrección por error en la descripción.</option>
                                        <option value="04">Descuento global</option>
                                        <option value="05">Descuento por ítem</option>
                                        <option value="06">Devolución total</option>
                                        <option value="07">Devolución por ítem</option>
                                        <option value="08">Bonificación</option>
                                        <option value="09">Disminución en el valor</option>
                                        <option value="10">Otros conceptos</option>
                                        <option value="11">Ajustes de operaciones de exportación</option>
                                        <option value="12">Ajustes afectos al IVAP</option>
                                        <option value="13">Corrección del monto neto pendiente de pago y/o la(s) fechas(s) de vencimiento del pago 
                                            único o de las cuotas y/o los montos correspondientes a cada cuota, de ser el caso.</option>
                                    </select>
                                    @error('type_anular')
                                        <span class="error-message" style="color:red">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="descripcion" class="form-label">Descripcion:</label>
                                    <input type="text" step="0.01" min='0' class="form-control descripcion" id="descripcion" name="descripcion" value="{{old('descripcion')}}" required>
                                    @error('descripcion')
                                        <span class="error-message" style="color:red">{{ $message }}</span>
                                    @enderror
                                </div>
                                <p>¿Estás seguro de anular el comprobante?</p>
                                <div class="modal-footer">

                                    <input type="hidden" name="id_venta_2" class="id_venta_2">
                                    <button type="button" data-toggle="tooltip" data-bs-title="Cancelar"
                                        class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                    <button type="submit" data-bs-toggle="tooltip" data-bs-title="Aceptar"
                                        class="btn btn-primary">Aceptar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </main>

@push('scripts')
<script>

$(document).ready(function() {
    $('#ventas').DataTable({
        "lengthMenu":[[10,25,50,-1],[10,25,50,"Todos"]]
    });
} );

$('#EliminarUsuario').on('shown.bs.modal', function(event) {
    var button = $(event.relatedTarget);
    var id = button.data('id');
    var idModal = $('.id_venta_2');
    idModal.val(id);
});



</script>
@endpush

@endsection
