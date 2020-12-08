<div class="card mb-0">
    @include('includes.form_error')
    <div class="card-body pb-0">
        <form method="POST" id="update_cost_center" autocomplete="off">
            @method('PATCH')
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('page.center_name') }}</label>
                        <input type="text" class="form-control" value="{{ $CostCenter->center_name }}" name="center_name">
                    </div>
                </div>
                 <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('page.center_name_english') }}</label>
                        <input type="text" class="form-control" value="{{ $CostCenter->center_name_english }}" name="center_name_english">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>{{ __('page.notes') }}</label>
                        <input type="text" class="form-control" value="{{ $CostCenter->notes }}" name="notes">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group mb-0">
                        <button type="submit" class="btn btn-primary" data-id="{{ base64_encode(\Carbon\Carbon::now()->format('MY').'-'.base64_encode($CostCenter->id)) }}">{{ __('page.update_cost_center') }} <i class="fas "></i></button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

