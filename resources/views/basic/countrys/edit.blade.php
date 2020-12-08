<div class="card mb-0"> 
    @include('includes.form_error')
    <div class="card-body pb-0">
        <form method="POST" id="update_country" autocomplete="off"> 
            @method('PATCH') 
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>{{ __('page.name') }}</label>
                        <input type="text" class="form-control" value="{{ $Country->name }}" name="name"> 
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group mb-0">
                        <button type="submit" class="btn btn-primary" data-id="{{ base64_encode(\Carbon\Carbon::now()->format('MY').'-'.base64_encode($Country->id)) }}" data-index="{{ $index }}">{{ __('page.update_country') }} <i class="fas "></i></button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>