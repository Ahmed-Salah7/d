<div class="card mb-0">
    @include('includes.form_error')
    <div class="card-body pb-0">
        <form method="POST" id="add_religion" autocomplete="off">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('page.religion') }}</label>
                        <input type="text" class="form-control" value="" name="religion">
                    </div>
                </div>
                 <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('page.religion_english') }}</label>
                        <input type="text" class="form-control" value="" name="religion_english">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group mb-0">
                        <button type="submit" class="btn btn-primary">{{ __('page.add_religion') }} <i class="fas "></i></button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

