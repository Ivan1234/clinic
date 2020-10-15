@extends('theme.frontoffice.layout.includes.main')

@section('title', 'Editar Perfil')

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
						<form action="{{route('frontoffice.user.update', [$user, 'view=frontoffice'])}}" method="post" class="col s12">
							{{csrf_field()}}
							{{method_field('PUT')}}

							<div class="row">
								<div class="input-field col s12">
									<input id="name" type="text" name="name" value="{{$user->name}}">
									<label for="name">Nombre de Usuario</label>
									@error('name')
									<span class="invalid-feedback" role="alert">
										<strong style="color: red">{{$error->first('name')}}</strong>
									</span>
									@enderror							
								</div>
							</div>

							<div class="row">
								<div class="input-field col s12">
									<input id="dob" type="date" name="dob" value="{{$user->dob->format('Y-m-d')}}">
									<label for="dob">Fecha de Nacimiento</label>
									@error('dob')
									<span class="invalid-feedback" role="alert">
										<strong style="color: red">{{$error->first('dob')}}</strong>
									</span>
									@enderror							
								</div>
							</div>

							<div class="row">
								<div class="input-field col s12">
									<input id="email" type="email" name="email" value="{{$user->email}}">
									<label for="email">Correo Electrónico</label>
									@error('email')
									<span class="invalid-feedback" role="alert">
										<strong style="color: red">{{$error->first('email')}}</strong>
									</span>
									@enderror							
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