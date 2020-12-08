@if( $status == 1 ) 
<span class="badge badge-success">{{ __('page.closed') }}</span>
@elseif( $status == 2 )
<span class="badge badge-danger">{{ __('page.opened') }}</span>
@endif
