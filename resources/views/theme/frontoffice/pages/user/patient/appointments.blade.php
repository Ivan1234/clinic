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
								<td>Hora</td>
								<td>Estado</td> <!-- Finalizado, Pagado, Pendiente, Cancelado -->
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>1</td>
								<td>Raúl</td>
								<td>15 de Junio del 2020</td>
								<td>17:00 hrs</td>
								<td>Pagado</td>
							</tr>
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