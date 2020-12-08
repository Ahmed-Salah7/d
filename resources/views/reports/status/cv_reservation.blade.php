@if( $reservation == 1 ) 
<span class="badge badge-success">{{ __('page.reservation') }}</span>
@elseif( $reservation == 2 )
<span class="badge badge-danger">{{ __('page.not_reservation') }}</span>
@endif
