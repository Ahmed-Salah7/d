<div class="card mb-0">
    @include('includes.form_error')
    <div class="card-body pb-0">
        <form method="POST" id="add_currency" autocomplete="off">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('page.currency_name') }}</label>
                        <input type="text" class="form-control" value="" name="currency_name">
                    </div>
                </div>
                 <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('page.currency_name_english') }}</label>
                        <input type="text" class="form-control" value="" name="currency_name_english">
                    </div>
                </div> 
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('page.abbreviation') }}</label>
                        <input type="text" class="form-control" value="" name="abbreviation">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group mb-0">
                        <button type="submit" class="btn btn-primary">{{ __('page.add_currency') }} <i class="fas "></i></button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

