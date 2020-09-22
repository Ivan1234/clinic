@extends('theme.backoffice.layout.admin')

@section('title', 'Crear permiso')

@section('head')
@endsection

@section('breadcrums')
<!-- <li><a href=""></a></li> -->
<li>Crear permiso</li>
@endsection


@section('content')
<div class="section">
	<p class="caption">Introducce los datos para crear un nuevo permiso</p>
	<div class="divider"></div>

	<div id="basic-form" class="section">
		<div class="row">
			<div class="col s12 m8 offset-m2">
				<div class="card">
					<div class="card-content">
						<span class="card-title">Crear Permiso</span>
						<div class="row">
							<form class="col s12" method="post" action="{{ route('backoffice.permission.store') }}">
								{{ csrf_field() }}

								<div class="row">
									<div class="input-field col s12">
										<input id="name" type="text" name="name">
										<label for="name">Nombre del permiso</label>
										@error('name')
										<span class="invalid-feedback" role="alert">
											<strong style="color: red">{{ $message }}</strong>
										</span>
										@enderror
									</div>
								</div>
								<div class="row">
									<div class="input-field col s12">
										<select name="role_id">
											<option value="" disabled="" selected="">Selecciona un rol</option>
											@foreach ($roles as $role)
											<option value="{{ $role->id }}">{{ $role->name }}</option>
											@endforeach
										</select>
										@error('role_id')
										<span class="invalid-feedback" role="alert">
											<strong style="color: red">{{ $message }}</strong>
										</span>
										@enderror
									</div>
								</div>
								<div class="row">
									<div class="input-field col s12">
										<textarea id="description" class="materialize-textarea" name="description"></textarea>
										<label for="description">Descripción del permiso</label>
										@error('description')
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