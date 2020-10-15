@extends('theme.frontoffice.layout.includes.main')

@section('title', 'Recetas')

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
								<td>Accion</td>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>3</td>
								<td>Andrea</td>
								<td><a href="#modal" data-prescription="1" class="modal-trigger">Ver</a></td>
							</tr>
						</tbody>
					</table>	
				</div>
			</div>
		</div>
	</div>
	<div class="modal" id="modal">
		<div class="modal-content">
			<h4>Título</h4>
			<p>Hola mundo</p>
		</div>
		<div class="modal-footer">
			<a href="#" class="modal-close waves-effect btn-flat">Cerrar</a>
			<a href="#" class="waves-effect btn-flat">Imprimir</a>
		</div>
	</div>
</div>
@endsection

@section('foot')
<script type="text/javascript">
	$('.modal').modal();	
</script>
@endsection