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
								<th>Concepto</th>
								<th>Monto</th>
								<th>Estado</th>
								<th colspan="2">Accion</th>
							</tr>
						</thead>
						<tbody>
							@forelse($invoices as $key => $invoice)
							<tr>
								<td>{{$invoice->id}}</td>
								<td>{{$invoice->concept()}}</td>
								<td>{{$invoice->amount}}</td>
								<td>{{$invoice->status}}</td>
								<td><a href="#modal" data-invoice="{{$invoice->id}}" onclick="modal_invoice(this)" class="modal-trigger">Ver</a></td>
								<td><a href="{{route('backoffice.patient.invoice.edit', [$user, $invoice])}}">Editar</a></td>
							</tr>
							@empty
							<tr>
								<td colspan="5">No tienenes registrada ninguna factura</td>
							</tr>
							@endforelse
						</tbody>
					</table>
				</div>
			</div>

			<div class="modal" id="modal">
				<div class="modal-content">
					<h4 id="modal_invoice_title">Información de la factura</h4>
					<p><strong>Folio: </strong><span id="modal_invoice_id"></span></p>
					<p><strong>Doctor: </strong><span id="modal_invoice_doctor"></span></p>
					<p><strong>Concepto: </strong><span id="modal_invoice_concept"></span></p>
					<p><strong>Monto: </strong><span id="modal_invoice_amount"></span></p>
				</div>	
				<div class="modal-footer">
					<a href="#" class="modal-close waves-effect btn-flat">Cerrar</a>
					<a href="#" class="waves-effect btn-flat">Imprimir</a>
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
<script type="text/javascript">
	$('.modal').modal();	

	function modal_invoice(e)
	{
		var invoice_id = $(e).data('invoice');
		$.ajax({
			url: "{{route('ajax.invoice_info')}}",
			method: 'GET',
			data: 
			{
				invoice_id: invoice_id,
			},
			success: function(data){
				console.log(data);
				$('#modal_invoice_id').html(data.invoice.id);
				$('#modal_invoice_doctor').html(data.doctor.name);
				$('#modal_invoice_concept').html(data.concept);
				$('#modal_invoice_amount').html(data.invoice.amount);
			}
		});	
	}
</script>
@endsection