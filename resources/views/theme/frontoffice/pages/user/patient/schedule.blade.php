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
					<form action="#" method="post">
						{{csrf_field()}}
						<div class="row">
							<div class="row">
								<div class="input-field col s12">
									<i class="material-icons prefix">people</i>
									<select name="doctor">
										<option value="1">Internistas</option>
										<option value="2">Pediatras</option>
										<option value="1">Ondontólogos</option>
									</select>
									<label>Selecciona la especialidad</label>
								</div>								
							</div>

								<div class="row">
								<div class="input-field col s12">
									<i class="material-icons prefix">people</i>
									<select name="doctor">
										<option value="1">Raúl</option>
										<option value="2">Andrea</option>
										<option value="1">José</option>
									</select>
									<label>Selecciona al doctor</label>
								</div>								
							</div>

							<div class="input-field col s12 m6">								
								<i class="material-icons prefix">today</i>
								<input id="datepicker" type="text" name="date" class="datepicker" placeholder="Selecciona una fecha">
								
							</div>
							<div class="input-field col s12 m6">
								<i class="material-icons prefix">access_time</i>
								<input id="timepicker" type="text" name="time" class="timepicker" placeholder="Selecciona un horario">
								
							</div>
						</div>
						<div class="row">
							<button class="btn waves-effect waves-light" type="submit">Agendar <i class="material-icons right">send</i></button>
						</div>
					</form>
				</div>
			</div>
		</div>



	</div>
</div>
@endsection

@section('foot')
<script type="text/javascript" src="{{asset('assets/frontoffice/plugins/pickadate/legacy.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/frontoffice/plugins/pickadate/picker.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/frontoffice/plugins/pickadate/picker.date.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/frontoffice/plugins/pickadate/picker.time.js')}}"></script>
<script type="text/javascript">
	$('select').formSelect();

	var input_date = $('.datepicker').pickadate({
		min: true
	});

	var date_picker = input_date.pickadate('picker');

	var input_time = $('.timepicker').pickatime({
		min: 4
	});

	var time_picker = input_time.pickatime('picker');

</script>
@endsection