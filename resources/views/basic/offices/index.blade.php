@extends('layouts.app')
@section('title') Offices list @endsection
@section('content') 
<!-- Page-Title -->
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h4 class="page-title m-0">{{ __('page.offices_list') }}</h4>
                </div>
                <div class="col-md-4">
                    <div class="float-right">
                        <div class="dropdown">
                            <button class="btn btn-primary add-office" type="button" data-title="{{ __('page.add_office') }}">
                                <i class="ti-plus mr-1"></i> {{ __('page.add_office') }}
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
            <div class="card-body">

                <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                    <tr>
                        <th width="15%"> {{ __('page.name') }}</th>
                        <th width="15%"> {{ __('page.city') }}</th>
                        <th width="15%"> {{ __('page.phone_no') }}</th>
                        <th width="15%"> {{ __('page.email') }}</th>
                        <th width="10%"> {{ __('page.office_type') }}</th>
                        <th width="10%"> {{ __('page.status') }}</th>
                        <th width="10%"> {{ __('page.action') }}</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->
<div class="modal fade bs-example-modal-lg office-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
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
             url: baseUrl+"/offices" ,
              type: 'GET',
             },
             columns: [
                      { data: 'name', name: 'name' },
                      { data: 'city', name: 'city' },
                      { data: 'phone', name: 'phone' },
                      { data: 'email', name: 'email' },
                      { data: 'office_type', name: 'office_type' },
                      { data: 'status', name: 'status' },
                      {data: 'action', name: 'action', orderable: false},
                   ],
            order: [[0, 'desc']]
        });
        //office code
        $( document ).on( 'click',".add-office",function( event ) {
            var title = $(this).data('title'); 
            $('.modal-title').text(title);
            $(".modal-spinner").show();
            $('.result').html("");
            $(".office-modal").modal('show');
            $.ajax({
                url: baseUrl+"/offices/create",
                type:'GET',
                success: function(data) {
                    $(".modal-spinner").hide();
                    $('.result').html(data.view);
                }
            });
        });

        $( document ).on( "submit","#add_office",function( event ) {
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
            errors = officeValidation(formObj,errors);

            if( errors == 0 ) {
                btnObj.attr("disabled",true);
                btnObj.find("i").addClass('fa-spinner fa-spin');
                $.ajax({
                    url: baseUrl+"/offices",
                    type:'POST',
                    data:formdata,
                    success: function(data) {
                        if($.isEmptyObject(data.error)){
                            var oTable = $('#datatable').dataTable(); 
                            oTable.fnDraw(false);
                            formObj[0].reset();
                            $(".office-modal").modal('hide');
                            printSuccessMsg(data.success);
                            setTimeout(function(){ 
                             //window.location = baseUrl+'/offices'
                           }, 3000);
                        } else {
                            printErrorMsg(data.error);
                        }
                        btnObj.attr("disabled",false);
                        btnObj.find("i").removeClass('fa-spinner fa-spin');
                    }
                });
            }
        });

        $( document ).on( 'click',".edit-office",function( event ) {
            var title = $(this).data('title'); 
            $('.modal-title').text(title);
            $(".modal-spinner").show();
            $('.result').html("");
            $(".office-modal").modal('show');
            var id = $(this).data('id');
            $.ajax({
                url: baseUrl+"/offices/"+id+"/edit",
                type:'GET',
                success: function(data) {
                    $(".modal-spinner").hide();
                    $('.result').html(data.view);
                }
            });
        });
        
        $( document ).on( "submit","#updat_office",function( event ) {
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
            errors = officeValidation(formObj,errors);

            if( errors == 0 ) {
                btnObj.attr("disabled",true);
                btnObj.find("i").addClass('fa-spinner fa-spin');
                $.ajax({
                    url: baseUrl+"/offices/"+id,
                    type:'POST',
                    data:formdata,
                    success: function(data) {
                        if($.isEmptyObject(data.error)){
                            $(".office-modal").modal('hide');
                            var oTable = $('#datatable').dataTable(); 
                            oTable.fnDraw(false);
                        } else {
                            printErrorMsg(data.error);
                        }
                        btnObj.attr("disabled",false);
                        btnObj.find("i").removeClass('fa-spinner fa-spin');
                    }
                });
            }
        });
        
        $( document ).on( "change",".office_status",function( event ) {
            if ($(this).prop('checked')==true){ 
                var status = 1;
            } else {
                var status = 2;
            }
            var id  = $(this).data('id');
            var formdata = {'id':id,'status':status};
            if( status ){
                $.ajax({
                    url: baseUrl+"/office-status-update",
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

        $( document ).on( "click",".delete-office",function( event ) {
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
                        url: baseUrl+"/delete-offices",
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
    function officeValidation(formObj,errors){
        //remove error class
        formObj.find('input').removeClass('parsley-error');
       
        //find flields 
        var nameObj = formObj.find('input[name="name"]');
        var name    = nameObj.val();
        
        var cityObj = formObj.find('input[name="city"]');
        var city    = cityObj.val();
        
        var phoneNoObj = formObj.find('input[name="phone_no"]');
        var phoneNo    = phoneNoObj.val();
        
        var emailObj = formObj.find('input[name="email"]');
        var email    = emailObj.val();
        
        var officesTypeObj = formObj.find('select[name="office_type"]');
        var officesType    = officesTypeObj.val();
        
        var statusObj = formObj.find('select[name="status"]');
        var status    = statusObj.val();
        
        //check value 
        if( name =="" ) {
            errors = 1;
            nameObj.addClass('parsley-error');
        }
        if( city =="" ) {
            errors = 1;
            cityObj.addClass('parsley-error');
        }
        if( phoneNo =="" ) {
            errors = 1;
            phoneNoObj.addClass('parsley-error');
        }
        if( email =="" ) {
            errors = 1;
            emailObj.addClass('parsley-error');
        }
        if( officesType =="" ) {
            errors = 1;
            officesTypeObj.addClass('parsley-error');
        }
        if( status =="" ) {
            errors = 1;
            statusObj.addClass('parsley-error');
        }
        return errors;
    }

</script> 
@endsection