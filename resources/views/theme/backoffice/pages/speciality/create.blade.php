@extends('theme.backoffice.layout.admin')

@section('title', 'Crear Especialidad')

@section('head')
@endsection

@section('breadcrums')
<!-- <li><a href=""></a></li> -->
<li><a href="{{ route('backoffice.speciality.index') }}">Especialidades Médicas</a></li>
<li><a href="" class="active">Crear Especialidad</a></li>
@endsection


@section('content')
<div class="section">
	<p class="caption">Introduce los datos para crear una nueva especialidad médica.</p>
	<div class="divider"></div>

	<div id="basic-form" class="section">
		<div class="row">
			<div class="col s12 m8 offset-m2">
				<div class="card">
					<div class="card-content">
						<span class="card-title">Crear Especialidad</span>
						<div class="row">
							<form class="col s12" method="post" action="{{ route('backoffice.speciality.store') }}">
								{{ csrf_field() }}

								<div class="row">
									<div class="input-field col s12">
										<input id="name" type="text" name="name">
										<label for="name">Nombre de la especialidad</label>
										@error('name')
										<span class="invalid-feedback" role="alert">
											<strong style="color: red">{{ $message }}</strong>
										</span>
										@enderror
									</div>
								</div>
								<div class="row">
									<div class="row">
										<div class="input-field col s12">
											<button class="btn waves-effect waves-light right" type="submit">Guardar
												<i class="material-icons right">send</i>
											</button>
										</div>
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