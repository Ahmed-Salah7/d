@if( $previous_experience == 1 ) 
<span class="badge badge-success">{{ __('page.previous_experience') }}</span>
@elseif( $previous_experience == 2 )
<span class="badge badge-danger">{{ __('page.not_previous_experience') }}</span>
@endif
