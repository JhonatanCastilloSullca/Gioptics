<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h2><i class="fa fa-credit-card-alt fa-1x"></i>&nbsp;&nbsp;Generar Venta</h2><br/>  
            @if ($message = Session::get('danger'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ $message }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="close"></button>
                </div>
            @endif
        </div>
        <div class="card-body">
            <div class="form-group row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <h5 class="mb-1">Datos de Venta</h5>
                    <div class="form-group row">
                        <div class="mb-3 col-md-3">
                            <label class="form-label" for="tipo_documento">Comprobante</label>
                            <div wire:ignore>
                                <select class="form-control selectpicker" id="tipo_documento" wire:model="tipo_documento" data-width="100%" data-live-search="true">
                                    <option value="">SELECCIONE</option>
                                    @foreach($documentos as $documento)
                                        <option value="{{$documento->id}}">{{$documento->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('tipo_documento')
                                <span class="error-message" style="color:red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-7">
                            <label class="form-label" for="clienteId">Clientes</label>
                            <div wire:ignore>
                                <select class="form-control selectpicker" id="clienteId" wire:model.defer="clienteId" data-width="100%" data-live-search="true">
                                    <option value="">SELECCIONE</option>
                                    @foreach($clientes as $cliente)
                                        <option value="{{$cliente->id}}">{{$cliente?->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('clienteId')
                                <span class="error-message" style="color:red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mt-4 col-md-2">
                            <button type="button" class="btn btn-primary mb-2 mb-md-0 " wire:click="abrirmodalcliente">
                                <i class="fa fa-plus-circle"></i><b> &nbsp; Cliente </b>
                            </button>
                        </div>
                        <div class="mb-3 col-md-1">
                            <label class="form-label">Cant.: </label>
                            <input type="number" name="cantidad" class="form-control" id="cantidad" wire:model.defer="cantidad">
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label">Productos: </label>
                            <input type="text" name="descripcion" class="form-control" id="descripcion" wire:model.defer="descripcion">
                        </div>
                        <div class="mb-3 col-md-3">
                            <label class="form-label">Precio: </label>
                            <input type="number" name="precio" class="form-control" id="precio" wire:model.defer="precio">
                        </div>
                        <div class="mt-4 col-md-2">
                            <button type="button" class="btn btn-primary mb-2 mb-md-0 " wire:click="agregarProducto">
                                <i class="fa fa-plus-circle"></i><b> &nbsp; Agregar </b>
                            </button>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12 text-center">
                        <div class="table-responsive">
                            <table id="movimientos" class="table table-hover" style="width: 100%;">
                                <thead class="bg-primary">
                                    <tr>
                                        <th class="text-center" style="width: 15%;">Cant.</th>
                                        <th class="text-center" style="width: 50%;">Descripcion</th>
                                        <th class="text-center" style="width: 10%;">Precio</th>
                                        <th class="text-center" style="width: 20%;">Sub-Total</th>
                                        <th class="text-center" style="width: 5%;">Eliminar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($detalleProductos as $index => $detalle)
                                        <tr>
                                            <td class="text-center">
                                                {{ $detalle['cantidad'] }}
                                            </td>
                                            <td class="text-center">
                                                {{ $detalle['descripcion'] }}
                                            </td>
                                            <td class="text-center">
                                                {{ number_format($detalle['precio'],2) }}
                                            </td>
                                            <td class="text-center">
                                                {{ number_format($detalle['subtotal'],2) }}
                                            </td>
                                            <td class="text-center">
                                                <div class="row">
                                                    <button type="button" class="btn btn-primary button-icon" wire:click="editarProducto({{ $index }})">
                                                        <i class="fa fa-edit"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-danger button-icon" wire:click="eliminarProducto({{ $index }})">
                                                        <i class="fa fa-times"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <div class="ps-4 pe-4 pb-2 pt-4">
                        <div class="row ">
                            <div class="mb-3 col-md-12" style="text-align-last: right">
                                <label class="form-label">Total</label>
                                <h3 >{{number_format($total,2)}}</h3>
                                @if($total > 0)
                                    <div class="d-flex justify-content-end mt-3">
                                        <button class="btn btn-danger me-2" type="button" wire:click="registrarVenta(0)" wire:loading.attr="disabled" id="guardarCobrar">Guardar </button>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        
            <!-- Large Modal -->
            <div class="modal fade" id="modalcliente" wire:ignore.self>
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content modal-content-demo">
                        <div class="modal-header">
                            <h6 class="modal-title">Agregar Cliente</h6><button class="close" data-dismiss="modal" aria-label="Close" type="button"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body d-grid justify-items-center" >
                            <div class="row w-100 justify-content-center">
                                <div class="mb-3 col-md-6">
                                    <label class="form-label" for="nuevo_tipo_documento">Tipo de Documento</label>
                                    <select class="form-control" id="Tipodedocumento" wire:model.defer="nuevotipo_documento" data-width="100%">
                                        <option value="" @selected(old('documento')=="")>SELECCIONE</option>
                                        <option value="DNI" @selected(old('documento')=="DNI")>DNI</option>
                                        <option value="RUC" @selected(old('documento')=="RUC")>RUC</option>
                                    </select>
                                    @error('nuevotipo_documento')
                                        <span class="error-message" style="color:red">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="nuevo_documento" class="form-label">Documento</label>
                                    <div class="d-flex gap-3">
                                        <input type="text" id="nuevo_documento" class="form-control" wire:model.defer="nuevodocumento" autocomplete="off">
                                        @error('almacen_2')
                                            <span class="error-message" style="color:red">{{ $message }}</span>
                                        @enderror
                                        <button type="button" class="btn btn-primary button-icon" wire:click="searchDocumento" ><i class="fa fa-search"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="row w-100 justify-content-center">
                                <div class="mb-3 col-md-12">
                                    <label for="nuevo_nombrerazon" class="form-label">Nombre o Razon Social</label>
                                    <div class="d-flex gap-3">
                                        <input type="text" id="nuevo_nombrerazon" class="form-control" wire:model.defer="nuevonombrerazon" autocomplete="off">
                                        @error('almacen_2')
                                            <span class="error-message" style="color:red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    @if ($message = Session::get('success'))
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        {{ $message }}
                                        <button aria-label="close" class="close" data-dismiss="alert" type="button"><span aria-hidden="true">&times;</span></button>
                                        </div>
                                    @endif
                                    @if ($mensaje != "")
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        {{ $mensaje }}
                                        <button aria-label="close" class="close" data-dismiss="alert" type="button"><span aria-hidden="true">&times;</span></button>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="row w-100 justify-content-center">
                                <div class="mb-3 col-md-6">
                                    <label for="nuevodireccion" class="form-label">Direccion</label>
                                    <div class="d-flex gap-3">
                                        <input type="text" id="nuevo_direccion" class="form-control" wire:model.defer="nuevodireccion" autocomplete="off">
                                    </div>
                                </div>
                                <div class="mb-3 col-md-3">
                                    <label for="nuevotelefono" class="form-label">Telefono</label>
                                    <div class="d-flex gap-3">
                                        <input type="text" id="nuevo_telefono" class="form-control" wire:model.defer="nuevotelefono" autocomplete="off">
                                    </div>
                                </div>
                                <div class="mb-3 col-md-3">
                                    <label for="nuevocorreo" class="form-label">Correo</label>
                                    <div class="d-flex gap-3">
                                        <input type="text" id="nuevocorreo" class="form-control" wire:model.defer="nuevocorreo" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button data-dismiss="modal" aria-label="Close"class="btn btn-danger me-2" type="button">Cancelar</button>
                            <button type="button" wire:click="agregarCliente" class="btn btn-primary me-2" wire:loading.attr="disabled">Guardar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
Livewire.on('abrirmodalcliente', function () {
    $('#modalcliente').modal('show').on('shown.bs.modal', function () {
        $('#Tipodedocumento').focus();
    });
});


Livewire.on('close-modal', function (id, clientes) {
    $('#modalcliente').modal('hide');
    
    // Obtén el ID del último cliente agregado
    var ultimoClienteId = id;

    // Reinicia el selectpicker
    $('#clienteId').selectpicker('val', ''); // Establece el valor seleccionado a vacío
    $('#clienteId').selectpicker('refresh'); // Actualiza el selectpicker
    $('#clienteId').selectpicker('render'); // Vuelve a renderizar el selectpicker

    // Refresca los datos del selectpicker
    $('#clienteId').html('');
    clientes.forEach(function(cliente) {
        $('#clienteId').append('<option value="' + cliente.id + '">' + cliente.nombre + '</option>');
    });
    $('#clienteId').selectpicker('refresh');

    // Selecciona el último cliente agregado
    $('#clienteId').selectpicker('val', ultimoClienteId); // Selecciona el último cliente agregado
    $('#clienteId').selectpicker('refresh'); // Actualiza el selectpicker para mostrar el último cliente seleccionado
});

Livewire.on('abrirVenta', function (id) {
    var urlTicketPdf = `{{ url('facturacion/ticketpdf') }}/${id}`;
    window.open(urlTicketPdf, "_blank");
    eventoManejado = true; // Marcar el evento como manejado
});

</script>
@endpush
@push('style')
<style>
.dropdown-item:hover, .dropdown-item:focus {
    color: #141c2b;
    text-decoration: none;
    background-color: var(--primary02) !important;
}
.select2-results__message {
    display: none; /* Oculta el mensaje */
}
</style>
@endpush
