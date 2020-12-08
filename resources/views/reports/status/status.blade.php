@if( $status == 1 ) 
<span class="badge badge-success">{{ __('page.active') }}</span>
@elseif( $status == 2 )
<span class="badge badge-danger">{{ __('page.deactive') }}</span>
@endif
