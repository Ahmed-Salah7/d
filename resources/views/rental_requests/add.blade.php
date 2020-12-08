<div class="card mb-0">
    @include('includes.form_error')
    <div class="card-body pb-0">
        <form method="POST" id="add_rental_request" enctype="multipart/form-data" autocomplete="off">
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
                        <label>{{ __('page.duration_in_month') }}</label>
                        <input type="number" class="form-control" value="" name="duration_in_month">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('page.start_rental') }}</label>
                        <input type="date" class="form-control" value="" name="start_rental">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('page.cost') }}</label>
                        <input id="cost" type="number" class="form-control" value="" name="cost">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('page.other_cost') }}</label>
                        <input id="other_cost" type="number" class="form-control" value="" name="other_cost">
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
                        <label>{{ __('page.total_cost') }}</label>
                        <input readonly type="number" class="form-control" value="" name="total_cost">
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
                        <button type="submit" class="btn btn-primary">{{ __('page.add_rental_request') }} <i class="fas "></i></button>
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