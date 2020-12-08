<div class="card mb-0">
    @include('includes.form_error')
    <div class="card-body pb-0">
        <form method="POST" id="updat_nationality" autocomplete="off">
            @method('PATCH')
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('page.nationality') }}</label>
                        <input type="text" class="form-control" value="{{ $Nationality->nationality }}" name="nationality">
                    </div>
                </div>
                 <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('page.nationality_english') }}</label>
                        <input type="text" class="form-control" value="{{ $Nationality->nationality_english }}" name="nationality_english">
                    </div>
                </div>
                 <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('page.state') }}</label>
                        <input type="text" class="form-control" value="{{ $Nationality->state }}" name="state">
                    </div>
                </div>
                 <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('page.status') }}</label>
                        <select class="form-control" name="status">
                            <option value="">{{ __('page.select_office_type') }}</option>
                            <option value="1" @if(  $Nationality->status =='1') {{ "selected" }}   @endif>{{ __('page.active') }}</option>
                            <option value="2" @if( $Nationality->status =='2') {{ "selected" }}   @endif>{{ __('page.deactive') }}</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group mb-0">
                        <button type="submit" class="btn btn-primary" data-id="{{ base64_encode(\Carbon\Carbon::now()->format('MY').'-'.base64_encode($Nationality->id)) }}">{{ __('page.update_nationality') }} <i class="fas "></i></button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

