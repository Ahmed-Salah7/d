@if( $status == 1 ) 
<span class="badge badge-success">{{ __('page.approved') }}</span>
@elseif( $status == 2 )
<span class="badge badge-danger">{{ __('page.disapproved') }}</span>
@endif
