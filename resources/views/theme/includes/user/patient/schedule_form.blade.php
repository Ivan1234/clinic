<form action="{{$route}}" method="post">
	{{csrf_field()}}

	@if(!isset($appointment))
	<div class="row">
		<div class="input-field col s12">
			<i class="material-icons prefix">people</i>
			<select id="speciality" name="speciality">
				@foreach($specialities as $speciality)
				<option value="{{$speciality->id}}">{{$speciality->name}}</option>
				@endforeach
			</select>
			<label>Selecciona la especialidad</label>
		</div>								
	</div>

	<div class="row">
		<div class="input-field col s12">
			<i class="material-icons prefix">people</i>
			<select id="doctor" name="doctor">
				<option disabled="" selected="">-- Primero selecciona una especialidad --</option>
			</select>
			<label>Selecciona al doctor</label>
		</div>								
	</div>

	@else

	<div class="row">
		<div class="input-field col s12">
			<i class="material-icons prefix">hourglass_full</i>
			<select id="status" name="status">
				<option disabled="" selected="">-- Selecciona un status --</option>
				<option value="pending" @if($appointment->status=='pending')selected @endif>Pendiente</option>
				<option value="done" @if($appointment->status=='done')selected @endif>Terminada</option>
				<option value="cancelled" @if($appointment->status=='cancelled')selected @endif>Cancelada</option>
			</select>
			<label>Selecciona el estatus de la cita</label>
		</div>								
	</div>

	@endif

	<div class="input-field col s12 m6">								
		<i class="material-icons prefix">today</i>
		<input id="datepicker" type="text" name="date" class="datepicker" placeholder="Selecciona una fecha" @if(isset($appointment)) data-value="{{$appointment->date->format('Y-m-d')}}" @endif>

	</div>
	<div class="input-field col s12 m6">
		<i class="material-icons prefix">access_time</i>
		<input id="timepicker" type="text" name="time" class="timepicker" placeholder="Selecciona un horario" @if(isset($appointment)) data-value="{{$appointment->date->format('H:i')}}" @endif>

	</div>

	<input type="hidden" name="user_id" value="{{encrypt($user->id)}}">

	<div class="row">
		<button class="btn waves-effect waves-light" type="submit">Agendar <i class="material-icons right">send</i></button>
	</div>
</form>