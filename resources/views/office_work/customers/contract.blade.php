<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==" crossorigin="anonymous" />
<style>
    .select2{
        width: 100% !important;
    }
</style>
<div class="card mb-0">
    @include('includes.form_error')
    <div class="card-body pb-0">
        <form method="POST" id="employment_contract" autocomplete="off">
            @csrf
            @if( isset( $Customers ) && count( $Customers ) == 0 )
               <h3 class="text-center mt-3 mb-3"> {{ __('page.contract_available') }}</h3>
            @else
                <div class="row">
                    @if( isset( $Customers ) && count( $Customers ) > 0 )
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{ __('page.customer') }}</label>
                            <select class="form-control select2" id="customer-id" name="customer_id">
                                <option value="">{{ __('page.select_customer') }}</option>
                                @foreach( $Customers as $Customer )
                                    <option value="{{ base64_encode(\Carbon\Carbon::now()->format('MY').'-'.base64_encode($Customer->id)) }}">{{ $Customer->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <input type="hidden" name="employment_contract" value="1">
                    @endif
                    <input type="hidden" name="employment_contract_id" value="@if( isset($EmploymentContract->id)) {{ $EmploymentContract->id }} @endif">
                    @php
                    $str = getContractNum();
                    @endphp
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{ __('page.contract_number') }}</label>
                            <input type="text" class="form-control" value="@if( isset($EmploymentContract->contract_number)) {{ $EmploymentContract->contract_number }} @else  {{ str_pad($str,6,'0',STR_PAD_LEFT) }} @endif" name="employment_Contract[contract_number]" readonly="">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{ __('page.nationality') }}</label>
                            <select id="select_nationality" class="form-control" name="employment_Contract[nationality_id]"">
                                <option value="">{{ __('page.select_nationality') }}</option>
                                @if( count($Nationalities) > 0 )
                                    @foreach( $Nationalities as $Nationality )
                                        <option value="{{ $Nationality->id }}"  @if( isset($EmploymentContract->nationality_id) && $EmploymentContract->nationality_id == $Nationality->id ) {{ "selected" }} @endif> {{ (Session::get('locale') =='en') ? $Nationality->nationality_english : $Nationality->nationality  }} </option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>

                     <div class="col-md-6">
                        <div class="form-group">
                            <label>{{ __('page.cv') }}</label>
                            <select class="form-control" name="employment_Contract[cv_id]" id="cvs_select">
                                <option value="">{{ __('page.select_cv') }}</option>
                                 @if( count($CV) > 0 )
                                    @foreach( $CV as $CV )
                                        <option value="{{ $CV->id }}"  @if( isset($EmploymentContract->cv_id) && $EmploymentContract->cv_id == $CV->id ) {{ "selected" }} @endif>{{  $CV->name  }} </option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{ __('page.date_of_contract') }}</label>
							<div class="input-group date datepicker-group">
                                <input type="text" class="form-control" placeholder="yyyy/mm/dd" id="date_of_contract2" name="date[date_of_contract]" value="{{ (isset($EmploymentContract->date_of_contract )) ? $EmploymentContract->date_of_contract : '' }}" >
                                <div class="input-group-append bg-custom b-0"><span class="input-group-addon input-group-text"><i class="mdi mdi-calendar"></i></span></div>
                            </div>
							</div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{ __('page.duration_of_the_contract') }}</label>
                            <input type="text" class="form-control" value="{{ (isset( $EmploymentContract->duration_of_the_contract) ) ? $EmploymentContract->duration_of_the_contract : ''  }}" name="employment_Contract[duration_of_the_contract]">
                        </div>
                    </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{ __('page.visa_type') }}</label>
                                <select class="form-control" name="employment_Contract[visa_type_id]">
                                    <option value="">{{ __('page.visa_type') }}</option>
                                        @foreach( $VisaTypes as $VisaType )
                                            <option value="{{ $VisaType->id }}"  @if( isset($EmploymentContract->visa_type_id) && $EmploymentContract->visa_type_id == $VisaType->id ) {{ "selected" }} @endif>{{  $VisaType->name  }} </option>
                                        @endforeach
                                </select>
                            </div>
                        </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{ __('page.visa_number') }}</label>
                            <input type="text" class="form-control" value="{{ ( isset($EmploymentContract->visa_number) ) ? $EmploymentContract->visa_number : ''  }}" name="employment_Contract[visa_number]">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{ __('page.number_of_applicants') }}</label>
                            <input type="text" class="form-control" value="{{ ( isset($EmploymentContract->number_of_applicants) ) ? $EmploymentContract->number_of_applicants : ''  }}" name="employment_Contract[number_of_applicants]">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{ __('page.age') }}</label>
                            <input type="text" id="age" class="form-control" value="{{ ( isset($EmploymentContract->age) ) ? $EmploymentContract->age : ''  }}" name="employment_Contract[age]">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{ __('page.religion') }}</label>
                            <select class="form-control" id="religion_id" name="employment_Contract[religion_id]">
                                <option value="">{{ __('page.select_religion') }}</option>
                                 @if( count($Religions) > 0 )
                                    @foreach( $Religions as $Religions )
                                        <option value="{{ $Religions->id }}"  @if( isset($EmploymentContract->religion_id) && $EmploymentContract->religion_id == $Religions->id ) {{ "selected" }} @endif>{{ (Session::get('locale') =='en') ? $Religions->religion_english : $Religions->religion  }} </option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                     <div class="col-md-6">
                        <div class="form-group">
                            <label>{{ __('page.contract_value') }}</label>
                            <input id="contract_value" type="number" class="form-control" value="{{ (isset( $EmploymentContract->contract_value) ) ? $EmploymentContract->contract_value : ''  }}" name="employment_Contract[contract_value]">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{ __('page.taxes_included') }}</label>

                            <input id="taxes_included" type="number" class="form-control" value="{{ (isset( $EmploymentContract->taxes_included) ) ? $EmploymentContract->taxes_included : ''  }}" name="employment_Contract[taxes_included]">

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{ __('page.discount') }}</label>
                            <input readonly id="discount" type="number" class="form-control" value="{{ ( isset($EmploymentContract->discount) ) ? $EmploymentContract->discount : ''  }}" name="employment_Contract[discount]">
                        </div>
                    </div>
					<div class="col-md-6">
                        <div class="form-group">
                            <label>{{ __('page.visa_date') }}</label>
                             <div class="input-group">
                                <input type="text" class="form-control" placeholder="yyyy/mm/dd" id="visa_date" name="date[visa_date]" value="{{ (isset($EmploymentContract->visa_date )) ? Carbon\Carbon::parse($EmploymentContract->visa_date)->format('Y/m/d') : '' }}" >
                                <div class="input-group-append bg-custom b-0"><span class="input-group-text"><i class="mdi mdi-calendar"></i></span></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{ __('page.external_office') }}</label>
                             <select class="form-control" id="office_idd" name="employment_Contract[office_id]">
                            <option value="">{{ __('page.select_office') }}</option>
                            @if( count($Offices) > 0 )
                                @foreach( $Offices as $Office )
                                 <option value="{{ $Office->id }}"  @if(  isset($EmploymentContract->office_id) && $EmploymentContract->office_id == $Office->id ) {{ "selected" }} @endif>{{ $Office->name }}</option>
                                @endforeach
                            @endif
                        </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{ __('page.occupation') }}</label>
                            <select class="form-control" id="profession_id" name="employment_Contract[profession_id]">
                                <option value="">{{ __('page.select_occupation') }}</option>
                                 @if( count($Professions) > 0 )
                                    @foreach( $Professions as $Profession )
                                        <option value="{{ $Profession->id }}"  @if( isset($EmploymentContract->profession_id)  && $EmploymentContract->profession_id == $Profession->id ) {{ "selected" }} @endif> {{ (Session::get('locale') =='en') ? $Profession->job_english : $Profession->occupation  }} </option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{ __('page.destination') }}</label>
                            <input type="text" class="form-control" value="{{ ( isset($EmploymentContract->destination_id) ) ? $EmploymentContract->destination_id : ''  }}" name="employment_Contract[destination_id]">

                            {{--                             <select class="form-control" name="employment_Contract[destination_id]">--}}
{{--                                <option value="">{{ __('page.select_destination') }}</option>--}}
{{--                                 @if( count($Destinations) > 0 )--}}
{{--                                    @foreach( $Destinations as $Destination )--}}
{{--                                        <option value="{{ $Destination->id }}"  @if( isset($EmploymentContract->destination_id) && $EmploymentContract->destination_id == $Destination->id ) {{ "selected" }} @endif> {{ $Destination->destination }} </option>--}}
{{--                                    @endforeach--}}
{{--                                @endif--}}
{{--                            </select>--}}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{ __('page.monthly_salary') }}</label>
                            <input type="text" class="form-control" value="{{ ( isset($EmploymentContract->monthly_salary) ) ? $EmploymentContract->monthly_salary : ''  }}" name="employment_Contract[monthly_salary]">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{ __('page.contract_source') }}</label>
                            <select class="form-control" name="employment_Contract[contract_source_id]">
                                <option value="">{{ __('page.select_contract_source') }}</option>
                                 @if( count($ContractSources) > 0 )
                                    @foreach( $ContractSources as $ContractSource )
                                        <option value="{{ $ContractSource->id }}"  @if( isset($EmploymentContract->contract_source_id) && $EmploymentContract->contract_source_id == $ContractSource->id ) {{ "selected" }} @endif> {{ $ContractSource->source }} </option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{ __('page.arrival_airport') }}</label>
                            <select class="form-control" name="employment_Contract[airport_id]">
                                <option value="">{{ __('page.select_airport') }}</option>
                                 @if( count($Airports) > 0 )
                                    @foreach( $Airports as $Airports )
                                        <option value="{{ $Airports->id }}"  @if( isset($EmploymentContract->airport_id) && $EmploymentContract->airport_id == $Airports->id ) {{ "selected" }} @endif>{{ (Session::get('locale') =='en') ? $Airports->airport_english : $Airports->airport  }} </option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{ __('page.terms_and_advantages') }}</label>
                            <select class="form-control" name="employment_Contract[terms_and_advantages_id]">
                                <option value="">{{ __('page.select_terms_and_advantages') }}</option>
                                 @if( count($TermsAndAdvantages) > 0 )
                                    @foreach( $TermsAndAdvantages as $TermsAndAdvantage )
                                        <option value="{{ $TermsAndAdvantage->id }}"  @if( isset($EmploymentContract->terms_and_advantages_id) && $EmploymentContract->terms_and_advantages_id == $TermsAndAdvantage->id ) {{ "selected" }} @endif>{{ $TermsAndAdvantage->terms_and_advantage  }} </option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{ __('page.qualifications_and_experience') }}</label>
                            <select class="form-control" name="employment_Contract[qualifications_and_experience_id]">
                                <option value="">{{ __('page.select_qualifications_and_experience') }}</option>
                                 @if( count($QualificationsAndExperiences) > 0 )
                                    @foreach( $QualificationsAndExperiences as $QualificationsAndExperience )
                                        <option value="{{ $QualificationsAndExperience->id }}"  @if( isset($EmploymentContract->qualifications_and_experience_id) && $EmploymentContract->qualifications_and_experience_id == $QualificationsAndExperience->id ) {{ "selected" }} @endif>{{ $QualificationsAndExperience->qualifications_and_experience  }} </option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{ __('page.cost_center') }}</label>
                            <select class="form-control" name="employment_Contract[cost_center_id]">
                                <option value="">{{ __('page.select_cost_center') }}</option>
                                 @if( count($CostCenters) > 0 )
                                    @foreach( $CostCenters as $CostCenter )
                                        <option value="{{ $CostCenter->id }}"  @if( isset($EmploymentContract->cost_center_id) && $EmploymentContract->cost_center_id == $CostCenter->id ) {{ "selected" }} @endif>{{ (Session::get('locale') =='en') ? $CostCenter->center_name_english : $CostCenter->center_name  }} </option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{ __('page.marketer') }}</label>
                            <select class="form-control" name="employment_Contract[marketer_id]">
                                <option value="">{{ __('page.select_marketer') }}</option>
                                 @if( count($Marketers) > 0 )
                                    @foreach( $Marketers as $Marketer )
                                        <option value="{{ $Marketer->id }}"  @if( isset($EmploymentContract->marketer_id) && $EmploymentContract->marketer_id == $Marketer->id ) {{ "selected" }} @endif>{{ $Marketer->marketer  }} </option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{ __('page.marketer_fare') }}</label>
                            <input type="text" class="form-control" value="{{ ( isset($EmploymentContract->marketer_fare) ) ? $EmploymentContract->marketer_fare : ''  }}" name="employment_Contract[marketer_fare]">
                        </div>
                    </div>
                     <div class="col-md-6">
						<div class="form-group">
                            <label>{{ __('page.arrival_date') }}</label>
							<div class="input-group date datepicker-group">
								<input class="form-control" type="text" id="arrival_date" name="date[arrival_date]" value="{{ (isset($EmploymentContract->arrival_date )) ? $EmploymentContract->arrival_date : '' }}"  />
								<div class="input-group-append bg-custom b-0"> <span class="input-group-addon input-group-text"><i class="mdi mdi-calendar"></i></span></div>
							</div>
						</div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{ __('page.arrival_time') }}</label>
                            <div class="input-group">
                                <input type="time" class="form-control text-left" name="employment_Contract[arrival_time]" value="{{ (isset($EmploymentContract->arrival_time )) ? Carbon\Carbon::parse($EmploymentContract->arrival_time)->format('H:i')  : '' }}"  min="00:00" max="24:59" >
                                <div class="input-group-append bg-custom b-0"><span class="input-group-text"><i class="mdi mdi-clock-outline"></i></span></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{ __('page.flight_number') }}</label>
                            <input type="text" class="form-control" id="ticket" name="employment_Contract[ticket]" value="{{ (isset($EmploymentContract->ticket )) ?  $EmploymentContract->ticket  : '' }}" >
                        </div>
                    </div>
                </div>
                @php
                $extradata = ( isset($EmploymentContract->extradata) ) ? json_decode($EmploymentContract->extradata,true) : array() ;
                $i = 0;
                $j = 0;
                @endphp
                <div class="status">
                    <div class="row">
                        @if( isset($EmploymentContract->nationality_id) )
                            @if( count($Status) > 0 )
                                @foreach( $Status as $Status )
                                    @if(  $Status->nationality_id == $EmploymentContract->nationality_id )
                                        @if( $Status->office_type == '1' )
                                            @if(  $i == 0 )
                                            <div class="col-md-12">
                                                <label>{{ __('page.local_office') }}</label>
                                            </div>
                                            @endif
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" id="status_{{$Status->id}}" data-parsley-multiple="groups" data-parsley-mincheck="2" value="{{$Status->id }}" name="extradata[{{ $Status->id }}]"   @if( in_array($Status->id,$extradata) ) {{ 'checked' }} @endif>
                                                        <label class="custom-control-label" for="status_{{$Status->id}}">{{ $Status->name }}</label>
                                                    </div>
                                                </div>
                                            </div>
                                            @php $i++; @endphp
                                        @else
                                            @if(  $j == 0 )
                                            <div class="col-md-12">
                                                <label>{{ __('page.outside_office') }}</label>
                                            </div>
                                            @endif
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" id="status_{{$Status->id}}" data-parsley-multiple="groups" data-parsley-mincheck="2" value="{{$Status->id }}" name="extradata[{{ $Status->id }}]"   @if( in_array($Status->id,$extradata) ) {{ 'checked' }} @endif>
                                                        <label class="custom-control-label" for="status_{{$Status->id}}">{{ $Status->name }}</label>
                                                    </div>
                                                </div>
                                            </div>
                                           @php $j++; @endphp
                                        @endif
                                    @endif
                                @endforeach
                            @endif
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>{{ __('page.notes') }}</label>
                            <textarea class="form-control" rows="5" id="notes" name="notes">{{ (isset( $EmploymentContract->notes) ) ? $EmploymentContract->notes : ''  }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group mb-0">
                            <button type="submit" class="btn btn-primary"  data-id="{{ (isset($Customer->id)) ? base64_encode(\Carbon\Carbon::now()->format('MY').'-'.base64_encode($Customer->id)) : '' }}">{{ __('page.save_contract') }} <i class="fas "></i></button>
                        </div>
                    </div>
                </div>
            @endif
        </form>
    </div>
</div>

<script type="text/javascript">
    $( document ).ready( function(){
		var currentDate = new Date();
		$('.datepicker-group').datepicker({
		format: 'yyyy-mm-dd',
		autoclose:true,
		todayBtn:true,
		todayHighlight:true,
		//startDate:currentDate
		});


        $('#arrival_date1').hijriDatePicker({
            hijri : true,
            format: "DDMM/YYYY",
            hijriFormat: 'iYYYY/iMM/iDD',
        });
        $('#date_of_contract').hijriDatePicker({
            hijri : true,
            format: "DD/MM/YYYY",
            hijriFormat: 'iYYYY/iMM/iDD',
        });
        $('#visa_date').hijriDatePicker({
            hijri : true,
            format: "DD/MM/YYYY",
            hijriFormat: 'iYYYY/iMM/iDD',
        });
        $('.select2').select2({
            dropdownParent: ".modal"
        });
        $.fn.modal.Constructor.prototype.enforceFocus = function() {};

    });

</script>
<script type="text/javascript">
    $(document).ready(function(){
        var baseUrl = $("#baseUrl").data('url');
        $( "#contract_value" ).keyup(function() {
            calc();
        });
        $( "#taxes_included" ).keyup(function() {
            calc();
        });

        function calc(){

            var contract_value = $( "#contract_value" ).val() || 0;

            var taxes_included = $( "#taxes_included" ).val() || 0;

            var calcu =  parseFloat(contract_value)+ parseFloat(contract_value * (taxes_included/100));

            $('#discount').val(calcu);
        }

        $(document).on('change', '#select_nationality', function () {
            var nationality_id = $(this).val();
            $.ajax({
                url: baseUrl+"/office-work/contract/select_nationality/"+nationality_id,
                type: 'GET',
                success: function (data) {
                    $('#cvs_select').html(data.view);
                }
            });
        });

        $(document).on('change', '#cvs_select', function () {
            var cv_id = $(this).val();

            $.ajax({
                url: baseUrl+"/office-work/contract/select_cv/"+cv_id,
                type: 'GET',
                success: function (data) {
                    $('#religion_id option[value='+data.religion_id+']').attr('selected','selected');
                    $('#profession_id option[value='+data.profession_id+']').attr('selected','selected');
                    $('#office_idd option[value='+data.office_id+']').attr('selected','selected');
                    $('#age').val(data.age);
                }
            });
        });

    });
</script>