<div class="card mb-0"> 
    @include('includes.form_error')
    <div class="card-body pb-0">
        <form method="POST" id="update_status" autocomplete="off"> 
            @method('PATCH') 
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>{{ __('page.name') }}</label>
                        <input type="text" class="form-control" value="{{ $Status->name }}" name="name"> 
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>{{ __('page.office_type') }}</label>
                        <select class="form-control" id="office_type" name="office_type">
                            <option value="">{{ __('page.select_office_type') }}</option>
                            <option value="1" @if( $Status->office_type == 1 ) {{ 'selected' }} @endif>{{ __('page.local_office') }}</option>
                            <option value="2" @if( $Status->office_type == 2 ) {{ 'selected' }} @endif>{{ __('page.outside_office') }}</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <div class="form-group">
                        <label>{{ __('page.nationality') }}</label>
                        <select class="form-control" name="nationality_id">
                            <option value="">{{ __('page.select_nationality') }}</option>
                             @if( count($Nationalities) > 0 )
                                @foreach( $Nationalities as $Nationality )
                                    <option value="{{ $Nationality->id }}"  @if( isset($Status->nationality_id) && $Status->nationality_id == $Nationality->id ) {{ "selected" }} @endif> {{ (Session::get('locale') =='en') ? $Nationality->nationality_english : $Nationality->nationality  }} </option>
                                @endforeach
                            @endif
                        </select> 
                    </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group mb-0">
                        <button type="submit" class="btn btn-primary" data-id="{{ base64_encode(\Carbon\Carbon::now()->format('MY').'-'.base64_encode($Status->id)) }}">{{ __('page.update_status') }} <i class="fas "></i></button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>