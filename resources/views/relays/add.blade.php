<div class="card mb-0">
    @include('includes.form_error')
    <div class="card-body pb-0">
        <form method="POST" id="add_relay" enctype="multipart/form-data" autocomplete="off">
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
                        <label>{{ __('page.customer') }}</label>
                        <select class="form-control" name="customer_id">
                            <option value="">{{ __('page.customer') }}</option>
                            @foreach( $Customers as $Customer )
                                <option value="{{ $Customer->id }}">{{ (Session::get('locale') =='en') ? $Customer->name : $Customer->name  }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('page.contract_number') }}</label>
                        <input type="text" class="form-control" value="" name="contract_number">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('page.passport_number') }}</label>
                        <input type="text" class="form-control" value="" name="passport_number">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('page.reason_deportation') }}</label>
                        <input type="text" class="form-control" value="" name="reason_deportation">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('page.date_deportation') }}</label>
                        <input type="date" class="form-control" value="" name="date_deportation">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('page.airport') }}</label>
                        <input type="text" class="form-control" value="" name="airport">
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
                        <textarea class="form-control" name="notes"></textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group mb-0">
                        <button type="submit" class="btn btn-primary">{{ __('page.add_relay') }} <i class="fas "></i></button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

