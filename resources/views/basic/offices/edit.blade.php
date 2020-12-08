<div class="card mb-0"> 
    @include('includes.form_error')
    <div class="card-body pb-0">
        <form method="POST" id="updat_office" autocomplete="off">
            @method('PATCH')
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('page.name') }}</label>
                        <input type="text" class="form-control" value="{{ ( $Office->name !='') ? $Office->name : '' }}" name="name">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('page.city') }}</label>
                        <input type="text" class="form-control" value="{{ ( $Office->city !='') ? $Office->city : '' }}" name="city"> 
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('page.phone_no') }}</label>
                        <input type="text" class="form-control" value="{{ ( $Office->phone !='') ? $Office->phone : '' }}" name="phone_no">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('page.email') }}</label>
                        <input type="text" class="form-control" value="{{ ( $Office->email !='') ? $Office->email : '' }}" name="email"> 
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('page.office_type') }}</label>
                        <select class="form-control" name="office_type">
                            <option value="">{{ __('page.select_office_type') }}</option>
                            <option value="1" @if( $Office->office_type !="" && $Office->office_type =='1') {{ "selected" }} @endif>{{ __('page.external') }}</option>
                            <option value="2" @if( $Office->office_type !="" && $Office->office_type =='2') {{ "selected" }} @endif>{{ __('page.internal') }}</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('page.status') }}</label>
                        <select class="form-control" name="status">
                            <option value="">{{ __('page.select_status') }}</option>
                            <option value="1" @if( $Office->status !="" && $Office->status =='1') {{ "selected" }} @endif>{{ __('page.active') }}</option>
                            <option value="2" @if( $Office->status !="" && $Office->status =='2') {{ "selected" }} @endif>{{ __('page.deactive') }}</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group mb-0">
                        <button type="submit" class="btn btn-primary" data-id="{{ base64_encode(\Carbon\Carbon::now()->format('MY').'-'.base64_encode($Office->id)) }}">{{ __('page.update_office') }} <i class="fas "></i></button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>