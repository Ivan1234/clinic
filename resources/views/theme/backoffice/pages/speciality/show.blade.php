@extends('theme.backoffice.layout.admin')

@section('title', $speciality->name)

@section('head')
@endsection

@section('breadcrums')
<!-- <li><a href=""></a></li> -->
<li><a href="{{ route('backoffice.speciality.index') }}">Especialidades Médicas</a></li>
<li><a href="" class="active">{{ $speciality->name }}</a></li>
@endsection

@section('dropdown_settings')
<!-- <li><a href="" class="grey-text text-darken-2"></a></li> -->
<li><a href="{{ route('backoffice.speciality.edit', $speciality) }}" class="grey-text text-darken-2">Editar especialidad</a></li>
@endsection

@section('content')
<div class="section">
	<p class="caption"><strong>Especialidad: </strong>{{$speciality -> name}}</p>
	<div class="divider"></div>
	<div id="basic-form" class="section">
		<div class="row">
			<div class="col s12 m8 offset-m2">
				<div class="card">
					<div class="card-content">
						<span class="card-title">{{$speciality -> name}}</span>		
						<table>
							<thead>
								<tr>
									<th>ID</th>
									<th>Nombre</th>
									<th>Correo</th>
								</tr>
							</thead>
							<tbody>
								@forelse($users as $user)
								<tr>
									<td>{{$user->id}}</td>
									<td>
										<a href="{{route('backoffice.user.show', $user)}}" target="_blanck">{{$user->name}}</a>
									</td>
									<td>{{$user->email}}</td>
								</tr>
								@empty
								<tr>
									<td colspan="3">No hay médicos registrados</td>
								</tr>
								@endforelse
							</tbody>
						</table>			
					</div>
					<div class="card-action">
						<a href="{{ route('backoffice.speciality.edit', $speciality) }}">EDITAR</a>
						<a href="#" style="color: red" onclick="enviar_formulario()">ELIMINAR</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<form method="post" action="{{route('backoffice.speciality.destroy', $speciality)}}" name="delete_form">
	{{csrf_field()}}
	{{method_field('DELETE')}}
	
</form>
@endsection

@section('foot')
<script type="text/javascript">
	function enviar_formulario()
	{		
		Swal.fire({
			title: '¿Deseas eliminar esta especialidad?',
			text: "¡Esta acción no se puede deshacer!",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Si, continuar'
		}).then((result) => {
			if (result.isConfirmed) {

				document.delete_form.submit();

			}else{
				Swal.fire(
					'Operación cancelada',
					'Registro no eliminado',
					'error'
				)
			}
		})
	}
</script>
@endsection