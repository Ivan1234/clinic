@extends('theme.backoffice.layout.admin')
@section('title', 'Gestión de horarios')
@section('head')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/datepicker/jquery-ui.multidatespicker.css') }}">
@endsection
@section('breadcrumbs')
{{-- <li><a href=""></a></li> --}}
@endsection
@section('content')
<div class="section">
	<p class="caption">Establece los horarios para el médico</p>
	<div class="divider"></div>
	<div class="section">
		<div class="row">
			<div class="col s12 m8 offset-m2">
				<div class="card">
					<div class="card-content">
						<span class="card-title">Gestión de horarios</span>
						<div class="row">
							<form class="col s12" method="post" action="{{ route('backoffice.doctor.schedule.assign', $user) }}">
								{{ csrf_field() }}
								{{-- Inputs para gestionar los horarios base --}}
								<div class="row">
									<div class="input-field col m12">
										<input id="multi_date_input" name="multi_date_input" readonly="" placeholder="Seleccione los días de asueto y vacaciones" id="days_off" type="text" class="validate">
										<label for="days_off">Días de asueto</label>
									</div>
								</div>
								<div class="row">
									<div class="input-field col s12">
										<select id="week_days_off" name="week_days_off[]" required="" multiple>
											<option value="" disabled selected>Selecciona los días no laborables</option>
											<option value="1">Domingo</option>
											<option value="2">Lunes</option>
											<option value="3">Martes</option>
											<option value="4">Miércoles</option>
											<option value="5">Jueves</option>
											<option value="6">Viernes</option>
											<option value="7">Sábado</option>
										</select>
										<label>Días no laborables</label>
									</div>
								</div>
								@foreach($days as $key => $day)
								<div class="row">
									<div class="col s2">
										<p>{{ $day }}</p>
									</div>
									<div class="col s2">
										<input id="{{ $key }}-turn_a_in" type="time" name="{{ $key }}-turn_a_in">
										<label for="{{ $key }}-turn_a_in">Turno A Entrada</label>
									</div>
									<div class="col s2">
										<input id="{{ $key }}-turn_a_out" type="time" name="{{ $key }}-turn_a_out">
										<label for="{{ $key }}-turn_a_out">Turno A Salida</label>
									</div>
									<div class="col s2">
										<input id="{{ $key }}-turn_b_in" type="time" name="{{ $key }}-turn_b_in">
										<label for="{{ $key }}-turn_b_in">Turno B Entrada</label>
									</div>
									<div class="col s2">
										<input id="{{ $key }}-turn_b_out" type="time" name="{{ $key }}-turn_c_out">
										<label for="{{ $key }}-turn_b_out">Turno B Salida</label>
									</div>
								</div>
								@endforeach
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
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<script src="{{ asset('assets/plugins/datepicker/jquery-ui.multidatespicker.js') }}"></script>
<script type="text/javascript">
$('#multi_date_input').multiDatesPicker({
dateFormat: "yy/m/d-",
});
</script>
@endsection