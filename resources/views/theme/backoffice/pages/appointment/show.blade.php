@extends('theme.backoffice.layout.admin')

@section('title', 'Citas programadas')

@section('head')
<link rel="stylesheet" type="text/css" href="{{asset('assets/plugins/fullcalendar/lib/main.css')}}">
@endsection

@section('breadcrums')
<!-- <li><a href=""></a></li> -->
<li><a href="">Citas programadas</a></li>
@endsection

@section('dropdown_settings')
<!-- <li><a href="" class="grey-text text-darken-2"></a></li> -->
@endsection

@section('content')
<div class="section">
	<div class="row">
		<div class="col s12">
			<div class="card">
				<div class="card-content">
					<div id="calendar"></div>
				</div>
			</div>
		</div>
	</div>	
</div>
@endsection

@section('foot')
<script type="text/javascript" src="{{asset('assets/plugins/fullcalendar/lib/main.js')}}"></script>
<script>
	document.addEventListener('DOMContentLoaded', function() {
		var calendarEl = document.getElementById('calendar');

		var calendar = new FullCalendar.Calendar(calendarEl, {
			headerToolbar: {
				left: 'prev,next today',
				center: 'title',
				right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
			},
      navLinks: true, // can click day/week names to navigate views
      businessHours: true, // display business hours
      editable: false,
      selectable: true,
      events: {!! $appointments !!} 
    });

		calendar.render();
	});

</script>
@endsection