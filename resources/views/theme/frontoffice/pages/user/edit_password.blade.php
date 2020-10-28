@extends('theme.frontoffice.layout.includes.main')

@section('title', 'Modificar contraseña')

@section('head')
@endsection

@section('nav')
@endsection

@section('content')
<div class="container">
	<div class="row">
		@include('theme.frontoffice.pages.user.includes.nav')

		<!-- sección principal -->
		<div class="col s12 m8">
			<div class="card">				
				<div class="card-content">
					<span class="card-title">@yield('title')</span>
					<div class="row">
						<form action="{{route('frontoffice.user.change_password')}}" method="post" class="col s12">
							{{csrf_field()}}
							{{method_field('PUT')}}

							<div class="row">
								<div class="input-field col s12">
									<input id="old_password" type="password" name="old_password">
									<label for="old_password">Contraseña actual</label>
									@error('old_password')
									<span class="invalid-feedback" role="alert">
										<strong style="color: red">{{$message}}</strong>
									</span>
									@enderror							
								</div>
							</div>

							<div class="row">
								<div class="input-field col s12">
									<input id="password" type="password" name="password">
									<label for="password">Nueva contraseña</label>
									@error('password')
									<span class="invalid-feedback" role="alert">
										<strong style="color: red">{{$message}}</strong>
									</span>
									@enderror							
								</div>
							</div>

							<div class="row">
								<div class="input-field col s12">
									<input id="password-confirm" type="password" name="password_confirmation">
									<label for="password-confirm">Confirmar contraseña</label>						
								</div>
							</div>

							<div class="row">
								<div class="input-field col s12">
									<button class="btn waves-effect waves-light right" type="submit">
										Actualizar <i class="material-icons right">send</i>
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
@endsection

@section('foot')
@endsection