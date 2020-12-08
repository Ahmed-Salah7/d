@extends('layouts.app')
@section('title') accommodation types list @endsection
@section('content')
    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h4 class="page-title m-0">{{ __('page.rental_requests_list') }}</h4>
                    </div>
                    <div class="col-md-4">
                        <div class="float-right">
                            <div class="dropdown">
                                <button class="btn btn-primary add-rental_request" type="button" data-title="{{ __('page.add_rental_request') }}">
                                    <i class="ti-plus mr-1"></i> {{ __('page.add_rental_request') }}
                                </button>
                            </div>
                        </div>
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
                                <label>{{ __('page.from_date') }}</label>
                                <div class="input-group">
                                    <input type="date" class="form-control" placeholder="yyyy/mm/dd" id="startdate" name="startdate" value="" >
{{--                                    <div class="input-group-append bg-custom b-0"><span class="input-group-text"><i class="mdi mdi-calendar"></i></span></div>--}}
                                </div><!-- input-group -->
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>{{ __('page.to_date') }}</label>
                                <div class="input-group">
                                    <input type="date" class="form-control" placeholder="yyyy/mm/dd" id="enddate" name="enddate" value="" >
{{--                                    <div class="input-group-append bg-custom b-0"><span class="input-group-text"><i class="mdi mdi-calendar"></i></span></div>--}}
                                </div><!-- input-group -->
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
                            <th> {{ __('page.id_automatic') }}</th>
                            <th> {{ __('page.worker') }}</th>
                            <th> {{ __('page.customer') }}</th>
                            <th> {{ __('page.duration_in_month') }}</th>
                            <th> {{ __('page.start_rental') }}</th>
                            <th> {{ __('page.total_cost') }}</th>
                            <th> {{ __('page.action') }}</th>
                        </tr>
                        </thead>

                    </table>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
    <div class="modal fade bs-example-modal-lg rental_request-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="myLargeModalLabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
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
@section('js')
    <script type="text/javascript">
        $( document ).ready( function(){

            var baseUrl = $("#baseUrl").data('url');
            var token = $("#token").attr('content');
            let searchParams = new URLSearchParams(window.location.search)
            var expired = searchParams.get('expired');


            $('#datatable').DataTable({
                "language": {
                    "url": lang
                },
                processing: true,
                serverSide: true,
                ordering: false,
                ajax: {
                    url: baseUrl+"/rental-request?expired="+expired ,
                    type: 'GET',
                    data: function (d) {
                        d.startdate = $('#startdate').val();
                        d.enddate = $('#enddate').val();
                    },
                },
                columns: [
                    { data: 'id', name: 'id_automatic' },
                    { data: 'worker', name: 'worker' },
                    { data: 'customer', name: 'customer' },
                    { data: 'duration_in_month', name: 'duration_in_month' },
                    { data: 'start_rental', name: 'start_rental' },
                    { data: 'total_cost', name: 'total_cost' },
                    { data: 'action', name: 'action', orderable: false },
                ],
                order: [[0, 'desc']],
                dom: 'Bfrtip',
                buttons: [
                    'excel'
                ],
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
            //rental_request code
            $( document ).on( 'click',".add-rental_request",function( event ) {
                var title = $(this).data('title');
                $('.modal-title').text(title);
                $(".modal-spinner").show();
                $('.result').html("");
                $(".rental_request-modal").modal({
    backdrop: 'static',
    keyboard: true,
    show: true
});
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
                                $(".rental_request-modal").modal('hide');
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

            $( document ).on( 'click',".edit-rental_request",function( event ) {
                var title = $(this).data('title');
                $('.modal-title').text(title);
                $(".modal-spinner").show();
                $('.result').html("");
                $(".rental_request-modal").modal({
    backdrop: 'static',
    keyboard: true,
    show: true
});
                var id = $(this).data('id');
                $.ajax({
                    url: baseUrl+"/rental-request/"+id+"/edit",
                    type:'GET',
                    success: function(data) {
                        $(".modal-spinner").hide();
                        $('.result').html(data.view);
                    }
                });
            });

            $( document ).on( "click",".delete-rental_request",function( event ) {
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
                            url: baseUrl+"/delete-rental-request",
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

            $( document ).on( "submit","#update_rental_request",function( event ) {
                event.preventDefault();
                $(".print-error-msg").css('display','none');
                $(".print-success-msg").css('display','none');
                //define variation
                var errors = 0;
                //get fome object
                //get fome object
                var formObj = $(this);
                //get button object
                var btnObj   = formObj.find('button[type="submit"]');
                var formdata = formObj.serialize();
                var id = btnObj.data('id');

                if( errors == 0 ) {
                    btnObj.attr("disabled",true);
                    btnObj.find("i").addClass('fa-spinner fa-spin');
                    $.ajax({
                        url: baseUrl+"/rental-request/"+id,
                        type:'POST',
                        data: new FormData(this),
                        processData: false,
                        contentType: false,
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},

                        success: function(data) {
                            if($.isEmptyObject(data.error)){
                                var oTable = $('#datatable').dataTable();
                                oTable.fnDraw(false);
                                $(".rental_request-modal").modal('hide');
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


        });

    </script>



@endsection