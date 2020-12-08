@extends('layouts.app')
@section('title') workers list @endsection
@section('content')
    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h4 class="page-title m-0">{{ __('page.workers_list') }}</h4>
                    </div>
                    <div class="col-md-4">
                        <div class="float-right">
                            <div class="dropdown">
                                <button class="btn btn-primary add-worker" type="button" data-title="{{ __('page.add_worker') }}">
                                    <i class="ti-plus mr-1"></i> {{ __('page.add_worker') }}
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
                                <label>{{ __('page.profession') }}</label>
                                <select class="form-control" name="profession_id" id="profession_id">
                                    <option value="">{{ __('page.profession') }}</option>
                                        @foreach( $Professions as $Profession )
                                            <option value="{{ $Profession->id }}">
                                                {{ (Session::get('locale') =='en') ? $Profession->job_english : $Profession->occupation  }}
                                            </option>
                                        @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>{{ __('page.accoumodation_type') }}</label>
                                <select class="form-control" name="accoumodation_type_id" id="accoumodation_type_id">
                                    <option value="">{{ __('page.accoumodation_type') }}</option>
                                        @foreach( $AccoumodationTypes as $AccoumodationType )
                                            <option value="{{ $AccoumodationType->id }}">
                                                {{ $AccoumodationType->name }}
                                            </option>
                                        @endforeach
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
                            <th> {{ __('page.name') }}</th>
                            <th> {{ __('page.sponser_name') }}</th>
                            <th> {{ __('page.profession') }}</th>
                            <th> {{ __('page.nationality') }}</th>
                            <th> {{ __('page.religion') }}</th>
                            <th> {{ __('page.accoumodation_type') }}</th>
                            <th> {{ __('page.age') }}</th>
                            <th> {{ __('page.enter_date') }}</th>
                            <th> {{ __('page.office') }}</th>
                            <th> {{ __('page.action') }}</th>
                        </tr>
                        </thead>

                    </table>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
    <div class="modal fade bs-example-modal-lg worker-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
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
            $('#datatable').DataTable({
                "language": {
                    "url": lang
                },
                processing: true,
                serverSide: true,
                ordering: false,
                ajax: {
                    url: baseUrl+"/worker" ,
                    type: 'GET',
                    data: function (d) {
                        d.nationality_id = $('#nationality_id').val();
                        d.office_id = $('#office_id').val();
                        d.profession_id = $('#profession_id').val();
                        d.accoumodation_type_id = $('#accoumodation_type_id').val();
                    },
                },
                columns: [
                    { data: 'name', name: 'name' },
                    { data: 'sponser_name', name: 'sponser_name' },
                    { data: 'profession', name: 'profession' },
                    { data: 'nationality', name: 'nationality' },
                    { data: 'religion', name: 'religion' },
                    { data: 'accoumodationType', name: 'accoumodationType' },
                    { data: 'age', name: 'age' },
                    { data: 'enter_date', name: 'enter_date' },
                    { data: 'office', name: 'office' },
                    { data: 'action', name: 'action', orderable: false },
                ],
                order: [[0, 'desc']],
                dom: 'Bfrtip',
                buttons: [
                     'excel'
                ],
            });
            //worker code
            $( document ).on( 'click',".add-worker",function( event ) {
                var title = $(this).data('title');
                $('.modal-title').text(title);
                $(".modal-spinner").show();
                $('.result').html("");
                $(".worker-modal").modal({
    backdrop: 'static',
    keyboard: true,
    show: true
});
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
                                $(".worker-modal").modal('hide');
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

            $( document ).on( 'click',".edit-worker",function( event ) {
                var title = $(this).data('title');
                $('.modal-title').text(title);
                $(".modal-spinner").show();
                $('.result').html("");
                $(".worker-modal").modal({
    backdrop: 'static',
    keyboard: true,
    show: true
});
                var id = $(this).data('id');
                $.ajax({
                    url: baseUrl+"/worker/"+id+"/edit",
                    type:'GET',
                    success: function(data) {
                        $(".modal-spinner").hide();
                        $('.result').html(data.view);
                    }
                });
            });

            $( document ).on( "click",".delete-worker",function( event ) {
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
                            url: baseUrl+"/delete-worker",
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

            $( document ).on( "submit","#update_worker",function( event ) {
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
                        url: baseUrl+"/worker/"+id,
                        type:'POST',
                        dataType: "JSON",
                        data: new FormData(this),
                        processData: false,
                        contentType: false,
                        // headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        // dataType:'JSON',
                        // contentType: false,
                        cache: false,
                        // processData: false,
                        success: function(data) {
                            if($.isEmptyObject(data.error)){
                                var oTable = $('#datatable').dataTable();
                                oTable.fnDraw(false);
                                $(".worker-modal").modal('hide');
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

        });

    </script>



@endsection