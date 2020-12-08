<div class="card mb-0"> 
    @include('includes.form_error')
    <div class="card-body pb-0">
        <form method="POST" id="add_status" autocomplete="off"> 
            {{ csrf_field() }}
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>{{ __('page.name') }}</label>
                        <input type="text" class="form-control" value="" name="name"> 
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>{{ __('page.office_type') }}</label>
                        <select class="form-control" id="office_type" name="office_type">
                            <option value="">{{ __('page.select_office_type') }}</option>
                            <option value="1">{{ __('page.local_office') }}</option>
                            <option value="2">{{ __('page.outside_office') }}</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                       <div class="form-group">
                        <label>{{ __('page.nationality') }}</label>
                        <select class="form-control" name="nationality_id">
                            <option value="">{{ __('page.select_nationality') }}</option>
                             @if( count($Nationalities) > 0 )
                                @foreach( $Nationalities as $Nationality )
                                    <option value="{{ $Nationality->id }}"> {{ (Session::get('locale') =='en') ? $Nationality->nationality_english : $Nationality->nationality  }} </option>
                                @endforeach
                            @endif
                        </select> 
                    </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group mb-0">
                        <button type="submit" class="btn btn-primary">{{ __('page.add_status') }} <i class="fas "></i></button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>