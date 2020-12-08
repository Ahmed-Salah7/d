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
                        <a href="{{ url('/worker') }}"><h6
                                    class="text-uppercase mt-0 float-left text-white-50">{{  __('page.workers') }}</h6>
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


        <div class="col-xl-3 col-md-6">
            <div class="card bg-info mini-stat text-white">
                <div class="p-3 mini-stat-desc">
                    <div class="clearfix">
                        <a href="{{ url('/rental-request') }}"><h6
                                    class="text-uppercase mt-0 float-left text-white-50">{{  __('page.rental_request') }}</h6>
                        </a>
                        <h4 id="add_number_rental" class="mb-3 mt-0 float-right">{{ $RentalRequestsCount }}</h4>
                    </div>
                </div>
                <div class="p-3">
                    <div class="float-right">
                        <a href="#" class="text-white-50"><i class="mdi mdi-account-plus h5"></i></a>
                    </div>
                    <p class="font-14 m-0"><a href="javascript:;" class="add-rental_request text-white "
                          data-title="{{ __('page.add_rental_request') }}">{{ __('page.add_rental_request') }}</a>
                    </p>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card bg-info mini-stat text-white">
                <div class="p-3 mini-stat-desc">
                    <div class="clearfix">
                        <a href="{{ url('/rental-request') }}?expired=1"><h6
                                    class="text-uppercase mt-0 float-left text-white-50">{{  __('page.rental_request_expired') }}</h6>
                        </a>
                        <h4 class="mb-3 mt-0 float-right">{{ $RentalRequestsExpiredCount }}</h4>
                    </div>
                </div>
                <div class="p-3">
                    <div class="float-right">
                        <a href="#" class="text-white-50"><i class="mdi mdi-alarm-multiple h5"></i></a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card bg-pink mini-stat text-white">
                <div class="p-3 mini-stat-desc">
                    <div class="clearfix">
                        <a href="{{ url('/transfer-sponsership-request') }}"><h6
                                    class="text-uppercase mt-0 float-left text-white-50">{{  __('page.transfer_sponsorship_request') }}</h6>
                        </a>
                        <h4 id="add_number_transfer_sponsorship" class="mb-3 mt-0 float-right">{{ $TransferOfSponsorshipRequestCount }}</h4>
                    </div>
                </div>
                <div class="p-3">
                    <div class="float-right">
                        <a href="#" class="text-white-50"><i class="mdi mdi-account-switch h5"></i></a>
                    </div>
                    <p class="font-14 m-0"><a href="javascript:;" class="add-transfer_sponsorship_request text-white "
                                              data-title="{{ __('page.add_transfer_sponsorship_request') }}">{{ __('page.add_transfer_sponsorship_request') }}</a>
                    </p>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card bg-pink mini-stat text-white">
                <div class="p-3 mini-stat-desc">
                    <div class="clearfix">
                        <a href="{{ url('/transfer-sponsership-request') }}?under_experiment=1"><h6
                                    class="text-uppercase mt-0 float-left text-white-50">{{  __('page.transfer_sponsorship_request_under_experiment') }}</h6>
                        </a>
                        <h4 class="mb-3 mt-0 float-right">{{ $TransferOfSponsorship_UnderExperimentRequestCount }}</h4>
                    </div>
                </div>
                <div class="p-3">
                    <div class="float-right">
                        <a href="#" class="text-white-50"><i class="mdi mdi-account-multiple-outline h5"></i></a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card bg-success mini-stat text-white">
                <div class="p-3 mini-stat-desc">
                    <div class="clearfix">
                        <a href="{{ url('/relay') }}"><h6
                                    class="text-uppercase mt-0 float-left text-white-50">{{  __('page.relay') }}</h6>
                        </a>
                        <h4  id="add_relay_num" class="mb-3 mt-0 float-right">{{ $RelayCount }}</h4>
                    </div>
                </div>
                <div class="p-3">
                    <div class="float-right">
                        <a href="#" class="text-white-50"><i class="mdi mdi-account-off h5"></i></a>
                    </div>
                    <p class="font-14 m-0"><a href="javascript:;" class="add-relay text-white "
                          data-title="{{ __('page.add_relay') }}">{{ __('page.add_relay') }}</a>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade bs-example-modal-lg general-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
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
{{--{{ __('page.dashboard') }}--}}
@section('js')
<script>
    $(document).ready(function () {
        var baseUrl = $("#baseUrl").data('url');
        var token = $("#token").attr('content');
        //worker code
        $( document ).on( 'click',".add-worker",function( event ) {
            var title = $(this).data('title');
            $('.modal-title').text(title);
            $(".modal-spinner").show();
            $('.result').html("");
            $(".general-modal").modal({
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
                        $(".general-modal").modal('hide');
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

        $( document ).on( 'click',".add-rental_request",function( event ) {
            var title = $(this).data('title');
            $('.modal-title').text(title);
            $(".modal-spinner").show();
            $('.result').html("");
            $(".general-modal").modal({
                backdrop: 'static',
                keyboard: true,
                show: true
            });
            $(".modal-close").attr("data-id", "add_rental_request");
            $.ajax({
                url: baseUrl+"/rental-request/create",
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

        $( document ).on( "submit","#add_rental_request",function( event ) {
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
                    url: baseUrl+"/rental-request",
                    type:'POST',
                    data: new FormData(this),
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        if($.isEmptyObject(data.error)){
                            var oTable = $('#datatable').dataTable();
                            oTable.fnDraw(false);
                            formObj[0].reset();
                            $(".general-modal").modal('hide');
                            printSuccessMsg(data.success);
                            add_number('add_number_rental');
                        } else {
                            printErrorMsg(data.error);
                        }
                        btnObj.attr("disabled",false);
                        btnObj.find("i").removeClass('fa-spinner fa-spin');
                    }
                });
            }
        });

        $( document ).on( 'click',".add-transfer_sponsorship_request",function( event ) {
            var title = $(this).data('title');
            $('.modal-title').text(title);
            $(".modal-spinner").show();
            $('.result').html("");
            $(".general-modal").modal({
                backdrop: 'static',
                keyboard: true,
                show: true
            });
            $(".modal-close").attr("data-id", "add_transfer_sponsorship_request");
            $.ajax({
                url: baseUrl+"/transfer-sponsership-request/create",
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

        $( document ).on( "submit","#add_transfer_sponsorship_request",function( event ) {
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
                    url: baseUrl+"/transfer-sponsership-request",
                    type:'POST',
                    data: new FormData(this),
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        if($.isEmptyObject(data.error)){
                            var oTable = $('#datatable').dataTable();
                            oTable.fnDraw(false);
                            formObj[0].reset();
                            $(".general-modal").modal('hide');
                            printSuccessMsg(data.success);
                            add_number('add_number_transfer_sponsorship');
                        } else {
                            printErrorMsg(data.error);
                        }
                        btnObj.attr("disabled",false);
                        btnObj.find("i").removeClass('fa-spinner fa-spin');
                    }
                });
            }
        });

        //relay code
        $( document ).on( 'click',".add-relay",function( event ) {
            var title = $(this).data('title');
            $('.modal-title').text(title);
            $(".modal-spinner").show();
            $('.result').html("");
            $(".general-modal").modal({
                backdrop: 'static',
                keyboard: true,
                show: true
            });
            $(".modal-close").attr("data-id", "add_relay");
            $.ajax({
                url: baseUrl+"/relay/create",
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

        $( document ).on( "submit","#add_relay",function( event ) {
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
                    url: baseUrl+"/relay",
                    type:'POST',
                    data: new FormData(this),
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        if($.isEmptyObject(data.error)){
                            var oTable = $('#datatable').dataTable();
                            oTable.fnDraw(false);
                            formObj[0].reset();
                            $(".general-modal").modal('hide');
                            add_number('add_relay_num');
                            printSuccessMsg(data.success);
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

        $(document).on("click", ".modal-close", function (event) {
            var recordMsgarray = jQuery.parseJSON($(".contract-close-record-msg").text());
            var id = $(this).data('id');
            swal(
                {
                    title: 'هل تريد الالغاء؟',
                    // text: recordMsgarray.text,
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
                    $(".general-modal").modal('hide');
                }
            })
        });

    });
</script>

@endsection

