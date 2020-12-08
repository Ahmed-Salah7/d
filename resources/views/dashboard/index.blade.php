@extends('layouts.app')
@section('title') Dashboard @endsection

<style>
    body {

    }
</style>

@section('content')
    <!-- Page-Title -->
    <?php
    /*echo "<pre>";
    print_r($result);
    exit;*/
    ?>
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h4 class="page-title m-0"> {{ __('page.dashboard') }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- end page title end breadcrumb -->
    <div class="row">
        <div class="col-md-12">
            @include('includes.message')
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-primary mini-stat text-white">
                <div class="p-3 mini-stat-desc">
                    <div class="clearfix">
                        <a href="{{ url('/office-work/customer') }}"><h6
                                    class="text-uppercase mt-0 float-left text-white-50">{{  __('page.customers') }}</h6>
                        </a>
                        <h4 class="mb-3 mt-0 float-right">{{ $TotlaCustomer }}</h4>
                    </div>
                </div>
                <div class="p-3">
                    <div class="float-right">
                        <a href="#" class="text-white-50"><i class="mdi mdi-account h5"></i></a>
                    </div>
                    <p class="font-14 m-0"><a href="javascript:;" class="add-customer text-white "
                                              data-title="{{ __('page.add_customer') }}">{{ __('page.add_customer') }}</a>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-info mini-stat text-white">
                <div class="p-3 mini-stat-desc">
                    <div class="clearfix">
                        <a href="{{ url('/office-work/contract-list/?approval='.base64_encode(\Carbon\Carbon::now()->format('MY').'-'.base64_encode(2))) }}">
                            <h6 class="text-uppercase mt-0 float-left text-white-50">{{ __('page.approval') }}</h6></a>
                        <h4 class="mb-3 mt-0 float-right">{{ $TotalApproval }}</h4>
                    </div>
                </div>
                <div class="p-3">
                    <div class="float-right">
                        <a href="#" class="text-white-50"><i class="mdi mdi-checkbox-marked-circle h5"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-pink mini-stat text-white">
                <div class="p-3 mini-stat-desc">
                    <div class="clearfix">
                        <a href="{{ url('/office-work/contract-list?approved='.base64_encode(\Carbon\Carbon::now()->format('MY').'-'.base64_encode(2))) }}">
                            <h6 class="text-uppercase mt-0 float-left text-white-50">{{ __( 'page.contracts' ) }}</h6>
                        </a>
                        <h4 class="mb-3 mt-0 float-right">{{ $TotalContracts }}</h4>
                    </div>
                </div>
                <div class="p-3">
                    <div class="float-right">
                        <a href="#" class="text-white-50"><i class="mdi mdi-file-document h5"></i></a>
                    </div>
                    <p class="font-14 m-0"><a href="javascript:;" class="customer-contract text-white"
                                              data-title="{{ __('page.employment_contract') }}"> {{ __('page.add_contract') }}</a>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-success mini-stat text-white">
                <div class="p-3 mini-stat-desc">
                    <div class="clearfix">
                        <a href="{{ url('/office-work/contract-list/?overduecontracts='.base64_encode(\Carbon\Carbon::now()->format('MY').'-'.base64_encode(2))) }}">
                            <h6 class="text-uppercase mt-0 float-left text-white-50">{{ __('page.overdue_contracts') }}</h6>
                        </a>
                        <h4 class="mb-3 mt-0 float-right">{{ $TotalOverdueContracts }}</h4>
                    </div>
                </div>
                <div class="p-3">
                    <div class="float-right">
                        <a href="#" class="text-white-50"><i class="mdi mdi-timetable h5"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-warning mini-stat text-white">
                <div class="p-3 mini-stat-desc">
                    <div class="clearfix">
                        <a href="{{ url('/office-work/cv') }}"><h6
                                    class="text-uppercase mt-0 float-left text-white-50">{{ __( 'page.cv' ) }}</h6></a>
                        <h4 class="mb-3 mt-0 float-right">{{ $TotlaCV  }}</h4>
                    </div>
                </div>
                <div class="p-3">
                    <div class="float-right">
                        <a href="#" class="text-white-50"><i class="mdi mdi-file-find h5"></i></a>
                    </div>
                    <a href="javasript:;" class="add-cv text-white " data-title="{{ __('page.add_cv') }}">
                        {{ __('page.add_cv') }}
                    </a>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-danger mini-stat text-white">
                <div class="p-3 mini-stat-desc">
                    <div class="clearfix">
                        <a href="{{ url('/office-work/contract-list/?arrivals='.base64_encode(\Carbon\Carbon::now()->format('MY').'-'.base64_encode(2))) }}">
                            <h6 class="text-uppercase mt-0 float-left text-white-50">{{ __('page.arrivals') }}</h6></a>
                        <h4 class="mb-3 mt-0 float-right">{{ $TotalArrivals }}</h4>
                    </div>
                </div>
                <div class="p-3">
                    <div class="float-right">
                        <a href="#" class="text-white-50"><i class="mdi mdi-airplane-landing h5"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-secondary    mini-stat text-white">
                <div class="p-3 mini-stat-desc">
                    <div class="clearfix">
                        <a href="{{ url('/office-work/contract-list/?underwarranty='.base64_encode(\Carbon\Carbon::now()->format('MY').'-'.base64_encode(2))) }}">
                            <h6 class="text-uppercase mt-0 float-left text-white-50">{{ __('page.under_warranty') }}</h6>
                        </a>
                        <h4 class="mb-3 mt-0 float-right">{{ $UnderWarranty }}</h4>
                    </div>
                </div>
                <div class="p-3">
                    <div class="float-right">
                        <a href="https://ossesapp.com/app/office-work/contract-list?underwarranty=RmViMjAyMC1NZz09"
                           class="text-white-50"><i class="mdi mdi-bookmark-check h5"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-primary mini-stat text-white">
                <div class="p-3 mini-stat-desc">
                    <div class="clearfix">
                        <a href="{{ url('/accommodation') }}"><h6
                                    class="text-uppercase mt-0 float-left text-white-50">{{  __('page.accommodation') }}</h6>
                        </a>
                        <h4 id="add_number_worker" class="mb-3 mt-0 float-right">{{ $workersCount }}</h4>
                    </div>
                </div>
                <div class="p-3">
                    <div class="float-right">
                        <a href="#" class="text-white-50"><i class="mdi mdi-account h5"></i></a>
                    </div>
                    <p class="font-14 m-0"><a href="javascript:;" class="add-worker text-white "
                                              data-title="{{ __('page.add_worker') }}">{{ __('page.add_worker') }}</a>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-9">
            <div class="card">
                <div class="card-body">
                    <h4 class="mt-0 header-title">{{__('page.contract_analytics_date')}}</h4>
                    <div class="row">
                        <div class="col-lg-12">
                            <div id="morris-line-example" class="morris-chart" style="height: 300px"></div>
                        </div>
                        {{--                        <div class="col-lg-4">--}}
                        {{--                            <div>--}}
                        {{--                                <h5 class="font-14 mb-5">Yearly Sales Report</h5>--}}

                        {{--                                <div>--}}
                        {{--                                    <h5 class="mb-3">2018 : $19523</h5>--}}
                        {{--                                    <p class="text-muted mb-4">At vero eos et accusamus et iusto odio dignissimos--}}
                        {{--                                        ducimus atque</p>--}}
                        {{--                                    <a href="#" class="btn btn-primary btn-sm">Read more <i--}}
                        {{--                                                class="mdi mdi-chevron-right"></i></a>--}}
                        {{--                                </div>--}}
                        {{--                            </div>--}}
                        {{--                        </div>--}}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3">
            <div class="card">
                <div class="card-body">
                    <h4 class="mt-0 header-title">{{__('page.contract_analytics')}}</h4>
                    <div id="morris-donut-example" class="morris-chart" style="height: 300px"></div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade bs-example-modal-lg erp-modal" tabindex="-1" role="dialog"
         aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="myLargeModalLabel"></h5>
                    <button type="button" data-id="" class="close modal-close">
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
                    <div class="result">
                    </div>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <div class="modal fade bs-example-modal-lg employment-contract-modal" tabindex="-1" role="dialog"
         aria-labelledby="myLargeModalLabel" aria-hidden="true">
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
{{--{{ __('page.dashboard') }}--}}
@section('js')
    <script type="text/javascript">
        $(document).ready(function () {
            var baseUrl = $("#baseUrl").data('url');
            var token = $("#token").attr('content');
            //customer code

            $( document ).on( 'click',".add-worker",function( event ) {
                var title = $(this).data('title');
                $('.modal-title').text(title);
                $(".modal-spinner").show();
                $('.result').html("");
                $(".erp-modal").modal({
                    backdrop: 'static',
                    keyboard: true,
                    show: true
                });
                $(".modal-close").attr("data-id", "add_worker");
                $.ajax({
                    url: baseUrl+"/worker/create",
                    type:'GET',
                    success: function(data) {
                        $(".modal-spinner").hide();
                        $('.result').html(data.view);
                    },
                    error: function (error){
                        console.log(error);
                    }

                });
            });

            $( document ).on( "submit","#add_worker",function( event ) {
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

                if( errors == 0 ) {
                    btnObj.attr("disabled",true);
                    btnObj.find("i").addClass('fa-spinner fa-spin');
                    $.ajax({
                        url: baseUrl+"/worker",
                        type:'POST',
                        dataType: "JSON",
                        data: new FormData(this),
                        processData: false,
                        contentType: false,
                        success: function(data) {
                            if($.isEmptyObject(data.error)){
                                var oTable = $('#datatable').dataTable();
                                oTable.fnDraw(false);
                                formObj[0].reset();
                                $(".erp-modal").modal('hide');
                                printSuccessMsg(data.success);
                                add_number('add_number_worker');
                            } else {
                                printErrorMsg(data.error);
                            }
                            btnObj.attr("disabled",false);
                            btnObj.find("i").removeClass('fa-spinner fa-spin');
                        }
                    });
                }
            });
            function add_number(id){
                var number = document.getElementById(id).innerText;
                document.getElementById(id).innerText = parseInt(number)+1;
            }
            $(document).on('click', ".add-customer", function (event) {
                var title = $(this).data('title');
                $('.modal-title').text(title);
                $(".modal-spinner").show();
                $('.result').html("");
                $(".erp-modal").modal({
                    backdrop: 'static',
                    keyboard: true,
                    show: true
                });
                $(".modal-close").attr("data-id", "add_customer");
                $.ajax({
                    url: baseUrl + "/office-work/customer/create",
                    type: 'GET',
                    success: function (data) {
                        $(".modal-spinner").hide();
                        $('.result').html(data.view);
                    }
                });
            });

            $(document).on("submit", "#add_customer", function (event) {
                event.preventDefault();
                $(".print-error-msg").css('display', 'none');
                $(".print-success-msg").css('display', 'none');
                //define variation
                var errors = 0;
                //get fome object
                var formObj = $(this);
                //get button object
                var btnObj = formObj.find('button[type="submit"]');
                var formdata = formObj.serialize();
                errors = costomerValidation(formObj, errors);

                if (errors == 0) {
                    btnObj.attr("disabled", true);
                    btnObj.find("i").addClass('fa-spinner fa-spin');
                    $.ajax({
                        url: baseUrl + "/office-work/customer",
                        type: 'POST',
                        data: formdata,
                        success: function (data) {
                            if ($.isEmptyObject(data.error)) {
                                var oTable = $('#datatable').dataTable();
                                oTable.fnDraw(false);
                                formObj[0].reset();
                                $(".erp-modal").modal('hide');
                                setTimeout(function () {
                                    window.location = baseUrl + '/office-work/customer'
                                }, 3000);
                                printSuccessMsg(data.success);
                            } else {
                                printErrorMsg(data.error);
                            }
                            btnObj.attr("disabled", false);
                            btnObj.find("i").removeClass('fa-spinner fa-spin');
                        }
                    });
                }
            });

            $(document).on("click", ".customer-contract", function (event) {
                var title = $(this).data('title');
                $('.modal-title').text(title);
                $(".modal-spinner").show();
                $('.employment-contract-result').html("");
                //$(".erp-modal").modal({
//     backdrop: 'static',
//     keyboard: true,
//     show: true
// });
                $(".employment-contract-modal").modal({
                    backdrop: 'static',
                    keyboard: true,
                    show: true
                });
                $.ajax({
                    url: baseUrl + "/dashboard/get-customer-contracts",
                    type: 'GET',
                    success: function (data) {
                        $(".modal-spinner").hide();
                        $('.employment-contract-result').html(data.view);
                    }
                });
            });

            $(document).on("change", "#nationality_id", function (event) {
                var id = $(this).val();
                $('.status').html();
                if (id) {
                    $.ajax({
                        url: baseUrl + "/office-work/get-contract-status/" + id,
                        type: 'GET',
                        success: function (data) {
                            $(".modal-spinner").hide();
                            $('.status').html(data.view);
                        }
                    });
                }
            });

            $(document).on("click", ".contract-close", function (event) {
                var recordMsgarray = jQuery.parseJSON($(".contract-close-record-msg").text());
                swal(
                    {
                        title: recordMsgarray.title,
                        text: recordMsgarray.text,
                        type: 'info',
                        showCancelButton: true,
                        confirmButtonText: recordMsgarray.confirm_btn_text,
                        cancelButtonText: recordMsgarray.cancel_btn_text,
                        confirmButtonClass: 'btn btn-success',
                        cancelButtonClass: 'btn btn-danger m-l-10',
                        reverseButtons: true
                    }).then((result) => {
                    if (result.value) {
                        $("#employment_contract").submit();
                        event.preventDefault();
                    } else if (result.dismiss === 'cancel') {
                        $(".employment-contract-modal").modal('hide');
                    }
                })
            });

            $(document).on("submit", "#employment_contract", function (event) {
                event.preventDefault();
                $(".print-error-msg").css('display', 'none');
                $(".print-success-msg").css('display', 'none');
                //define variation
                var errors = 0;
                //get fome object
                var formObj = $(this);
                //get button object
                var btnObj = formObj.find('button[type="submit"]');
                var formdata = formObj.serialize();
                errors = costomerContractValidation(formObj, errors);
                var id = formObj.find('select[name="customer_id"]').val();
                if (errors == 0) {
                    btnObj.attr("disabled", true);
                    btnObj.find("i").addClass('fa-spinner fa-spin');
                    $.ajax({
                        url: baseUrl + "/office-work/employment-contract/" + id,
                        type: 'POST',
                        data: formdata,
                        success: function (data) {
                            if ($.isEmptyObject(data.error)) {
                                $(".employment-contract-modal").modal('hide');
                                setTimeout(function () {
                                    window.location = baseUrl + '/office-work/contract-list'
                                }, 3000);
                                printSuccessMsg(data.success);
                            } else {
                                printErrorMsg(data.error);
                            }
                            btnObj.attr("disabled", false);
                            btnObj.find("i").removeClass('fa-spinner fa-spin');

                        }
                    });
                }
            });

            //CV code
            $(document).on('click', ".add-cv", function (event) {
                var title = $(this).data('title');
                $('.modal-title').text(title);
                $(".modal-spinner").show();
                $('.result').html("");
                $(".erp-modal").modal({
                    backdrop: 'static',
                    keyboard: true,
                    show: true
                });
                $(".modal-close").attr("data-id", "add_cv");
                $.ajax({
                    url: baseUrl + "/office-work/cv/create",
                    type: 'GET',
                    success: function (data) {
                        $(".modal-spinner").hide();
                        $('.result').html(data.view);
                    }
                });
            });

            $(document).on("submit", "#add_cv", function (event) {
                event.preventDefault();
                $(".print-error-msg").css('display', 'none');
                $(".print-success-msg").css('display', 'none');
                //define variation
                var errors = 0;
                //get fome object
                var formObj = $(this);
                //get button object
                var btnObj = formObj.find('button[type="submit"]');
                var formdata = formObj.serialize();
                errors = cvValidation(formObj, errors);

                if (errors == 0) {
                    btnObj.attr("disabled", true);
                    btnObj.find("i").addClass('fa-spinner fa-spin');
                    $.ajax({
                        url: baseUrl + "/office-work/cv",
                        type: 'POST',
                        data: formdata,
                        success: function (data) {
                            if ($.isEmptyObject(data.error)) {
                                var oTable = $('#datatable').dataTable();
                                oTable.fnDraw(false);
                                formObj[0].reset();
                                $(".erp-modal").modal('hide');
                                setTimeout(function () {
                                    window.location = baseUrl + '/office-work/cv'
                                }, 3000);
                                printSuccessMsg(data.success);
                            } else {
                                printErrorMsg(data.error);
                            }
                            btnObj.attr("disabled", false);
                            btnObj.find("i").removeClass('fa-spinner fa-spin');
                        }
                    });
                }
            });

            $(document).on("click", ".modal-close", function (event) {
                var recordMsgarray = jQuery.parseJSON($(".contract-close-record-msg").text());
                var id = $(this).data('id');

                swal(
                    {
                        title: 'هل تريد الالغاء؟',
                        type: 'info',
                        showCancelButton: true,
                        confirmButtonText: recordMsgarray.confirm_btn_text,
                        cancelButtonText: recordMsgarray.cancel_btn_text,
                        confirmButtonClass: 'btn btn-success',
                        cancelButtonClass: 'btn btn-danger m-l-10',
                        reverseButtons: true
                    }).then((result) => {
                    if (result.value) {
                        $("#"+id).submit();
                        event.preventDefault();
                    } else if (result.dismiss === 'cancel') {
                        $(".erp-modal").modal('hide');
                        $(".employment-contract-modal").modal('hide');
                    }
                })
            });

        });

        function costomerValidation(formObj, errors, edit = '') {
            //remove error class
            formObj.find('input').removeClass('parsley-error');
            formObj.find('span').removeClass('parsley-error');

            //find flields
            var nameObj = formObj.find('input[name="name"]');
            var name = nameObj.val();

            var idNumberObj = formObj.find('input[name="id_number"]');
            var idNumber = idNumberObj.val();

            var nationalityObj = formObj.find('input[name="nationality_id"]');
            var nationality = nationalityObj.val();

            var mobileNumberObj = formObj.find('input[name="mobile_number"]');
            var mobileNumber = mobileNumberObj.val();

            var titleObj = formObj.find('input[name="title"]');
            var title = titleObj.val();

            var dateOfBirthObj = formObj.find('input[name="date_of_birth"]');
            var dateOfBirth = dateOfBirthObj.val();

            var statusObj = formObj.find('select[name="status"]');
            var status = statusObj.val();

            //check value
            if (name == "") {
                errors = 1;
                nameObj.addClass('parsley-error');
            }
            if (idNumber == "") {
                errors = 1;
                idNumberObj.addClass('parsley-error');
            }
            if (nationality == "") {
                errors = 1;
                nationalityObj.addClass('parsley-error');
            }
            if (mobileNumber == "") {
                errors = 1;
                mobileNumberObj.addClass('parsley-error');
            }
            if (title == "") {
                errors = 1;
                titleObj.addClass('parsley-error');
            }
            if (dateOfBirth == "") {
                errors = 1;
                dateOfBirthObj.addClass('parsley-error');
                dateOfBirthObj.closest('div').find('span').addClass('parsley-error');
            }
            /*if( status =="" ) {
                errors = 1;
                statusObj.addClass('parsley-error');
            }*/
            return errors;
        }

        function costomerContractValidation(formObj, errors, edit = '') {
            //remove error class
            formObj.find('input').removeClass('parsley-error');
            formObj.find('span').removeClass('parsley-error');

            //find flields
            var customerIdObj = formObj.find('select[name="customer_id"]');
            var customerId = customerIdObj.val();

            var contractNumberObj = formObj.find('input[name="employment_Contract[contract_number]"]');
            var contractNumber = contractNumberObj.val();

            var contractValueObj = formObj.find('input[name="employment_Contract[contract_value]"]');
            var contractValue = contractValueObj.val();

            var visaNumberObj = formObj.find('input[name="employment_Contract[visa_number]"]');
            var visaNumber = visaNumberObj.val();

            var nationalityIdObj = formObj.find('select[name="employment_Contract[nationality_id]"]');
            var nationalityId = nationalityIdObj.val();

            var monthlySalaryObj = formObj.find('input[name="eemployment_Contract[monthly_salary]"]');
            var monthlySalary = monthlySalaryObj.val();

            //check value
            if (monthlySalary == "") {
                errors = 1;
                monthlySalaryObj.addClass('parsley-error');
                monthlySalaryObj.focus();
            }
            if (nationalityId == "") {
                errors = 1;
                nationalityIdObj.addClass('parsley-error');
                nationalityIdObj.focus();
            }
            if (visaNumber == "") {
                errors = 1;
                visaNumberObj.addClass('parsley-error');
                visaNumberObj.focus();
            }
            if (contractValue == "") {
                errors = 1;
                contractValueObj.addClass('parsley-error');
                contractValueObj.focus();
            }
            if (contractNumber == "") {
                errors = 1;
                contractNumberObj.addClass('parsley-error');
                contractNumberObj.focus();
            }
            if (customerId == "") {
                errors = 1;
                customerIdObj.addClass('parsley-error');
                customerIdObj.focus();
            }
            return errors;
        }

        function cvValidation(formObj, errors, edit = '') {
            //remove error class
            formObj.find('input').removeClass('parsley-error');
            formObj.find('span').removeClass('parsley-error');

            //find flields
            var nameObj = formObj.find('input[name="name"]');
            var name = nameObj.val();

            var occupationObj = formObj.find('select[name="profession_id"]');
            var occupation = occupationObj.val();

            var nationalityObj = formObj.find('select[name="nationality_id"]');
            var nationality = nationalityObj.val();

            var religionObj = formObj.find('select[name="religion_id"]');
            var religion = religionObj.val();

            var ageObj = formObj.find('input[name="age"]');
            var age = ageObj.val();

            var previousExperienceObj = formObj.find('select[name="previous_experience"]');
            var previousExperience = previousExperienceObj.val();

            var officeObj = formObj.find('select[name="office_id"]');
            var office = officeObj.val();

            var passportNumberObj = formObj.find('input[name="passport_number"]');
            var passportNumber = passportNumberObj.val();

            var reservationObj = formObj.find('select[name="reservation"]');
            var reservation = reservationObj.val();

            var statusObj = formObj.find('select[name="status"]');
            var status = statusObj.val();

            //check value
            if (name == "") {
                errors = 1;
                nameObj.addClass('parsley-error');
            }
            if (occupation == "") {
                errors = 1;
                occupationObj.addClass('parsley-error');
            }
            if (nationality == "") {
                errors = 1;
                nationalityObj.addClass('parsley-error');
            }
            if (religion == "") {
                errors = 1;
                religionObj.addClass('parsley-error');
            }
            if (age == "") {
                errors = 1;
                ageObj.addClass('parsley-error');
            }
            if (previousExperience == "") {
                errors = 1;
                previousExperienceObj.addClass('parsley-error');
            }
            if (office == "") {
                errors = 1;
                officeObj.addClass('parsley-error');
            }
            if (passportNumber == "") {
                errors = 1;
                passportNumberObj.addClass('parsley-error');
            }
            if (reservation == "") {
                errors = 1;
                reservationObj.addClass('parsley-error');
            }
            if (status == "") {
                errors = 1;
                statusObj.addClass('parsley-error');
            }
            return errors;
        }

    </script>

    <!-- dashboard js -->
    {{--    <script src="{{ asset('pages/dashboard.int.js') }}"></script>--}}

    <script>

        var prof = "{{__('page.TOTAL_PROFIT')}}";

        /*
         Template Name: Zinzer - Responsive Bootstrap 4 Admin Dashboard
         Author: Themesdesign
         Website: www.themesdesign.in
         File: Dashboard js
         */

        !function ($) {
            "use strict";

            var Dashboard = function () {
            };

            //creates line chart
            Dashboard.prototype.createLineChart = function (element, data, xkey, ykeys, labels, lineColors) {
                Morris.Line({
                    element: element,
                    data: data,
                    xkey: xkey,
                    ykeys: ykeys,
                    labels: labels,
                    hideHover: 'auto',
                    gridLineColor: '#eef0f2',
                    resize: true, //defaulted to true
                    lineColors: lineColors
                });
            },

                //creates Donut chart
                Dashboard.prototype.createDonutChart = function (element, data, colors) {
                    Morris.Donut({
                        element: element,
                        data: data,
                        resize: true,
                        colors: colors
                    });
                },


                Dashboard.prototype.init = function () {
                    var totalContractsGrouped = <?php echo json_encode($totalContractsGrouped)?>;

                    console.log(totalContractsGrouped);
                    var $data = [];

                    Object.keys(totalContractsGrouped).forEach(function (key) {
                        $data.push({y: key, a: totalContractsGrouped[key].length},);
                    })

                    this.createLineChart('morris-line-example', $data, 'y', ['a'], [prof], ['#5985ee']);

                    //creating donut chart
                    var $donutData = [
                        {label: "{{__('page.contracts')}}", value: <?php echo $TotalContracts;?>},
                        {label: "{{__('page.overdue_contracts')}}", value: <?php echo $TotalOverdueContracts;?>},
                        {label: "{{__('page.under_warranty')}}", value: <?php echo $UnderWarranty;?>},
                        {label: "{{__('page.arrivals')}}", value: <?php echo $TotalArrivals;?>},
                    ];
                    this.createDonutChart('morris-donut-example', $donutData, ['#4bbbce', '#5985ee', '#46cd93', '#f24734']);

                },

                //init
                $.Dashboard = new Dashboard, $.Dashboard.Constructor = Dashboard
        }(window.jQuery),

//initializing
            function ($) {
                "use strict";
                $.Dashboard.init();
            }(window.jQuery);


    </script>

@endsection

