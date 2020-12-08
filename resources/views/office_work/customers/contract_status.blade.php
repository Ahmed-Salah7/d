@php 
$i = 0;
$j = 0;
@endphp
<div class="row">
    @if( count($Status) > 0 )
        @foreach( $Status as $Status )
            @if( $Status->nationality_id == $id )
                @if( $Status->office_type == '1' )
                    @if( $i == 0 )
                    <div class="col-md-12">
                        <label>{{ __('page.local_office') }}</label>
                    </div>
                    @endif
                    <div class="col-md-3">
                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="status_{{$Status->id}}" data-parsley-multiple="groups" data-parsley-mincheck="2" value="{{ $Status->id }}" name="extradata[{{ $Status->id }}]">
                                <label class="custom-control-label" for="status_{{$Status->id}}">{{ $Status->name }}</label>
                            </div>
                        </div>
                    </div>
                    @php $i++; @endphp
                @else
                    @if(  $j == 0 )
                    <div class="col-md-12">
                        <label>{{ __('page.outside_office') }}</label>
                    </div>
                    @endif
                    <div class="col-md-3">
                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="status_{{$Status->id}}" data-parsley-multiple="groups" data-parsley-mincheck="2" value="{{ $Status->id }}" name="extradata[{{ $Status->id }}]">
                                <label class="custom-control-label" for="status_{{$Status->id}}">{{ $Status->name }}</label>
                            </div>
                        </div>
                    </div>
                   @php $j++; @endphp
                @endif
            @endif
        @endforeach
    @endif
</div>
