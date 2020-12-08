<option value="">{{ __('page.select_cv') }}</option>
@foreach( $Cvs as $CV )
    <option value="{{ $CV->id }}"  @if( isset($EmploymentContract->cv_id) && $EmploymentContract->cv_id == $CV->id ) {{ "selected" }} @endif>{{  $CV->name  }} </option>
@endforeach
