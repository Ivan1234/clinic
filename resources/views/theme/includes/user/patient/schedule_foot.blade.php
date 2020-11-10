<script type="text/javascript" src="{{asset('assets/frontoffice/plugins/pickadate/legacy.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/frontoffice/plugins/pickadate/picker.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/frontoffice/plugins/pickadate/picker.date.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/frontoffice/plugins/pickadate/picker.time.js')}}"></script>
<script type="text/javascript">
	

	var input_date = $('.datepicker').pickadate({
		min: true,
		formatSubmit: 'yyyy-m-d'
	});

	var date_picker = input_date.pickadate('picker');

	var input_time = $('.timepicker').pickatime({
		min: [7, 30],
		max: [21, 0],
		formatSubmit: 'HH:i',
	});

	var time_picker = input_time.pickatime('picker');

	@if(!isset($appointment))
	$('select').{!!$material_select!!}();
	var speciality = $('#speciality');
	var doctor = $('#doctor');

	speciality.change(function(){
		$.ajax({
			url: "{{route('ajax.user_speciality')}}",
			method: 'GET',
			data: {
				speciality: speciality.val(),
			},
			success: function(data){
				doctor.empty();

				doctor.append('<option disabled selected>-- Selecciona un médico --</option>');

				$.each(data, function(index, element){
					doctor.append('<option value="'+ element.id +'">'+ element.name +'</option>');
				});

				doctor.{!!$material_select!!}();
			}
		});
	});

	// Esta sentencia se ejecuta cuando el usuario selecciona el médico
	doctor.change(function(){
		// Limpiamos ambos campos de input
		date_picker.set('clear');
		time_picker.set('clear');
		//Realizamos la petición ajax
		$.ajax({
			// Ruta para procesar la solicitud
			url: "{{ route('ajax.doctor.disable_dates') }}",
			//Como parámetro enviamos el id del doctor
			data: {
				doctor: doctor.val(),
			},
			// Acciones a realizar si la solicitud es satisfactoria.
			success: function(data){
				// Limpiamos el campo de tiempo por cualquier cosa.
				time_picker.set('clear');
				// Establecemos la fechas deshabilitadas
				disable_dates = data.disable_dates.split('-');
				dates_count = disable_dates.length;
				disable_dates_arr = []; // Tantas filas como fechas y tres columnas
				// Ahora tenemos que crear nuestro arreglo de dos dimensiones
				$.each(disable_dates, function( i, x ) { //Primero recorremos nuestro arreglo de fechas
					//Con split convertimos en arreglo el string indicando el divisor que es la coma
					date_arr = x.split(',');
					//Después declaramos nuestro arreglo de elementos
					elem_arr = [];
					$.each(date_arr, function(j, y){
						//Convertimos cada elemento ()y,m,d) a entero
						elem = parseInt(y);
						// Añadimos cada elemento a un arreglo
						elem_arr.push(elem);
					});
					//Después añadimos nuestro arreglo de elementos a nuestro arreglo de fechas
					disable_dates_arr.push(elem_arr);
				});
				//arreglo de days_off
				days_off = data.days_off.split('-');
				$.each(days_off, function(k,z){
					day = parseInt(z);
					disable_dates_arr.push(day);
				});
				// En este aprtado especificamos las fechas que deseamos deshabilitar
				date_picker.set({
					disable: disable_dates_arr
				});
			}
		});
	});
	@endif	
</script>