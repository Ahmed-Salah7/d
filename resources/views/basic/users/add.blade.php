<div class="card mb-0">
    @include('includes.form_error')
    <div class="card-body pb-0">
        <form method="POST" id="add_user" autocomplete="off" >
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
                        <label>{{ __('page.username') }}</label>
                        <input type="text" class="form-control" value="" name="username">
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
                        <input type="text" class="form-control" value="" name="email">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('page.profile_pic') }}</label><br>
                        <input type="file" name="profile_pic">
                    </div>
                </div>
{{--                <div class="col-md-6">--}}
{{--                    <div class="form-group">--}}
{{--                        <label>{{ __('page.role') }}</label>--}}
{{--                         <select class="form-control" name="role">--}}
{{--                            <option value="">{{ __('page.select_role') }}</option>--}}
{{--                            @if( $Roles )--}}
{{--                                @foreach( $Roles as $Role )--}}
{{--                                    <option value="{{ $Role->id }}">{{ $Role->name }}</option>--}}
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
                            @foreach($newRoles as $newRole)
                                <option value="{{$newRole->id}}">{{ $newRole->name }}</option>
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
                                <option value="{{$Office->id}}">{{ $Office->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('page.gender') }}</label>
                        <select class="form-control" name="gender">
                            <option value="">{{ __('page.select_gender') }}</option>
                            <option value="male">{{ __('page.male') }}</option>
                            <option value="female">{{ __('page.female') }}</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('page.nationality') }}</label>
                        <input type="text" class="form-control" value="" name="nationality">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('page.qualification') }}</label>
                        <select class="form-control" name="qualification">
                            <option value="">{{ __('page.select_qualification') }}</option>
                            <option value="phd">{{ __('page.phd') }}</option>
                            <option value="ma">{{ __('page.ma') }}</option>
                            <option value="ba">{{ __('page.ba') }}</option>
                            <option value="institute">{{ __('page.institute') }}</option>
                            <option value="secondary">{{ __('page.secondary') }}</option>
                            <option value="basic">{{ __('page.basic') }}</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('page.position') }}</label>
                        <input type="text" class="form-control" value="" name="position">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('page.status') }}</label>
                        <select class="form-control" name="status">
                            <option value="">{{ __('page.select_status') }}</option>
                            <option value="1">{{ __('page.active') }}</option>
                            <option value="0">{{ __('page.deactive') }}</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group mb-0">
                        <button type="submit" class="btn btn-primary">{{ __('page.add_users') }} <i class="fas "></i></button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>