<div class="card mb-0">
    @include('includes.form_error')
    <div class="card-body pb-0">
        <form method="POST" id="update_currency" autocomplete="off">
            @method('PATCH')
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('page.currency_name') }}</label>
                        <input type="text" class="form-control" value="{{ $Currency->currency_name }}" name="currency_name">
                    </div>
                </div>
                 <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('page.currency_name_english') }}</label>
                        <input type="text" class="form-control" value="{{ $Currency->currency_name_english }}" name="currency_name_english">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('page.abbreviation') }}</label>
                        <input type="text" class="form-control" value="{{ $Currency->abbreviation }}" name="abbreviation">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group mb-0">
                        <button type="submit" class="btn btn-primary" data-id="{{ base64_encode(\Carbon\Carbon::now()->format('MY').'-'.base64_encode($Currency->id)) }}">{{ __('page.update_currency') }} <i class="fas "></i></button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

