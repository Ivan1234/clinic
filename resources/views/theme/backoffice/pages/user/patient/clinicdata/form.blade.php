@extends('theme.backoffice.layout.admin')

@section('title', 'Editar historia clínica')

@section('head')
@endsection

@section('breadcrumbs')
{{-- <li><a href=""></a></li> --}}
<li><a href="{{ route('backoffice.user.index') }}">Usuarios del sistema</a></li>
<li>Historia clínica {{ $user->name }}</li>
@endsection

@section('content')
<div class="section">
	<p class="caption">Actualiza los datos de historia clínica del usuario</p>
	<div class="divider"></div>
	<div class="section">
		<div class="row">
			<div class="col s12 m8 offset-m2">
				<div class="card">
					<div class="card-content">
						<span class="card-title">Editar historia clínica</span>
						<div class="row">
							<form class="col s12" method="post" action="{{ route('backoffice.clinic_data.store', $user) }}">
								{{ csrf_field() }}

								<div class="row">
									<div class="input-field col s12">
										<input
										id="check_in"
										type="date"
										name="check_in"
										value="{{ $user->clinic_data('check_in', $datas) }}"
										>
										<label for="check_in">Fecha de alta</label>
										@if ($errors->has('check_in'))
										<span class="invalid-feedback" role="alert">
											<strong style="color: red">{{ $errors->first('check_in') }}</strong>
										</span>
										@endif
									</div>
								</div>

								<div class="row">
									<div class="input-field col s12">
										<input
										id="scholarship"
										type="text"
										name="scholarship"
										value="{{ $user->clinic_data('scholarship', $datas) }}"
										>
										<label for="scholarship">Escolaridad</label>
										@if ($errors->has('scholarship'))
										<span class="invalid-feedback" role="alert">
											<strong style="color: red">{{ $errors->first('scholarship') }}</strong>
										</span>
										@endif
									</div>
								</div>

								<div class="row">
									<div class="input-field col s12">
										<button class="btn waves-effect waves-light right" type="submit">Actualizar
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