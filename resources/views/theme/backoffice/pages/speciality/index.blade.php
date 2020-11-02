@extends('theme.backoffice.layout.admin')

@section('title', 'Especialidades Médicas')

@section('head')
@endsection

@section('breadcrums')
<!-- <li><a href=""></a></li> -->
<li><a href="{{ route('backoffice.speciality.index') }}" class="active">Especialidades Médicas</a></li>
@endsection

@section('dropdown_settings')
<!-- <li><a href="" class="grey-text text-darken-2"></a></li> -->
<li><a href="{{ route('backoffice.speciality.create') }}" class="grey-text text-darken-2">Crear especialidad</a></li>
@endsection

@section('content')
<div class="section">
	<p class="caption"><strong>Especialidades Médicas</p>
		<div class="divider"></div>

		<div id="basic-form" class="section">
			<div class="row">
				<div class="col s12">
					<div class="card-content">	
						<table>
							<thead>
								<tr>
									<th>Nombre</th>
									<th># de médicos</th>
									<th>Acciones</th>
								</tr>
							</thead>
							<tbody>

								@foreach($specialities as $speciality)									
								<tr>
									<td><a href="{{route('backoffice.speciality.show', $speciality)}}">{{$speciality->name}}</a></td>
									<td>{{$speciality->users->count()}}</td>
									<td><a href="{{route('backoffice.speciality.edit', $speciality)}}">Editar</a></td>
								</tr>
								@endforeach
								
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