<div class="card mb-0">
    @include('includes.form_error')
    <div class="card-body pb-0">
        <form method="POST" id="update_relay" autocomplete="off">
            @method('PATCH')
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('page.worker') }}</label>
                        <select class="form-control" name="worker_id">
                            <option value="">{{ __('page.worker') }}</option>
                            @foreach( $Workers as $Worker )
                                <option {{$Relay->worker_id == $Worker->id ? 'selected' : '' }} value="{{ $Worker->id }}">{{ (Session::get('locale') =='en') ? $Worker->name : $Worker->name  }}</option>
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
                                <option {{$Relay->customer_id == $Customer->id ? 'selected' : '' }} value="{{ $Customer->id }}">{{ (Session::get('locale') =='en') ? $Customer->name : $Customer->name  }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('page.contract_number') }}</label>
                        <input type="number" class="form-control" value="{{ $Relay->contract_number }}" name="contract_number">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('page.passport_number') }}</label>
                        <input type="number" class="form-control" value="{{ $Relay->passport_number }}" name="passport_number">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('page.reason_deportation') }}</label>
                        <input type="text" class="form-control" value="{{ $Relay->reason_deportation }}" name="reason_deportation">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('page.date_deportation') }}</label>
                        <input type="date" class="form-control" value="{{ $Relay->date_deportation }}" name="date_deportation">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('page.airport') }}</label>
                        <input type="number" class="form-control" value="{{ $Relay->airport }}" name="airport">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('page.notes') }}</label>
                        <textarea class="form-control" name="notes">{{ $Relay->notes }}</textarea>
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
                        <img src="{{ $Relay->attatches }}" width="150px" height="150px">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group mb-0">
                        <button type="submit" data-id="{{ $Relay->id }}" class="btn btn-primary">{{ __('page.add_relay') }} <i class="fas "></i></button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

