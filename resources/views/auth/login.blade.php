@extends('auth.contenido')

@section('login')

	<section class="h-100">
		<div class="container h-100" style="padding-top: 5%;">
			<div class="row justify-content-md-center h-100">
				<div class="card-wrapper">
					<div class="brand" >
						<img src="{{asset('img/logogo.png')}}" alt="logo">
					</div>
					<div class="card fat">
					<form class="form-horizontal was-validated" method="post" action="{{route('login')}}">
            
          			{{ csrf_field() }}
						<div class="card-body">
							<h4 class="card-title" style="color:#000">Iniciar Sesión</h4>

							<div class="form-group {{$errors->has('usuario' ? 'is-invalid' : '')}}">
							<b><label for="sucursal" style="color:#000">tienda:</label></b>
								<select class="form-control" style="text-transform: uppercase; padding:5px" name="idSucursal" id="idSucursal" data-live-search="true" required>
									<option  value="0" disabled >SELECCIONE </option>
									
									@foreach($sucursales as $suc)
										<option value='{{$suc->id}}' selected>{{$suc->nombre}}</option>
									@endforeach
								</select>
							
							</div>

								<div class="form-group {{$errors->has('usuario' ? 'is-invalid' : '')}}">
								<b><label for="email" style="color:#000">Usuario:</label></b>
									<input type="text"value="{{old('usuario')}}" name="usuario" id="usuario" class="form-control" placeholder="Usuario">
									{!!$errors->first('usuario','<span class="invalid-feedback">:message</span>')!!}
								</div>

								<div class="form-group {{$errors->has('password' ? 'is-invalid' : '')}}">
									<b><label for="password" style="color:#000">Contraseña:</label></b>
									<input type="password" name="password" id="password" class="form-control" placeholder="Password" data-eye>
								    {!!$errors->first('password','<span class="invalid-feedback">:message</span>')!!} 
								</div>

								

								<div class="fdsaorm-group m-0">
									<button type="submit" class="btn btn-success btn-block">
										Iniciar Sesión
									</button>
								</div>
								
							</form>
						</div>
					</div>
					<div class="footer">
					</div>
				</div>
			</div>
		</div>
	</section>
@endsection
