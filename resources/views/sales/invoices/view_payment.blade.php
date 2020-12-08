@include('includes.form_error')
@if( count($invoicePayments) > 0 )
	 <div class="table-responsive erp-table">
		<table class="table table-bordered table-hover" id="tab_logic">
		    <thead>
		        <tr>
		            <th class="text-center" width="20%">{{ __('page.date') }}</th>
		            <th class="text-center" width="10%">{{ __('page.amount') }}</th>
		            <th class="text-center" width="60%">{{ __('page.note') }}</th>
		            <th class="text-center" width="10%">{{ __('page.action') }}</th>
		        </tr>
		    </thead>
		    <tbody>
		    	@foreach( $invoicePayments as $invoicePayment )
			        <tr>
			        	<td>{{ $invoicePayment->date }}</td>
				        <td>{{ $invoicePayment->amount_paid }}</td>
				        <td>{{ $invoicePayment->note }}</td>
				        <td>
				        	<a class="btn btn-primary btn-sm waves-effect waves-light edit-invoice-payment" data-id="{{ base64_encode(\Carbon\Carbon::now()->format('MY').'-'.base64_encode($invoicePayment->id)) }}" data-title="{{ __('page.edit_payment') }}" href="#"><i class="fas fa-edit"></i></a>
				        	<a class="btn btn-danger btn-sm waves-effect waves-light delete-invoice-payment"  data-id="{{ base64_encode(\Carbon\Carbon::now()->format('MY').'-'.base64_encode($invoicePayment->id)) }}" href="#" ><i class="fas fa-trash-alt"></i></a>
						</td>
			        </tr>
			    @endforeach
		    </tbody>
		</table>
	</div>
 @else
No payment has been made for this invoice
@endif
