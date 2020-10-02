@extends('theme.backoffice.layout.admin')

@section('title', 'Dar de alta nuevo usuario')

@section('head')
@endsection

@section('breadcrums')
<!-- <li><a href=""></a></li> -->
<li><a href="{{ route('backoffice.user.index') }}">Usuarios del sistema</a></li>
<li>Crear usuario</li>
@endsection


@section('content')
<div class="section">
	<p class="caption">Introduce los datos para crear un nuevo usuario</p>
	<div class="divider"></div>

	<div id="basic-form" class="section">
		<div class="row">
			<div class="col s12 m8 offset-m2">
				<div class="card">
					<div class="card-content">
						<span class="card-title">Crear usuario</span>
						<div class="row">
							<form class="col s12" method="post" action="{{ route('backoffice.user.store') }}">
								{{ csrf_field() }}

								<div class="row">
									<div class="input-field col s12">
										<select id="role" name="role" required="">
											<option value="" disabled="" selected="">-- Selecciona un rol --</option>
											@foreach($roles as $role)
											<option value="{{$role->id}}">{{$role->name}}</option>
											@endforeach

										</select>
										@error('role')
										<span class="invalid-feedback" role="alert">
											<strong style="color: red">{{ $message }}</strong>
										</span>
										@enderror
									</div>
								</div>

								<div class="row">
									<div class="input-field col s12">
										<input id="name" type="text" name="name">
										<label for="name">Nombre del usuario</label>
										@error('name')
										<span class="invalid-feedback" role="alert">
											<strong style="color: red">{{ $message }}</strong>
										</span>
										@enderror
									</div>
								</div>

								<div class="row">
									<div class="input-field col s12">
										<input id="dob" type="date" name="dob">										
										@error('dob')
										<span class="invalid-feedback" role="alert">
											<strong style="color: red">{{ $message }}</strong>
										</span>
										@enderror
									</div>
								</div>

								<div class="row">
									<div class="input-field col s12">
										<input id="email" type="email" name="email">
										<label for="email">Correo eletrónico</label>
										@error('email')
										<span class="invalid-feedback" role="alert">
											<strong style="color: red">{{ $message }}</strong>
										</span>
										@enderror
									</div>
								</div>

								<div class="row">
									<div class="input-field col s12">
										<input id="password" type="password" name="password">
										<label for="password">Contraseña</label>
										@error('password')
										<span class="invalid-feedback" role="alert">
											<strong style="color: red">{{ $message }}</strong>
										</span>
										@enderror
									</div>
								</div>

								<div class="row">
									<div class="input-field col s12">
										<input id="password_confirmation" type="password" name="password_confirmation">
										<label for="password_confirmation">Confirmar contraseña</label>
										@error('password_confirmation')
										<span class="invalid-feedback" role="alert">
											<strong style="color: red">{{ $message }}</strong>
										</span>
										@enderror
									</div>
								</div>

								<div class="row">
									<div class="input-field col s12">
										<button class="btn waves-effect waves-light right" type="submit">Guardar
											<i class="material-icons right">send</i>
										</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('foot')
@endsection