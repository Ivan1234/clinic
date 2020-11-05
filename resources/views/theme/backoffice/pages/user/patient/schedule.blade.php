@extends('theme.backoffice.layout.admin')

@section('title', 'Agendar Cita para: ' . $user->name)

@section('head')
<link rel="stylesheet" type="text/css" href="{{asset('assets/frontoffice/plugins/pickadate/themes/default.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/frontoffice/plugins/pickadate/themes/default.date.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/frontoffice/plugins/pickadate/themes/default.time.css')}}">
@endsection

@section('breadcrums')
<!-- <li><a href=""></a></li> -->
<li><a href="{{ route('backoffice.user.index') }}">Usuarios del sistema</a></li>
<li><a href="{{route('backoffice.user.show', $user)}}">{{ $user->name }}</a></li>
<li><a href="">Agendar Cita</a></li>
@endsection

@section('dropdown_settings')
<!-- <li><a href="" class="grey-text text-darken-2"></a></li> -->
<li><a href="{{route('backoffice.user.edit', $user)}}" class="grey-text text-darken-2">Editar usuario</a></li>
@endsection

@section('content')
<div class="section">
	<p class="caption"><strong>Usuario: </strong>{{$user -> name}}</p>
	<div class="divider"></div>
	<div id="basic-form" class="section">
		<div class="row">
			<div class="col s12 m8">
				<div class="card">

					<div class="card-content">
						<span class="card-title">@yield('title')</span>
						@include('theme.includes.user.patient.schedule_form', [
							'route' => route('backoffice.patient.store_back_schedule', $user)
						])
					</div>
				</div>
			</div>


			<div class="col s12 m4">
				@include('theme.backoffice.pages.user.includes.user_nav')
			</div>
		</div>
	</div>
</div>	

@endsection

@section('foot')
	@include('theme.includes.user.patient.schedule_foot', [
		'material_select' => 'material_select'
	])
@endsection