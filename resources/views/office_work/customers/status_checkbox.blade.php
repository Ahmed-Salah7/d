 <input type="checkbox" class="customer_status" value="{{ $status }}" data-id="{{ base64_encode(\Carbon\Carbon::now()->format('MY').'-'.base64_encode($id)) }}" @if( $status == "1" ) {{ 'checked' }} @endif >