<div class="card mb-0">@include('includes.form_error')
    <div class="card-body pb-0">
        <form method="POST" id="add_cv" autocomplete="off">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('page.name') }}</label>
                        <input type="text" class="form-control" value="" name="name">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('page.occupation') }}</label>
                        <select class="form-control" name="profession_id">
                            <option value="">{{ __('page.select_occupation') }}</option>
                             @if( count($Professions) > 0 )
                                @foreach( $Professions as $Profession )
                                    <option value="{{ $Profession->id }}"  @if( isset($EmploymentContract->profession_id)  && $EmploymentContract->profession_id == $Profession->id ) {{ "selected" }} @endif> {{ (Session::get('locale') =='en') ? $Profession->job_english : $Profession->occupation  }} </option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('page.nationality') }}</label>
                        <select class="form-control" name="nationality_id">
                             <option value="">{{ __('page.select_nationality') }}</option>
                            @if( count($Nationalities) > 0 )
                                @foreach( $Nationalities as $Nationality )
                                 <option value="{{  $Nationality->id }}">{{ (Session::get('locale') =='en') ? $Nationality->nationality_english : $Nationality->nationality  }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('page.religion') }}</label>
                        <select class="form-control" name="religion_id">
                            <option value="">{{ __('page.select_religion') }}</option>
                            @if( count($Religions) > 0 )
                                @foreach( $Religions as $Religions )
                                    <option value="{{ $Religions->id }}">{{ (Session::get('locale') =='en') ? $Religions->religion_english : $Religions->religion  }} </option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('page.age') }}</label>
                        <input type="text" class="form-control" value="" name="age">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('page.previous_experience') }}</label>
                        <select class="form-control" name="previous_experience">
                            <option value="">{{ __('page.select_previous_experience') }}</option>
                            <option value="1">{{ __('page.previous_experience') }}</option>
                            <option value="2">{{ __('page.not_previous_experience') }}</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('page.office') }}</label>
                        <select class="form-control" name="office_id">
                            <option value="">{{ __('page.select_office') }}</option>
                            @if( count($Offices) > 0 )
                                @foreach( $Offices as $Office )
                                 <option value="{{  $Office->id }}">{{ $Office->name }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('page.passport_number') }}</label>
                         <input type="text" class="form-control" value="" name="passport_number">
                    </div>
                </div>
            </div>
            <div class="row">
{{--                <div class="col-md-6">--}}
{{--                    <div class="form-group">--}}
{{--                        <label>{{ __('page.reservation') }}</label>--}}
{{--                        <select class="form-control" name="reservation">--}}
{{--                            <option value="">{{ __('page.select_reservation') }}</option>--}}
{{--                            <option value="1">{{ __('page.reservation') }}</option>--}}
{{--                            <option value="2">{{ __('page.not_reservation') }}</option>--}}
{{--                        </select>--}}
{{--                    </div>--}}
{{--                </div>--}}

                <div class="col-md-6">
                    <div class="form-group">
                        <div class="form-group">
                            <label>{{ __('page.notes') }}</label>
                            <textarea class="form-control" rows="2" id="notes" name="notes">{{ (isset( $EmploymentContract->notes) ) ? $EmploymentContract->notes : ''  }}</textarea>
                        </div>
                    </div>
                </div>


                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('page.status') }}</label>
                        <select class="form-control" name="status">
                            <option value="">{{ __('page.select_status') }}</option>
                            <option value="1">{{ __('page.active') }}</option>
                            <option value="2">{{ __('page.deactive') }}</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('page.profile_pic') }}</label><br>
                        <input type="file" name="profile_pic">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group mb-0">
                        <button type="submit" class="btn btn-primary">{{ __('page.add_cv') }} <i class="fas "></i></button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>