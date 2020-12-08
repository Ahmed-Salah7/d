<div class="card mb-0">
    @include('includes.form_error')
    <div class="card-body pb-0">
        <form method="POST" id="add_worker" enctype="multipart/form-data" autocomplete="off">
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
                        <label>{{ __('page.sponser_name') }}</label>
                        <input type="text" class="form-control" value="" name="sponser_name">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('page.nationality') }}</label>
                        <select class="form-control" name="nationality_id">
                            <option value="">{{ __('page.nationality') }}</option>
                                @foreach( $Nationalities as $Nationality )
                                    <option value="{{ $Nationality->id }}">{{ (Session::get('locale') =='en') ? $Nationality->nationality_english : $Nationality->nationality  }}</option>
                                @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('page.profession') }}</label>
                        <select class="form-control" name="profession_id">
                            <option value="">{{ __('page.profession') }}</option>
                            @foreach( $Professions as $Profession )
                                <option value="{{ $Profession->id }}">{{ (Session::get('locale') =='en') ? $Profession->job_english : $Profession->occupation  }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('page.age') }}</label>
                        <input type="number" class="form-control" value="" name="age">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('page.enter_date') }}</label>
                        <input type="date" class="form-control" value="" name="enter_date">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('page.passport_number') }}</label>
                        <input type="text" class="form-control" value="" name="passport_number">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('page.office') }}</label>
                        <select class="form-control" name="office_id">
                            <option value="">{{ __('page.office') }}</option>
                            @foreach( $Offices as $Office )
                                <option value="{{ $Office->id }}">{{ (Session::get('locale') =='en') ? $Office->name : $Office->name  }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('page.accoumodation_type') }}</label>
                        <select class="form-control" name="accoumodation_type_id">
                            <option value="">{{ __('page.accoumodation_type') }}</option>
                            @foreach( $AccoumodationTypes as $AccoumodationType )
                                <option value="{{ $AccoumodationType->id }}">{{ (Session::get('locale') =='en') ? $AccoumodationType->name : $AccoumodationType->name  }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('page.religion') }}</label>
                        <select class="form-control" name="religion_id">
                            <option value="">{{ __('page.religion') }}</option>
                            @foreach( $Religions as $Religion )
                                <option value="{{ $Religion->id }}">{{ (Session::get('locale') =='en') ? $Religion->religion_english : $Religion->religion  }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('page.qualifications_and_rxperience') }}</label>
                        <select class="form-control" name="qualifications_and_rxperience_id">
                            <option value="">{{ __('page.qualifications_and_rxperience') }}</option>
                            @foreach( $QualificationsAndExperiences as $QualificationsAndExperience )
                                <option value="{{ $QualificationsAndExperience->id }}">{{ (Session::get('locale') =='en') ? $QualificationsAndExperience->qualifications_and_experience : $QualificationsAndExperience->qualifications_and_experience  }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('page.passport_image') }}</label>
                        <input type="file" value="" name="passport_image">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('page.additional_attchements') }}</label>
                        <input type="file" value="" name="additional_attchements">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('page.notes') }}</label>
                        <textarea class="form-control" name="notes"></textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group mb-0">
                        <button type="submit" class="btn btn-primary">{{ __('page.add_worker') }} <i class="fas "></i></button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

