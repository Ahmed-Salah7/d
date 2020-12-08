<div class="card mb-0">
    @include('includes.form_error')
    <div class="card-body pb-0">
        <form method="POST" id="add_office" autocomplete="off"> 
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
                        <label>{{ __('page.city') }}</label>
                        <input type="text" class="form-control" value="" name="city"> 
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('page.phone_no') }}</label>
                        <input type="text" class="form-control" value="" name="phone_no"> 
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('page.email') }}</label>
                        <input type="text" class="form-control" value="" name="email"> 
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('page.office_type') }}</label>
                        <select class="form-control" name="office_type">
                            <option value="">{{ __('page.select_office_type') }}</option>
                            <option value="1">{{ __('page.external') }}</option>
                            <option value="2">{{ __('page.internal') }}</option>
                        </select>
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
                <div class="col-md-12">
                    <div class="form-group mb-0">
                        <button type="submit" class="btn btn-primary">{{ __('page.add_office') }} <i class="fas "></i></button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>