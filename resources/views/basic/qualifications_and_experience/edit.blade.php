<div class="card mb-0">
    @include('includes.form_error')
    <div class="card-body pb-0">
        <form method="POST" id="updat_qualifications_and_experience" autocomplete="off">
            @method('PATCH')
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>{{ __('page.qualifications_and_experience') }}</label>
                        <input type="text" class="form-control" value="{{ $QualificationsAndExperience->qualifications_and_experience }}" name="qualifications_and_experience">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group mb-0">
                        <button type="submit" class="btn btn-primary" data-id="{{ base64_encode(\Carbon\Carbon::now()->format('MY').'-'.base64_encode($QualificationsAndExperience->id)) }}">{{ __('page.update_qualifications_and_experience') }} <i class="fas "></i></button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

