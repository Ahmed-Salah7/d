<div class="card mb-0">
    @include('includes.form_error')
    <div class="card-body pb-0">
        <form method="POST" id="update_rental_request" autocomplete="off">
            @method('PATCH')
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('page.worker') }}</label>
                        <select class="form-control" name="worker_id">
                            <option value="">{{ __('page.worker') }}</option>
                            @foreach( $Workers as $Worker )
                                <option {{$RentalRequest->worker_id == $Worker->id ? 'selected' : ''}} value="{{ $Worker->id }}">{{ (Session::get('locale') =='en') ? $Worker->name : $Worker->name  }}</option>
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
                                <option {{$RentalRequest->customer_id == $Customer->id ? 'selected' : ''}} value="{{ $Customer->id }}">{{ (Session::get('locale') =='en') ? $Customer->name : $Customer->name  }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('page.duration_in_month') }}</label>
                        <input type="number" class="form-control" value="{{$RentalRequest->duration_in_month}}" name="duration_in_month">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('page.start_rental') }}</label>
                        <input type="date" class="form-control" value="{{$RentalRequest->start_rental}}" name="start_rental">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('page.cost') }}</label>
                        <input type="number" id="cost" class="form-control" value="{{$RentalRequest->cost}}" name="cost">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('page.other_cost') }}</label>
                        <input type="number" id="other_cost" class="form-control" value="{{$RentalRequest->other_cost}}" name="other_cost">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('page.total_cost') }}</label>
                        <input type="number" readonly class="form-control" value="{{$RentalRequest->total_cost}}" name="total_cost">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>{{ __('page.notes') }}</label>
                        <textarea class="form-control" name="notes">{{$RentalRequest->notes}}</textarea>
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
                        <img src="{{ $RentalRequest->attatches }}" width="150px" height="150px">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group mb-0">
                        <button type="submit" data-id="{{ $RentalRequest->id }}" class="btn btn-primary">{{ __('page.add_rental_request') }} <i class="fas "></i></button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $( "#cost" ).keyup(function() {
            calc();
        });
        $( "#other_cost" ).keyup(function() {
            calc();
        });
        function calc(){
            var cost = $('input[name=cost]').val() || 0;
            var other_cost = $('input[name=other_cost]').val() || 0;
            $('input[name=total_cost]').val(parseFloat(cost)+parseFloat(other_cost));
        }
    });
</script>
