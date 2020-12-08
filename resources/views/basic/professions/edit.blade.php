<div class="card mb-0">
    @include('includes.form_error')
    <div class="card-body pb-0">
        <form method="POST" id="updat_profession" autocomplete="off">
            @method('PATCH')
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('page.occupation') }}</label>
                        <input type="text" class="form-control" value="{{ $Profession->occupation }}" name="occupation">
                    </div>
                </div>
                 <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('page.job_english') }}</label>
                        <input type="text" class="form-control" value="{{ $Profession->job_english }}" name="job_english">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group mb-0">
                        <button type="submit" class="btn btn-primary" data-id="{{ base64_encode(\Carbon\Carbon::now()->format('MY').'-'.base64_encode($Profession->id)) }}">{{ __('page.update_profession') }} <i class="fas "></i></button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

