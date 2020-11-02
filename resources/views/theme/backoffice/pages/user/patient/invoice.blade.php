@extends('theme.backoffice.layout.admin')

@section('title', 'Facturas de: ' . $user->name)

@section('head')
@endsection

@section('breadcrums')
<!-- <li><a href=""></a></li> -->
<li><a href="{{ route('backoffice.user.index') }}">Usuarios del sistema</a></li>
<li><a href="{{ route('backoffice.user.show', $user) }}">{{$user->name}}</a></li>
<li><a href="{{ route('backoffice.patient.invoices', $user) }}">{{'Facturas de: ' . $user->name}}</a></li>
@endsection

@section('dropdown_settings')
<!-- <li><a href="" class="grey-text text-darken-2"></a></li> -->
<li><a href="{{route('backoffice.patient.schedule', $user)}}" class="grey-text text-darken-2">Agendar nueva cita</a></li>
<li><a href="" class="grey-text text-darken-2">Añadir Factura</a></li>
@endsection

@section('content')
<div class="section">
	<p class="caption"><strong>{{'Facturas de: ' . $user->name}}</strong></p>
	<div class="divider"></div>		
	<div class="section" id="basic-form">
		<div class="row">
			<div class="col s12 m8">
				<div class="card-content">	
					<table>
						<thead>
							<tr>
								<th>ID</th>
								<th>Monto</th>
								<th>Fecha</th>
								<th>Estado</th>
								<th>Acciones</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>745</td>
								<td>500$</td>
								<td>25/02/2020</td>
								<td>En progreso</td>
								<td><a href="">Editar</a></td>
							</tr>
						</tbody>
					</table>
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
@endsection