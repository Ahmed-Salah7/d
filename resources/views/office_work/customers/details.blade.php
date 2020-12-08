<div class="card mb-0">
    @include('includes.form_error')
    <div class="card-body pb-0">
        <form method="POST" id="updat_customer_details" autocomplete="off" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('page.name') }}</label>
                        <input type="text" class="form-control" value="{{ $Customer->name }}" name="name">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('page.id_number') }}</label>
                        <input type="text" class="form-control" value="{{ $Customer->id_number }}" name="id_number" readonly>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('page.id_card_number') }}</label>
                        <input type="number" class="form-control" value="{{ $Customer->id_card_number }}" name="id_card_number">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('page.nationality') }}</label>
                        <select class="form-control" name="nationality_id">
                            <option value="">{{ __('page.select_nationality') }}</option>
                            @if( count($Nationalities) > 0 )
                                @foreach( $Nationalities as $Nationality )
                                    <option value="{{ $Nationality->id }}"  @if( isset($Customer->nationality_id) && $Customer->nationality_id == $Nationality->id ) {{ "selected" }} @endif> {{ (Session::get('locale') =='en') ? $Nationality->nationality_english : $Nationality->nationality  }} </option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('page.date_of_birth') }}</label>
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="yyyy/mm/dd" id="date_of_birth" name="date_of_birth" value="{{ Carbon\Carbon::parse($Customer->date_of_birth)->format('Y/m/d') }}" >
                            <div class="input-group-append bg-custom b-0"><span class="input-group-text"><i class="mdi mdi-calendar"></i></span></div>
                        </div><!-- input-group -->
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('page.mobile_number') }}</label>
                        <input type="text" class="form-control" value="{{ $Customer->mobile_number }}" name="mobile_number">
                    </div>
                </div>
                 <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('page.address_arabic') }}</label>
                        <input type="text" class="form-control" value="{{ (isset($CustomerDetail->address_arabic)) ? $CustomerDetail->address_arabic : '' }}" name="customer_details[address_arabic]">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('page.work_place') }}</label>
                        <input type="text" class="form-control" value="{{ (isset($Customer->work_place)) ? $Customer->work_place : '' }}" name="work_place">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('page.social_status_arabic') }}</label>
                        <input type="text" class="form-control" value="{{ (isset($CustomerDetail->social_status_arabic)) ? $CustomerDetail->social_status_arabic : '' }}" name="customer_details[social_status_arabic]">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('page.social_status_english') }}</label>
                        <input type="text" class="form-control" value="{{ (isset($CustomerDetail->social_status_english)) ? $CustomerDetail->social_status_english : '' }}" name="customer_details[social_status_english]">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('page.number_of_family_members') }}</label>
                        <input type="number" class="form-control" value="{{ (isset($CustomerDetail->number_of_family_members)) ? $CustomerDetail->number_of_family_members : '' }}" name="customer_details[number_of_family_members]">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('page.house_type') }}</label>
                        <input type="text" class="form-control" value="{{ (isset($CustomerDetail->house_type)) ? $CustomerDetail->house_type : '' }}" name="customer_details[house_type]">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('page.email') }}</label>
                        <input type="email" class="form-control" value="{{ (isset($CustomerDetail->email)) ? $CustomerDetail->email : '' }}" name="customer_details[email]">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('page.expiry_date') }}</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="expiry_date" name="customer_details[expiry_date]" value="{{ (isset($CustomerDetail->expiry_date )) ? Carbon\Carbon::parse($CustomerDetail->expiry_date) : '' }}" >
                            <div class="input-group-append bg-custom b-0"><span class="input-group-text"><i class="mdi mdi-calendar"></i></span></div>
                        </div><!-- input-group -->
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('page.created_at_customer') }}</label>
                        <input type="date" class="form-control" value="{{ (isset($Customer->created_at)) ? Carbon\Carbon::parse($Customer->created_at)->format('Y-m-d') : '' }}" name="created_at">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('page.name_is_English') }}</label>
                        <input type="text" class="form-control" value="{{ (isset($CustomerDetail->name_is_English)) ? $CustomerDetail->name_is_English : '' }}" name="customer_details[name_is_English]">
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label>{{ __('page.notes') }}</label>
                        <input type="text" class="form-control" value="{{ (isset($CustomerDetail->notes)) ? $CustomerDetail->notes : '' }}" name="customer_details[notes]">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('page.id_card_image') }}</label>
                        <input type="file" name="id_card_image">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <img src="{{url('/').'/'}}{{ isset($CustomerDetail->id_card_image) ? $CustomerDetail->id_card_image : '' }}" width="150px" height="150px">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('page.attatches') }}</label>
                        <input type="file" name="attatches">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <img src="{{url('/').'/'}}{{ (isset($CustomerDetail->attatches)) ? $CustomerDetail->attatches : '' }}" width="150px" height="150px">
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group mb-0">
                        <button type="submit" class="btn btn-primary"  data-id="{{ base64_encode(\Carbon\Carbon::now()->format('MY').'-'.base64_encode($Customer->id)) }}">{{ __('page.update_customer_details') }} <i class="fas "></i></button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<script type="text/javascript">
    $( document ).ready( function(){
        $('#expiry_date').hijriDatePicker({
            hijri : true,
            format: "DD/MM/YYYY",
            hijriFormat: 'iYYYY/iMM/iDD',
        });
        $('#release_date').hijriDatePicker({
            hijri : true,
            format: "DD/MM/YYYY",
            hijriFormat: 'iYYYY/iMM/iDD',
        });
    });
</script>