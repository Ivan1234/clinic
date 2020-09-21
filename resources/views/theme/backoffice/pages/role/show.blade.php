@extends('theme.backoffice.layout.admin')

@section('title', 'Este es el título')

@section('head')
@endsection

@section('breadcrums')
<!-- <li><a href=""></a></li> -->
<li><a href="{{ route('backoffice.role.index') }}">Roles del sistema</a></li>
<li>{{ $role->name }}</li>
@endsection

@section('content')
<div class="section">
	<p class="caption"><strong>Rol: </strong>{{$role -> name}}</p>
	<div class="divider"></div>
	<div id="basic-form" class="section">
		<div class="row">
			<div class="col s12 m8 offset-m2">
				<div class="card">
					<div class="card-content">
						<span class="card-title">Usuarios con el rol de {{$role -> name}}</span>
						<p><strong>Slug: </strong>{{$role->slug}}</p>
						<p><strong>Descripción: </strong>{{$role->description}}</p>						
					</div>
					<div class="card-action">
						<a href="{{ route('backoffice.role.edit', $role) }}">EDITAR</a>
						<a href="#" style="color: red" onclick="enviar_formulario()">ELIMINAR</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<form method="post" action="{{route('backoffice.role.destroy', $role)}}" name="delete_form">
	{{csrf_field()}}
	{{method_field('DELETE')}}
	
</form>
@endsection

@section('foot')
<script type="text/javascript">
	function enviar_formulario()
	{		
		Swal.fire({
			title: '¿Deseas eliminar este rol?',
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