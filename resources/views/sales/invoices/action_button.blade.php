<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
 	{{ __('page.action') }}
 </button>
 <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated">
 	<a href="#" class="dropdown-item view-invoice"  data-id="{{ base64_encode(\Carbon\Carbon::now()->format('MY').'-'.base64_encode($id)) }}"><i class="far fa-file-alt"></i> {{ __('page.view_invoice') }}</a>
 	<a href="#" class="dropdown-item invoce-payment-view" data-id="{{ base64_encode(\Carbon\Carbon::now()->format('MY').'-'.base64_encode($id)) }}" data-title="{{ __('page.view_payments') }} ({{ __('page.invoice_no') }} {{ $id }})" ><i class="fas fa-money-bill-alt"></i> {{ __('page.view_payments') }}</a>
 	@if( getPaidAmount($id) > 0 )
 		<a href="#" class="dropdown-item invoce-payment-add" data-title="{{ __('page.add_payments') }}" data-id="{{ base64_encode(\Carbon\Carbon::now()->format('MY').'-'.base64_encode($id)) }}"><i class="far fa-money-bill-alt"></i> {{ __('page.add_payments') }}</a>
 	@endif
 	<a href="#" class="dropdown-item edit-invoce"  data-id="{{ base64_encode(\Carbon\Carbon::now()->format('MY').'-'.base64_encode($id)) }}" data-title="{{ __('page.edit_invoice') }}"><i class="fas fa-edit"></i> {{ __('page.edit_invoice') }}</a>
 	<a href="{{ url('/sales/invoice/pdf/'. base64_encode(\Carbon\Carbon::now()->format('MY').'-'.base64_encode($id)))}}" class="dropdown-item download-pdf"><i class="far fa-file-pdf"></i> {{ __('page.download_as_pdf') }}</a>
 	<a href="#" class="dropdown-item delete-invoice" data-id="{{ base64_encode(\Carbon\Carbon::now()->format('MY').'-'.base64_encode($id)) }}"><i class="fas fa-trash-alt"></i>  {{ __('page.delete_invoice') }}</a>
 </div>