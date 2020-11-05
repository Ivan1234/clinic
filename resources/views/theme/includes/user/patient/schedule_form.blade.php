<form action="{{$route}}" method="post">
	{{csrf_field()}}
	<div class="row">
		<div class="row">
			<div class="input-field col s12">
				<i class="material-icons prefix">people</i>
				<select id="speciality" name="speciality">
					<option disabled="" selected="">-- Selecciona una especialidad --</option>
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

		<div class="input-field col s12 m6">								
			<i class="material-icons prefix">today</i>
			<input id="datepicker" type="text" name="date" class="datepicker" placeholder="Selecciona una fecha">
			
		</div>
		<div class="input-field col s12 m6">
			<i class="material-icons prefix">access_time</i>
			<input id="timepicker" type="text" name="time" class="timepicker" placeholder="Selecciona un horario">
			
		</div>
	</div>

	<input type="hidden" name="user_id" value="{{encrypt($user->id)}}">

	<div class="row">
		<button class="btn waves-effect waves-light" type="submit">Agendar <i class="material-icons right">send</i></button>
	</div>
</form>