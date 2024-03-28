<div>

    <div class="form-group row">
        <label class="col-md-3 form-control-label" for="dni">Número documento</label>
        <div class="col-md-9">
            <input type="text" wire:model.lazy="search" value="{{$search}}" id="num_documento" name="num_documento" class="form-control" placeholder="Ingrese el número documento"">

            @error('num_documento')
                <span class="error-message" style="color:red">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="form-group row">
        <label class="col-md-3 form-control-label" for="nombre">Nombre</label>
        <div class="col-md-9">
            <input type="text" value="{{$razonsocial}}"  id="nombre" name="nombre" class="form-control">
            @error('nombre')
                <span class="error-message" style="color:red">{{ $message }}</span>
            @enderror
        </div>
    </div>
    @if ($mensaje != "")
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ $mensaje }}
        <button aria-label="Close" class="btn-close" data-bs-dismiss="alert" type="button"><span aria-hidden="true">&times;</span></button>
    </div>
    @endif

</div>
