@extends('layouts.app')
@section('title') Nationalities list @endsection
@section('content') 
<!-- Page-Title -->

<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h4 class="page-title m-0">{{ __('page.nationalities_list') }}</h4>
                </div>
                <div class="col-md-4">
                    <div class="float-right">
                        <div class="dropdown">
                          <!--   <a href="{{ url('offices/create') }}"> -->
                                <button class="btn btn-primary add-nationality" type="button" data-title="{{ __('page.add_nationality') }}">
                                    <i class="ti-plus mr-1"></i> {{ __('page.add_nationality') }}
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
                        <th width="30%"> {{ __('page.nationality') }}</th>
                        <th width="30%"> {{ __('page.nationality_english') }}</th>
                        <th width="20%"> {{ __('page.state') }}</th>
                        <th width="10%"> {{ __('page.status') }}</th>
                        <th width="10%"> {{ __('page.action') }}</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->

<div class="modal fade bs-example-modal-lg nationality-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
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
             url: baseUrl+"/nationalitie" ,
              type: 'GET',
             },
             columns: [
                      { data: 'nationality', name: 'nationality' },
                      { data: 'nationality_english', name: 'nationality_english' },
                      { data: 'state', name: 'state' },
                      { data: 'status', name: 'status' },
                      {data: 'action', name: 'action', orderable: false},
                   ],
            order: [[0, 'desc']]
        });

        //nationality code
        $( document ).on( 'click',".add-nationality",function( event ) {
            var title = $(this).data('title'); 
            $('.modal-title').text(title);
            $(".modal-spinner").show();
            $('.result').html("");
            $(".nationality-modal").modal({
    backdrop: 'static',
    keyboard: true,
    show: true
});
            $.ajax({
                url: baseUrl+"/nationalitie/create",
                type:'GET',
                success: function(data) {
                    $(".modal-spinner").hide();
                    $('.result').html(data.view);
                }
            });
        });

        $( document ).on( "submit","#add_nationality",function( event ) {
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
           
            errors = nationalitieValidation(formObj,errors);

            if( errors == 0 ) {
                btnObj.attr("disabled",true);
                btnObj.find("i").addClass('fa-spinner fa-spin');
                $.ajax({
                    url: baseUrl+"/nationalitie",
                    type:'POST',
                    data:formdata,
                    success: function(data) {
                        if($.isEmptyObject(data.error)){
                            var oTable = $('#datatable').dataTable(); 
                            oTable.fnDraw(false);
                            formObj[0].reset();
                            $(".nationality-modal").modal('hide');
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

        $( document ).on( 'click',".edit-nationality",function( event ) {
            var title = $(this).data('title'); 
            $('.modal-title').text(title);
            $(".modal-spinner").show();
            $('.result').html("");
            $(".nationality-modal").modal({
    backdrop: 'static',
    keyboard: true,
    show: true
});
            var id = $(this).data('id');
            $.ajax({
                url: baseUrl+"/nationalitie/"+id+"/edit",
                type:'GET',
                success: function(data) {
                    $(".modal-spinner").hide();
                    $('.result').html(data.view);
                }
            });
        });

        $( document ).on( "submit","#updat_nationality",function( event ) {
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
            errors = nationalitieValidation(formObj,errors);

            if( errors == 0 ) {
                btnObj.attr("disabled",true);
                btnObj.find("i").addClass('fa-spinner fa-spin');
                $.ajax({
                    url: baseUrl+"/nationalitie/"+id,
                    type:'POST',
                    data:formdata,
                    success: function(data) {
                        if($.isEmptyObject(data.error)){
                            $(".nationality-modal").modal('hide');
                            var oTable = $('#datatable').dataTable(); 
                            oTable.fnDraw(false);
                            printSuccessMsg(data.success);
                           /* setTimeout(function(){ 
                            location.reload();
                           }, 3000);*/
                        } else {
                            printErrorMsg(data.error);
                        }
                        btnObj.attr("disabled",false);
                        btnObj.find("i").removeClass('fa-spinner fa-spin');
                    }
                });
            }
        });
        
        $( document ).on( "change",".nationality_status",function( event ) {
            if ($(this).prop('checked')==true){ 
                var status = 1;
            } else {
                var status = 2;
            }
            var id  = $(this).data('id');
            var formdata = {'id':id,'status':status};
            if( status ){
                $.ajax({
                    url: baseUrl+"/nationality-status-update",
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
        
        $( document ).on( "click",".delete-nationality",function( event ) {
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
                        url: baseUrl+"/delete-nationality",
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
    function nationalitieValidation(formObj,errors){
        //remove error class
        formObj.find('input').removeClass('parsley-error');
        formObj.find('span').removeClass('parsley-error');
        
        //find flields 
        var nationalityObj = formObj.find('input[name="nationality"]');
        var nationality    = nationalityObj.val();
        
        var nationalitieEnglishObj = formObj.find('input[name="nationalitie_english"]');
        var nationalitieEnglish   = nationalitieEnglishObj.val();
        
        var stateObj = formObj.find('input[name="state"]');
        var state    = stateObj.val();

        var statusObj = formObj.find('select[name="status"]');
        var status    = statusObj.val();
        
        //check value 
        if( nationality =="" ) {
            errors = 1;
            nationalityObj.addClass('parsley-error');
        }
        if( nationalitieEnglish =="" ) {
            errors = 1;
            nationalitieEnglishObj.addClass('parsley-error');
        }
        if( state =="" ) {
            errors = 1;
            stateObj.addClass('parsley-error');
        }
        if( status =="" ) {
            errors = 1;
            statusObj.addClass('parsley-error');
        }
        return errors;
    }

</script> 
@endsection