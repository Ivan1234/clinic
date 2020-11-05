@extends('theme.frontoffice.layout.includes.main')

@section('title', 'Agendar una cita')

@section('head')
<link rel="stylesheet" type="text/css" href="{{asset('assets/frontoffice/plugins/pickadate/themes/default.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/frontoffice/plugins/pickadate/themes/default.date.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/frontoffice/plugins/pickadate/themes/default.time.css')}}">
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
					@include('theme.includes.user.patient.schedule_form', [
						'route' => route('frontoffice.patient.store_schedule')
					])
				</div>
			</div>
		</div>



	</div>
</div>
@endsection

@section('foot')
	@include('theme.includes.user.patient.schedule_foot', [
		'material_select' => 'formSelect'
	])
@endsection