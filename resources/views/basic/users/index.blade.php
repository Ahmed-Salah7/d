@extends('layouts.app')
@section('title') Users list @endsection
@section('content')
<!-- Page-Title -->
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h4 class="page-title m-0">{{ __('page.users_list') }}</h4>
                </div>
                <div class="col-md-4">
                    <div class="float-right">
                        <div class="dropdown">
                          <!--   <a href="{{ url('offices/create') }}"> -->
                                <button class="btn btn-primary add-user" type="button" data-title="{{ __('page.add_users') }}">
                                    <i class="ti-plus mr-1"></i> {{ __('page.add_users') }}
                                </button>
                           <!--  </a> -->
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
            <div class="card-body">
                <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                    <tr>
                        <th width="15%"> {{ __('page.name') }}</th>
                        <th width="15%"> {{ __('page.gender') }}</th>
                        <th width="20%"> {{ __('page.nationality') }}</th>
                        <th width="20%"> {{ __('page.qualification') }}</th>
                        <th width="20%"> {{ __('page.position') }}</th>
                        <th width="10%"> {{ __('page.status') }}</th>
                        <th width="10%"> {{ __('page.action') }}</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->

<div class="modal fade bs-example-modal-lg user-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
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
             url: baseUrl+"/users" ,
              type: 'GET',
             },
             columns: [
                      { data: 'name', name: 'name' },
                      { data: 'gender', name: 'gender' },
                      { data: 'nationality', name: 'nationality' },
                      { data: 'qualification', name: 'qualification' },
                      { data: 'position', name: 'position' },
                      { data: 'status', name: 'status' },
                      {data: 'action', name: 'action', orderable: false},
                   ],
            order: [[0, 'desc']]
        });
         //user code
        $( document ).on( 'click',".add-user",function( event ) {
            var title = $(this).data('title');
            $('.modal-title').text(title);
            $(".modal-spinner").show();
            $('.result').html("");
            $(".user-modal").modal({
    backdrop: 'static',
    keyboard: true,
    show: true
});
            $.ajax({
                url: baseUrl+"/users/create",
                type:'GET',
                success: function(data) {
                    $(".modal-spinner").hide();
                    $('.result').html(data.view);
                }
            });
        });

        $( document ).on( "submit","#add_user",function( event ) {

            event.preventDefault();
            $(".print-error-msg").css('display','none');
            $(".print-success-msg").css('display','none');
            //define variation
            var errors = 0;
            //get fome object
            var formObj = $(this);
            //get button object
            var btnObj   = formObj.find('button[type="submit"]');
            var formdata = new FormData(this);
            errors = userValidation(formObj,errors);

            if( errors == 0 ) {
                btnObj.attr("disabled",true);
                btnObj.find("i").addClass('fa-spinner fa-spin');
                $.ajax({
                    url: baseUrl+"/users",
                    type:'POST',
                    data:formdata,
                    dataType:'JSON',
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(data) {
                        if($.isEmptyObject(data.error)){
                            var oTable = $('#datatable').dataTable();
                            oTable.fnDraw(false);
                            formObj[0].reset();
                            $(".user-modal").modal('hide');
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

        $( document ).on( 'click',".edit-user",function( event ) {
            var title = $(this).data('title');
            $('.modal-title').text(title);
            $(".modal-spinner").show();
            $('.result').html("");
            $(".user-modal").modal({
    backdrop: 'static',
    keyboard: true,
    show: true
});
            var id = $(this).data('id');
            $.ajax({
                url: baseUrl+"/users/"+id+"/edit",
                type:'GET',
                success: function(data) {
                    $(".modal-spinner").hide();
                    $('.result').html(data.view);
                }
            });
        });

        $( document ).on( "submit","#update_user",function( event ) {
            event.preventDefault();
            $(".print-error-msg").css('display','none');
            $(".print-success-msg").css('display','none');
            //define variation
            var errors = 0;
            //get fome object
            var formObj = $(this);
            //get button object
            var btnObj   = formObj.find('button[type="submit"]');
            var formdata = new FormData(this);
            var id = btnObj.data('id');
            errors = userValidation(formObj,errors,'edit');

            if( errors == 0 ) {
                btnObj.attr("disabled",true);
                btnObj.find("i").addClass('fa-spinner fa-spin');
                $.ajax({
                    url: baseUrl+"/users/"+id,
                    type:'POST',
                    data:formdata,
                    dataType:'JSON',
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(data) {
                        if($.isEmptyObject(data.error)){
                            var oTable = $('#datatable').dataTable();
                            oTable.fnDraw(false);
                            $(".user-modal").modal('hide');
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

        $( document ).on( "change",".user_status",function( event ) {
            if ($(this).prop('checked')==true){
                var status = 1;
            } else {
                var status = 2;
            }
            var id  = $(this).data('id');
            var formdata = {'id':id,'status':status};
            if( status ){
                $.ajax({
                    url: baseUrl+"/user-status-update",
                    type:'GET',
                    data:formdata,
                    success: function(data) {
                        if($.isEmptyObject(data.error)){
                           printSuccessMsg(data.success);
                        } else {
                           singleErrorMsg(data.error);
                        }
                    }
                });
            }
        });

        $( document ).on( "click",".delete-user",function( event ) {
            var recordMsgarray = jQuery.parseJSON($(".delete-record-msg").text());
            var id = $(this).data('id');
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
                        url: baseUrl+"/delete-user",
                        type: "POST",
                        data: {_token: token,id:id },
                        success: function (data) {
                            if($.isEmptyObject(data.error)){
                                var oTable = $('#datatable').dataTable();
                                oTable.fnDraw(false);
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

    function userValidation(formObj,errors,edit=''){
        //remove error class
        formObj.find('input').removeClass('parsley-error');
        formObj.find('span').removeClass('parsley-error');

        //find flields
        var nameObj = formObj.find('input[name="name"]');
        var name    = nameObj.val();

        var userNameObj = formObj.find('input[name="username"]');
        var userName    = userNameObj.val();

        var passwordObj = formObj.find('input[name="password"]');
        var password    = passwordObj.val();

        var emailObj = formObj.find('input[name="email"]');
        var email    = emailObj.val();

        var roleObj = formObj.find('select[name="role"]');
        var role    = roleObj.val();

        var statusObj = formObj.find('select[name="status"]');
        var status    = statusObj.val();

        //check value
        if( name =="" ) {
            errors = 1;
            nameObj.addClass('parsley-error');
        }
        if( userName =="" ) {
            errors = 1;
            userNameObj.addClass('parsley-error');
        }
        if( edit ==""  && password =="" ) {
            errors = 1;
            passwordObj.addClass('parsley-error');
        }
        if( email =="" ) {
            errors = 1;
            emailObj.addClass('parsley-error');
        }
        if( role =="" ) {
            errors = 1;
            roleObj.addClass('parsley-error');
        }
        if( status =="" ) {
            errors = 1;
            statusObj.addClass('parsley-error');
        }
        return errors;
    }

</script>
@endsection