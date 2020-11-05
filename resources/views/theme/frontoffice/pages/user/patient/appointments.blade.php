@extends('theme.frontoffice.layout.includes.main')

@section('title', 'Mis citas')

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
					<table>
						<thead>
							<tr>
								<td>ID</td>
								<td>Especialista</td>
								<td>Fecha</td>
								<td>Estado</td> <!-- Finalizado, Pagado, Pendiente, Cancelado -->
							</tr>
						</thead>
						<tbody>
							@forelse($appointments as $appointment)
							<tr>
								<td>{{$appointment->id}}</td>
								<td>{{$appointment->doctor()->name}}</td>
								<td>{{$appointment->date->format('d/m/Y H:i')}}</td>
								<td>{{$appointment->status}}</td>
							</tr>
							@empty
							<tr>
								<td colspan="4">No hay citas registradas</td>
							</tr>
							@endforelse
								
													
						</tbody>
					</table>					
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('foot')
@endsection