@if( $status == 1 ) 
<span class="badge badge-danger">{{ __('page.canceled') }}</span>
@elseif( $status == 2 )
<span class="badge badge-danger">{{ __('page.overdue') }}</span>
@elseif( $status == 3 )
<span class="badge badge-success">{{ __('page.paid') }}</span>
@elseif( $status == 4 )
<span class="badge badge-warning">{{ __('page.pending') }}</span>
@elseif( $status == 5 )
<span class="badge badge-info">{{ __('page.partially_paid') }}</span>
@endif
