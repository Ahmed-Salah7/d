<div class="card mb-0">@include('includes.form_error')
    <div class="card-body pb-0">
        <form method="POST" id="add_customer" autocomplete="off">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('page.name') }}</label>
                        <input type="text" class="form-control" value="" name="name">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('page.id_number') }}</label>
                        @if(filled(\App\Customer::get()))
                        <input type="text" class="form-control" value="{{(\App\Customer::all()->last()->id)?? 0 +1}}"
                               name="id_number" readonly>
                        @else
                            <input type="text" class="form-control" value="1"
                                   name="id_number" readonly>
                        @endif
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('page.address') }}</label>
                        <input type="text" class="form-control" value="" name="address">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('page.nationality') }}</label>
                        <select class="form-control" name="nationality_id">
                            <option value="">{{ __('page.select_nationality') }}</option>
                            @if( count($Nationalities) > 0 )
                                @foreach( $Nationalities as $Nationality )
                                    <option value="{{ $Nationality->id }}"> {{ (Session::get('locale') =='en') ? $Nationality->nationality_english : $Nationality->nationality  }} </option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('page.id_card_number') }}</label>
                        <input type="number" class="form-control" value="" name="id_card_number">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('page.mobile_number') }}</label>
                        <input type="text" class="form-control" value="" name="mobile_number">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('page.home_number') }}</label>
                        <input type="text" class="form-control" value="" name="home_number">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('page.work_place') }}</label>
                        <input type="text" class="form-control" value="" name="work_place">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('page.date_of_birth') }}</label>
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="mm/dd/yyyy" id="date_of_birth"
                                   name="date_of_birth" value="">
                            <div class="input-group-append bg-custom b-0"><span class="input-group-text"><i
                                            class="mdi mdi-calendar"></i></span></div>
                        </div><!-- input-group -->
                    </div>
                </div>
                <div style="display:none;" class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('page.status') }}</label>
                        <select class="form-control" name="status">
                            <option value="">{{ __('page.select_status') }}</option>
                            <option value="1">{{ __('page.active') }}</option>
                            <option value="2">{{ __('page.deactive') }}</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group mb-0">
                        <button type="submit" class="btn btn-primary">{{ __('page.add_customer') }} <i class="fas "></i>
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        $("#date_of_birth").hijriDatePicker({
            hijri: true,
            format: "DD/MM/YYYY",
            hijriFormat: 'iYYYY/iMM/iDD',
        });
    });
</script>