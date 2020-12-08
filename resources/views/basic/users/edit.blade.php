<div class="card mb-0">
    @include('includes.form_error')
    <div class="card-body pb-0">
        <form method="POST" id="update_user" autocomplete="off">
            @method('PATCH')
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('page.name') }}</label>
                        <input type="text" class="form-control" value="{{ $User->name }}" name="name">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('page.username') }}</label>
                        <input type="text" class="form-control" value="{{ $User->username }}" name="username">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('page.password') }}</label>
                        <input type="password" class="form-control" value="" name="password">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('page.email') }}</label>
                        <input type="text" class="form-control" value="{{ $User->email }}" name="email">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('page.profile_pic') }}</label><br>
                        <input type="file"name="profile_pic">
                    </div>
                </div>
                @if( isset($User->profile_pic) && $User->profile_pic !="" )
                    <div class="col-md-6">
                        <img src="{{ asset('/'.$User->profile_pic) }}" class="img-thumbnail" width="100" height="100">
                    </div>
                @endif
{{--                <div class="col-md-6">--}}
{{--                    <div class="form-group">--}}
{{--                        <label>{{ __('page.role') }}</label>--}}
{{--                         <select class="form-control" name="role">--}}
{{--                            <option value="">{{ __('page.select_role') }}</option>--}}
{{--                            @if( $Roles )--}}
{{--                                @foreach( $Roles as $Role )--}}
{{--                                    <option value="{{ $Role->id }}" @if($User->role_id !="" && $User->role_id == $Role->id) {{ "selected" }} @endif>{{ __('page.'.$Role->name.'') }}</option>--}}
{{--                                @endforeach--}}
{{--                            @endif--}}
{{--                        </select>--}}

{{--                    </div>--}}
{{--                </div>--}}

                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('page.new_roles') }}</label>

                        <select name="newRoles"
                                class="form-control select2" data-placeholder="اختار الصلاحيات">
                            <option value=""></option>
                            @foreach($newRoles as $newRole)
                                @if(!$User->roles->isEmpty())
                                <option {{ $User->roles[0]->id ==$newRole->id ? 'selected' : '' }} value="{{$newRole->id}}">{{ $newRole->name }}</option>
                                @else
                                    <option value="{{$newRole->id}}">{{ $newRole->name }}</option>
                                @endif
                            @endforeach
                        </select>

                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('page.office') }}</label>
                        <select name="office_id" class="form-control">
                            <option value="">{{__('page.office')}}</option>
                            @foreach($Offices as $Office)
                                <option {{$Office->id == $User->office_id ? 'selected' : ''}} value="{{$Office->id}}">{{ $Office->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('page.gender') }}</label>
                        <select class="form-control" name="gender">
                            <option value="">{{ __('page.select_gender') }}</option>
                            <option value="male" @if(isset($User->UserData->gender) && $User->UserData->gender == 'male')  {{ "selected" }} @endif >{{ __('page.male') }}</option>
                            <option value="female" @if(isset($User->UserData->gender) && $User->UserData->gender == 'female')  {{ "selected" }} @endif >{{ __('page.female') }}</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('page.nationality') }}</label>
                        <input type="text" class="form-control" value="{{ (isset($User->UserData->nationality)) ? $User->UserData->nationality : '' }}" name="nationality">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('page.qualification') }}</label>
                        <select class="form-control" name="qualification">
                            <option value="">{{ __('page.select_qualification') }}</option>
                            <option value="phd" @if(isset($User->UserData->qualification) && $User->UserData->qualification == 'phd')  {{ "selected" }} @endif >{{ __('page.phd') }}</option>
                            <option value="ma" @if(isset($User->UserData->qualification) && $User->UserData->qualification == 'ma')  {{ "selected" }} @endif >{{ __('page.ma') }}</option>
                            <option value="ba" @if(isset($User->UserData->qualification) && $User->UserData->qualification == 'ba')  {{ "selected" }} @endif >{{ __('page.ba') }}</option>
                            <option value="institute" @if(isset($User->UserData->qualification) && $User->UserData->qualification == 'institute')  {{ "selected" }} @endif >{{ __('page.institute') }}</option>
                            <option value="secondary" @if(isset($User->UserData->qualification) && $User->UserData->qualification == 'secondary')  {{ "selected" }} @endif >{{ __('page.secondary') }}</option>
                            <option value="basic" @if(isset($User->UserData->qualification) && $User->UserData->qualification == 'basic')  {{ "selected" }} @endif >{{ __('page.basic') }}</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('page.position') }}</label>
                        <input type="text" class="form-control" value="{{ (isset($User->UserData->position)) ? $User->UserData->position : '' }}" name="position">
                    </div>
                </div>
                @if( Auth::user()->id !=  $User->id )
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('page.status') }}</label>
                        <select class="form-control" name="status">
                            <option value="">{{ __('page.select_status') }}</option>
                            <option value="1" @if( $User->status !="" && $User->status =='1') {{ "selected" }}  @endif>{{ __('page.active') }}</option>
                            <option value="2" @if( $User->status !="" && $User->status =='2') {{ "selected" }}  @endif>{{ __('page.deactive') }}</option>
                        </select>
                    </div>
                </div>
                @endif
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group mb-0">
                        <button type="submit" class="btn btn-primary" data-id="{{ base64_encode(\Carbon\Carbon::now()->format('MY').'-'.base64_encode($User->id)) }}">{{ __('page.update_user') }} <i class="fas "></i></button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
