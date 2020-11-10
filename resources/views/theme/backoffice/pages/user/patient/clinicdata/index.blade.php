@extends('theme.backoffice.layout.admin')
@section('title', 'Historia clínica de ' . $user->name )
@section('head')
@endsection
@section('breadcrumbs')
{{-- <li><a href=""></a></li> --}}
<li><a href="{{ route('backoffice.user.index') }}">Usuarios del sistema</a></li>
<li><a href="{{ route('backoffice.user.show', $user) }}">{{ $user->name }}</a></li>
<li><a href="{{ route('backoffice.patient.appointments', $user) }}">{{ 'Historia clínica de ' . $user->name }}</a></li>
@endsection
@section('dropdown_settings')
{{-- <li><a href="" class="grey-text text-darken-2"></a></li> --}}
@endsection
@section('content')
<div class="section">
	<p class="caption"><strong>{{ 'Historia clínica de ' . $user->name }}</p>
		<div class="divider"></div>
		<div id="basic-form" class="section">
			<div class="row">
				<div class="col s12 m3">
					<div class="card">
						<div class="card-content">
							<span class="card-title ">Historia Clínica</span>
							{{-- Aquí va el contenido de la historia clínica--}}
							<p><strong>Fecha de alta: </strong> {{ carbon_format($user->clinic_data('check_in', $datas), 'd/m/Y') }}</p>
							<p><strong>Escolaridad: </strong>{{ $user->clinic_data('scholarship', $datas) }}</p>
						</div>
					</div>
				</div>
				<div class="col s12 m6">
					<div class="card">
						<div class="card-content">
							<span class="card-title ">Notas de evolución</span>
							<form action="{{ route('backoffice.clinic_note.store', $user) }}" method="POST">
								{{ csrf_field() }}
								<div class="row">
									<div class="input-field col s12">
										<textarea id="description" name="description" class="materialize-textarea"></textarea>
										<label for="description">Escribe la nota médica aquí.</label>
									</div>
								</div>
								<div class="row">
									<div class="col s8">
										<div>
											<div class="input-field col s12">
												<select id="privacy" name="privacy">
													<option value="" disabled selected>Selecciona la opción de privacidad</option>
													<option value="public">Pública</option>
													<option value="private">Privada</option>
												</select>
											</div>
										</div>
									</div>
									<div class="col s4">
										<div class="row">
											<div class="input-field col s12">
												<button class="btn waves-effect waves-light right" type="submit" style="width: 100%">
													Guardar
													<i class="material-icons right">send</i>
												</button>
											</div>
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
					<div class="card">
						<div class="card-content">
							<table class="striped highlight">
								<thead>
									<tr>
										<th width="90%">Notas: </th>
										<th width="10%"></th>
									</tr>
								</thead>
								<tbody>
									@forelse($clinic_notes as $note)
									<tr>
										<td>
											<p>Creado por <b>{{ $note->creator->name }}</b> el <b>{{ carbon_format($note->date, 'd/m/Y') }}</b> a las <b>{{ carbon_format($note->date, 'H:i') }}</b></p>
											<b>Descripción: </b> {!! $note->description !!}
										</td>
										<td>
											<p>
												<a href="#modal" data-note="{{ $note->id }}" onclick="modal_note(this)" class="modal-trigger" >
													Editar
												</a>
											</p>
										</td>
									</tr>
									@empty
									<tr>
										<td colspan="2">No hay notas registradas</td>
									</tr>
									@endforelse
								</tbody>
							</table>
						</div>
						<div class="modal" id="modal">
							<div class="modal-content">
								<div class="row">
									<form id="modal_note_edit_form" action="" method="POST">
										{{ csrf_field() }}
										{{ method_field('PUT') }}
										<div class="col s12">
											<div class="input-field col s12">
												<textarea id="modal_note_description" name="description" class="materialize-textarea"></textarea>
											</div>
										</div>
										<div class="row">
											<div class="col s8">
												<div>
													<div class="input-field col s12">
														<select id="modal_note_privacy" name="privacy">
															<option value="public">Pública</option>
															<option value="private">Privada</option>
														</select>
													</div>
												</div>
											</div>
											<div class="col s4">
												<div class="row">
													<div class="input-field col s12">
														<button class="btn waves-effect waves-light right" type="submit" style="width: 100%">
															Editar
															<i class="material-icons right">send</i>
														</button>
													</div>
												</div>
											</div>
										</div>
									</form>
								</div>
							</div>
							<div class="modal-footer">
								<a href="#!" class="modal-close waves-effect btn-flat">Cerrar</a>
							</div>
						</div>
					</div>
				</div>
				<div class="col s12 m3">
					@include('theme.backoffice.pages.user.includes.user_nav')
				</div>
			</div>
		</div>
	</div>
	@endsection
	@section('foot')
	<script type="text/javascript">
		$('.modal').modal();
		function modal_note(e)
		{
			var note_id = $(e).data('note');
			$.ajax({
				url: "{{ route('ajax.note_info') }}",
				method: 'GET',
				data:
				{
					note_id: note_id,
				},
				success: function(data)
				{
					$("#modal_note_edit_form").attr('action', data.route);
					$("#modal_note_description").val(data.description);
					$("#modal_note_privacy").val(data.privacy);
					// re-initialize material-select
					$('#modal_note_privacy').material_select();
				}
			});
		}
	</script>
	@endsection