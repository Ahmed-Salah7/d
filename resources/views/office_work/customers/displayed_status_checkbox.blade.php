<input type="checkbox" class="displayed_status" value="{{ $status }}" data-id="{{ base64_encode(\Carbon\Carbon::now()->format('MY').'-'.base64_encode($id)) }}" @if( $displayed == "1" ) {{ 'checked' }} @endif>