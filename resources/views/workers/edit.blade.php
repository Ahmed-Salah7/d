<div class="card mb-0">
    @include('includes.form_error')
    <div class="card-body pb-0">
        <form method="POST" id="update_worker" enctype="multipart/form-data" autocomplete="off">
            @method('PATCH')
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('page.name') }}</label>
                        <input type="text" class="form-control" value="{{$worker->name}}" name="name">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('page.sponser_name') }}</label>
                        <input type="text" class="form-control" value="{{$worker->sponser_name}}" name="sponser_name">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('page.nationality') }}</label>
                        <select class="form-control" name="nationality_id">
                            <option value="">{{ __('page.nationality') }}</option>
                                @foreach( $Nationalities as $Nationality )
                                    <option {{$Nationality->id == $worker->nationality_id ? 'selected' : ''}} value="{{ $Nationality->id }}">{{ (Session::get('locale') =='en') ? $Nationality->nationality_english : $Nationality->nationality  }}</option>
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
                                <option {{$Profession->id == $worker->profession_id ? 'selected' : ''}} value="{{ $Profession->id }}">{{ (Session::get('locale') =='en') ? $Profession->job_english : $Profession->occupation  }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('page.age') }}</label>
                        <input type="number" class="form-control" value="{{$worker->age}}" name="age">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('page.enter_date') }}</label>
                        <input type="date" class="form-control" value="{{$worker->enter_date}}" name="enter_date">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('page.passport_number') }}</label>
                        <input type="text" class="form-control" value="{{$worker->passport_number}}" name="passport_number">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('page.office') }}</label>
                        <select class="form-control" name="office_id">
                            <option value="">{{ __('page.office') }}</option>
                            @foreach( $Offices as $Office )
                                <option {{$Office->id == $worker->office_id ? 'selected' : ''}} value="{{ $Office->id }}">{{ (Session::get('locale') =='en') ? $Office->name : $Office->name  }}</option>
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
                                <option {{$AccoumodationType->id == $worker->accoumodation_type_id ? 'selected' : ''}} value="{{$AccoumodationType->id}}">{{ (Session::get('locale') =='en') ? $AccoumodationType->name : $AccoumodationType->name  }}</option>
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
                                <option {{$Religion->id == $worker->religion_id ? 'selected' : ''}} value="{{ $Religion->id }}">{{ (Session::get('locale') =='en') ? $Religion->religion_english : $Religion->religion  }}</option>
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
                                <option {{$QualificationsAndExperience->id == $worker->qualifications_and_rxperience_id ? 'selected' : ''}} value="{{ $QualificationsAndExperience->id }}">{{ (Session::get('locale') =='en') ? $QualificationsAndExperience->qualifications_and_experience : $QualificationsAndExperience->qualifications_and_experience  }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('page.notes') }}</label>
                        <textarea class="form-control" name="notes">{{$worker->notes}}</textarea>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('page.passport_image') }}</label>
                        <input type="file" name="passport_image">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <a target="_blank" href="{{$worker->passport_image}}">
                            <img src="{{$worker->passport_image}}" width="150px" height="150px">
                        </a>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('page.additional_attchements') }}</label>
                        <input type="file" name="additional_attchements">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <a target="_blank" href="{{$worker->additional_attchements}}">
                            <img src="{{$worker->additional_attchements}}" width="150px" height="150px">
                        </a>
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group mb-0">
                        <button type="submit" data-id="{{ $worker->id }}" class="btn btn-primary">{{ __('page.add_worker') }} <i class="fas "></i></button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

