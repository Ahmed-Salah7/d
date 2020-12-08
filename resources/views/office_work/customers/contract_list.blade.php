@extends('layouts.app')
@section('title') Contract list @endsection
@section('content')
<!-- Page-Title -->
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h4 class="page-title m-0">{{ __('page.contract_list') }}</h4>
                </div>
                <div class="col-md-4">
                    <div class="float-right">
                        <div class="dropdown">
                            <button class="btn btn-primary add-customer-contract" type="button" data-title="{{ __('page.employment_contract') }}">
                                <i class="ti-plus mr-1"></i> {{ __('page.add_contract') }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="mx-1">
                    <a href="{{ url('/office-work/contract-list') }}" class="btn btn-primary">
                        {{ __('page.contract_list') }}
                    </a>
                </div>
                <div class="mx-1">
                    <a href="{{ url('/office-work/contract-list') }}?compleated=1" class="btn btn-primary">
                        {{ __('page.contract_compleated') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end page title end breadcrumb -->
<div class="row">
    <div class="col-12">
        <div class="card m-b-30">
             @include('includes.message')
            <form method="GET" autocomplete="off" class="mt-3 pl-md-4 pr-md-4" id="search">
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>{{ __('page.contract_no') }}</label>
                            <input type="text" class="form-control" id="contract_no" name="contract_no" value="" >
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>{{ __('page.from_date') }}</label>
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="yyyy/mm/dd" id="startdate" name="startdate" value="" >
                                <div class="input-group-append bg-custom b-0"><span class="input-group-text"><i class="mdi mdi-calendar"></i></span></div>
                            </div><!-- input-group -->
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>{{ __('page.to_date') }}</label>
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="yyyy/mm/dd" id="enddate" name="enddate" value="" >
                                <div class="input-group-append bg-custom b-0"><span class="input-group-text"><i class="mdi mdi-calendar"></i></span></div>
                            </div><!-- input-group -->
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>{{ __('page.nationality') }}</label>
                            <select class="form-control" name="nationality_id" id="nationality_id">
                                <option value="">{{ __('page.select_nationality') }}</option>
                                @if( count($Nationalities) > 0 )
                                    @foreach( $Nationalities as $Nationality )
                                        <option value='{{ $Nationality->id }}'> {{ (Session::get('locale') =='en') ? $Nationality->nationality_english : $Nationality->nationality  }} </option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label>{{ __('page.office') }}</label>
                            <select class="form-control" name="office_id" id="office_id">
                                <option value="">{{ __('page.select_office') }}</option>
                                @if( count(\App\Offices::get()) > 0 )
                                    @foreach( \App\Offices::get() as $Office )
                                        <option value="{{ $Office->id }}">{{ $Office->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>&nbsp;</label><br>
                            <button type="submit" class="btn btn-primary btn-sm btn-block waves-effect waves-light"><i class="fas fa-search"></i> {{ __('page.search') }} <i class="fas spinner "></i></button>
                        </div>
                    </div>
                </div>
            </form>

            <div class="card-body">
                <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                    <tr>
                        <th width="5%"> {{ __('page.customer_name') }}</th>
                        <th width="5%"> {{ __('page.contract_no') }}</th>
                        <th width="10%"> {{ __('page.contract_date') }}</th>
                        <th width="10%"> {{ __('page.candidate') }}</th>
                        <th width="10%"> {{ __('page.profession') }}</th>
                        <th width="5%"> {{ __('page.remainder_contract') }}</th>
                        <th width="5%"> {{ __('page.arrival_date') }}</th>
                        <th width="5%"> {{ __('page.religion') }}</th>
                        <th width="10%"> {{ __('page.nationality') }}</th>
                        <th width="10%"> {{ __('page.contract_value') }}</th>
{{--                        <th width="10%"> {{ __('page.internal') }}</th>--}}
                        <th width="10%"> {{ __('page.source') }}</th>
                        <th width="10%"> {{ __('page.external') }}</th>
						@php
						$approval = Request::query('approval', false);
						if(isset($approval)&&$approval) {
						@endphp
                        <th width="5%"> {{ __('page.approve') }}</th>
						@php
						}
						@endphp
                        <th width="5%"> {{ __('page.action') }}</th>
                    </tr>
                    </thead>

                </table>
            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->
<div class="modal fade bs-example-modal-lg employment-contract-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="myLargeModalLabel"></h5>
                <button type="button" class="close contract-close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="modal-spinner">
                    <div class="d-flex justify-content-center mt-5 mb-5">
                        <div class="spinner-border" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                    </div>
                </div>
                <div class="employment-contract-result">
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@endsection
@section('js')
<?$v = 5;?>
<script type="text/javascript">
    $( document ).ready( function(){

        var $columns = [
                    { data: 'customer_name', name: 'customer_name' },
                    { data: 'contract_number', name: 'contract_number' },
                    { data: 'date_of_contract', name: 'date_of_contract' },
                    { data: 'cv_name', name: 'cv_name' },
                    // { data: 'candidate', name: 'candidate' },
                    { data: 'profession', name: 'profession' },
                    { data: 'remainder_contract', name: 'remainder_contract' },
                    { data: 'arrival_date', name: 'arrival_date' },
                    { data: 'religion', name: 'religion' },
					{ data: 'nationality', name: 'nationality' },
                    { data: 'contract_value', name: 'contract_value' },
                    // { data: 'local', name: 'local'},
                    { data: 'source', name: 'source'},
                    { data: 'outside', name: 'outside'},
					@php
					$approval = Request::query('approval', false);
					if(isset($approval)&&$approval) {
					@endphp
						{ data: 'status', name: 'status'},
					@php }
					@endphp
                    { data: 'action', name: 'action'},
                   ];

        var baseUrl = $("#baseUrl").data('url');
        var token = $("#token").attr('content');
        $('#datatable').DataTable({
                "language": {
                    "url": lang
                },
             processing: true,
             serverSide: true,
             ordering: false,
             ajax: {
             url: baseUrl+"/office-work/contract-list" ,
              type: 'GET',
              data: function (d) {
                    d.approved = '{{ request()->get('approved')  }}';
                    d.compleated = '{{ request()->get('compleated')  }}';
                    d.approval = '{{ request()->get('approval')  }}';
                    d.overduecontracts = '{{ request()->get('overduecontracts')  }}';
                    d.arrivals = '{{ request()->get('arrivals')  }}';
                    d.underwarranty = '{{ request()->get('underwarranty')  }}';
                    d.c_id = '{{ request()->get('c_id')  }}';
                      d.nationality_id = $('#nationality_id').val();
                      d.office_id = $('#office_id').val();
                      d.startdate = $('#startdate').val();
                      d.enddate = $('#enddate').val();
                      d.contract_no = $('#contract_no').val();
                },
             },
             columns: $columns,
             /*columns: [
                    { data: 'customer_name', name: 'customer_name' },
                    { data: 'contract_number', name: 'contract_number' },
                    { data: 'date_of_contract', name: 'date_of_contract' },
                    { data: 'duration_of_the_contract', name: 'duration_of_the_contract' },
                    { data: 'contract_value', name: 'contract_value' },
                    { data: 'monthly_salary', name: 'monthly_salary' },
                    { data: 'religion', name: 'religion' },
                    { data: 'age', name: 'age' },
                    { data: 'status', name: 'status'},
                    { data: 'displayed', name: 'displayed'},
                    { data: 'action', name: 'action'},
                   ],*/
            order: [[0, 'desc']]
        });

        $( document ).on( "submit","#search",function( event ) {
            event.preventDefault();
            var formObj = $(this);
            var btnObj   = formObj.find('button[type="submit"]');
            btnObj.attr("disabled",true);
            btnObj.find("i.spinner").addClass('fa-spinner fa-spin');
            var oTable = $('#datatable').dataTable();
            oTable.fnDraw(false);
            btnObj.attr("disabled",false);
            btnObj.find("i.spinner").removeClass('fa-spinner fa-spin');
        });

         //customer code
        $( document ).on( "click",".contract_status",function( event ) {
            var thisObj = $(this);
            var status = 1;
            var id  = $(this).data('id');
            var formdata = {'id':id,'status':status};
            if( status ){
                $.ajax({
                    url: baseUrl+"/office-work/contract-status-update",
                    type:'GET',
                    data:formdata,
                    success: function(data) {
                        if($.isEmptyObject(data.error)){
                            printSuccessMsg(data.success);
							thisObj.remove();
                            var oTable = $('#datatable').dataTable();
                            oTable.fnDraw(false);
                            formObj[0].reset();
                        } else {
                            singleErrorMsg(data.error);
                        }
                    }
                });
            }
        });


        $( document ).on( "change",".displayed_status",function( event ) {
            var thisObj = $(this);
            if ($(this).prop('checked')==true){
                var displayed = 1;
            } else {
                var displayed = 2;
            }
            var id  = $(this).data('id');
            var formdata = {'id':id,'displayed':displayed};
            if( displayed ){
                $.ajax({
                    url: baseUrl+"/office-work/displayed-status-update",
                    type:'GET',
                    data:formdata,
                    success: function(data) {
                        if($.isEmptyObject(data.error)){
                            printSuccessMsg(data.success);
                        } else {
                            thisObj.prop("checked", false);
                            singleErrorMsg(data.error);
                        }
                    }
                });
            }
        });

        $( document ).on( "click",".contract-close",function( event ) {
            var recordMsgarray = jQuery.parseJSON($(".contract-close-record-msg").text());
            swal(
            {
                title: recordMsgarray.title,
                text:  recordMsgarray.text,
                type: 'info',
                showCancelButton: true,
                confirmButtonText: recordMsgarray.confirm_btn_text,
                cancelButtonText: recordMsgarray.cancel_btn_text,
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger m-l-10',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    $( "#employment_contract" ).submit();
                    event.preventDefault();
                } else if ( result.dismiss === 'cancel' ) {
                    $(".employment-contract-modal").modal('hide');
                }
            })
        });


        $( document ).on( "click",".customer-contract",function( event ) {
            var title = $(this).data('title');
            $('.modal-title').text(title);
            $(".modal-spinner").show();
            $('.employment-contract-result').html("");
            $(".employment-contract-modal").modal({
                backdrop: 'static',
                keyboard: true,
                show: true});
            var id = $(this).data('id');
            $.ajax({
                url: baseUrl+"/office-work/get-customer-contracts/"+id,
                // url: baseUrl+"/office-work/get-customer-contracts/",
                type:'GET',
                success: function(data) {
                    $(".modal-spinner").hide();
                    $('.employment-contract-result').html(data.view);
                }
            });
        });

        $( document ).on( "click",".add-customer-contract",function( event ) {
            var title = $(this).data('title');
            $('.modal-title').text(title);
            $(".modal-spinner").show();
            $('.employment-contract-result').html("");
            $(".employment-contract-modal").modal({
                backdrop: 'static',
                keyboard: true,
                show: true});
            var id = $(this).data('id');
            $.ajax({
                url: baseUrl+"/office-work/get-customer-contracts/",
                type:'GET',
                success: function(data) {
                    $(".modal-spinner").hide();
                    $('.employment-contract-result').html(data.view);
                }
            });
        });

        $( document ).on( "change","#nationality_id",function( event ) {
            var id = $(this).val();
            $('.status').html();
            if( id ) {
                $.ajax({
                    url: baseUrl+"/office-work/get-contract-status/"+id,
                    type:'GET',
                    success: function(data) {
                        $(".modal-spinner").hide();
                        $('.status').html(data.view);
                    }
                });
            }
        });

        $( document ).on( "submit","#employment_contract",function( event ) {
            event.preventDefault();
            $(".print-error-msg").css('display','none');
            $(".print-success-msg").css('display','none');
            //define variation
            var errors = 0;
            //get fome object
            var formObj = $(this);
             //get button object
            var btnObj   = formObj.find('button[type="submit"]');
            var formdata = formObj.serialize();
            var id = btnObj.data('id');
             errors = costomerContractValidation(formObj,errors);

            if( errors == 0 ) {
                btnObj.attr("disabled",true);
                btnObj.find("i").addClass('fa-spinner fa-spin');
                $.ajax({
                    url: baseUrl+"/office-work/employment-contract/"+id,
                    type:'POST',
                    data:formdata,
                    success: function(data) {
                        if($.isEmptyObject(data.error)){
                            $(".employment-contract-modal").modal('hide');
                           printSuccessMsg(data.success);
                        } else {
                            printErrorMsg(data.error);
                        }
                        btnObj.attr("disabled",false);
                        btnObj.find("i").removeClass('fa-spinner fa-spin');
                        var oTable = $('#datatable').dataTable();
                        oTable.fnDraw(false);
                        formObj[0].reset();
                    }
                });
            }
        });

        $( document ).on( "click",".delete-customer_contract",function( event ) {
            var recordMsgarray = jQuery.parseJSON($(".delete-record-msg").text());
            var id = $(this).data('id');
            var table = $('#datatable').DataTable();
            var tableRow =  $(this).closest("tr");
            Swal.fire({
                title: recordMsgarray.title,
                text:  recordMsgarray.text,
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText:  recordMsgarray.cancel_btn_text,
                confirmButtonText:  recordMsgarray.confirm_btn_text
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: baseUrl+"/office-work/delete-contract",
                        type: "POST",
                        data: {_token: token,id:id },
                        success: function (data) {
                            if($.isEmptyObject(data.error)){
                                table.row(tableRow).remove().draw( false );
                                swal(
                                    recordMsgarray.deleted_title,
                                    data.success,
                                    'success'
                                );
                            } else {
                                singleErrorMsg(data.error);
                            }
                        }
                    });
                }
            })
        });

    });
    function costomerContractValidation(formObj,errors,edit=''){
    //remove error class
        formObj.find('input').removeClass('parsley-error');
        formObj.find('span').removeClass('parsley-error');

        //find flields
        var contractNumberObj = formObj.find('input[name="employment_Contract[contract_number]"]');
        var contractNumber    = contractNumberObj.val();

        var contractValueObj = formObj.find('input[name="employment_Contract[contract_value]"]');
        var contractValue    = contractValueObj.val();

        var visaNumberObj = formObj.find('input[name="employment_Contract[visa_number]"]');
        var visaNumber    = visaNumberObj.val();

        var nationalityIdObj = formObj.find('select[name="employment_Contract[nationality_id]"]');
        var nationalityId    = nationalityIdObj.val();

        var monthlySalaryObj = formObj.find('input[name="eemployment_Contract[monthly_salary]"]');
        var monthlySalary    = monthlySalaryObj.val();

        //check value
        if( monthlySalary =="" ) {
            errors = 1;
            monthlySalaryObj.addClass('parsley-error');
            monthlySalaryObj.focus();
        }
        if( nationalityId =="" ) {
            errors = 1;
            nationalityIdObj.addClass('parsley-error');
            nationalityIdObj.focus();
        }
        if( visaNumber =="" ) {
            errors = 1;
            visaNumberObj.addClass('parsley-error');
            visaNumberObj.focus();
        }
        if( contractValue =="" ) {
            errors = 1;
            contractValueObj.addClass('parsley-error');
            contractValueObj.focus();
        }
        if( contractNumber =="" ) {
            errors = 1;
            contractNumberObj.addClass('parsley-error');
            contractNumberObj.focus();
        }

        return errors;
    }
    $('#startdate').hijriDatePicker({
        hijri : true,
        format: "DD/MM/YYYY",
        hijriFormat: 'iYYYY/iMM/iDD',
    });
    $('#enddate').hijriDatePicker({
        hijri : true,
        format: "DD-MM-YYYY",
        hijriFormat: 'iYYYY/iMM/iDD',
    });
</script>
@endsection