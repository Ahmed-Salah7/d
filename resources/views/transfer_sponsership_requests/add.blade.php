<div class="card mb-0">
    @include('includes.form_error')
    <div class="card-body pb-0">
        <form method="POST" id="add_transfer_sponsorship_request" enctype="multipart/form-data" autocomplete="off">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('page.worker') }}</label>
                        <select class="form-control" name="worker_id">
                            <option value="">{{ __('page.worker') }}</option>
                            @foreach( $Workers as $Worker )
                                <option value="{{ $Worker->id }}">{{ (Session::get('locale') =='en') ? $Worker->name : $Worker->name  }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('page.customer_current') }}</label>
                        <select class="form-control" name="customer_id_current">
                            <option value="">{{ __('page.customer_current') }}</option>
                            @foreach( $Customers as $Customer )
                                <option value="{{ $Customer->id }}">{{ (Session::get('locale') =='en') ? $Customer->name : $Customer->name  }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('page.customer_new') }}</label>
                        <select class="form-control" name="customer_id_new">
                            <option value="">{{ __('page.customer_new') }}</option>
                            @foreach( $Customers as $Customer )
                                <option value="{{ $Customer->id }}">{{ (Session::get('locale') =='en') ? $Customer->name : $Customer->name  }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('page.date_transfer_sponsorship') }}</label>
                        <input type="date" class="form-control" value="" name="date_transfer_sponsorship">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('page.cost_transfer_sponsorship') }}</label>
                        <input type="number" class="form-control" value="" name="cost_transfer_sponsorship">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('page.expiration_date_experiment') }}</label>
                        <input type="date" class="form-control" value="" name="expiration_date_experiment">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('page.daily_salary') }}</label>
                        <input type="number" class="form-control" value="" name="daily_salary">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('page.attatches') }}</label>
                        <input type="file" class="form-control" name="attatches">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('page.notes') }}</label>
                        <textarea class="form-control" value="" name="notes"></textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group mb-0">
                        <button type="submit" class="btn btn-primary">{{ __('page.add_transfer_sponsorship_request') }} <i class="fas "></i></button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

