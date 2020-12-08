<div class="card mb-0">
    @include('includes.form_error')
    <div class="card-body pb-0">
        <form method="POST" id="add_terms_and_advantage" autocomplete="off">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>{{ __('page.terms_and_advantage') }}</label>
                        <input type="text" class="form-control" value="" name="terms_and_advantage">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group mb-0">
                        <button type="submit" class="btn btn-primary">{{ __('page.add_terms_and_advantage') }} <i class="fas "></i></button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

