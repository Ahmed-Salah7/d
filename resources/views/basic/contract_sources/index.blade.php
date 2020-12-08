@extends('layouts.app')
@section('title') Contract Sources list @endsection
@section('content') 
<!-- Page-Title -->

<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h4 class="page-title m-0">{{ __('page.contract_sources_list') }}</h4>
                </div>
                <div class="col-md-4">
                    <div class="float-right">
                        <div class="dropdown">
                          <!--   <a href="{{ url('offices/create') }}"> -->
                                <button class="btn btn-primary add-contract-source" type="button" data-title="{{ __('page.add_contract_source') }}">
                                    <i class="ti-plus mr-1"></i> {{ __('page.add_contract_source') }}
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
                        <th width="90%"> {{ __('page.source') }}</th>
                        <th width="10%"> {{ __('page.action') }}</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->
<div class="modal fade bs-example-modal-lg contract-source-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
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
              url: "{{ url('/contraact-source') }}" ,
              type: 'GET',
             },
             columns: [
                      { data: 'source', name: 'source' },
                      {data: 'action', name: 'action', orderable: false},
                   ],
            order: [[0, 'desc']]
        });

        //contraact-source code
        $( document ).on( 'click',".add-contract-source",function( event ) {
            var title = $(this).data('title'); 
            $('.modal-title').text(title);
            $(".modal-spinner").show();
            $('.result').html("");
            $(".contract-source-modal").modal({
    backdrop: 'static',
    keyboard: true,
    show: true
});
            $.ajax({
                url: baseUrl+"/contraact-source/create",
                type:'GET',
                success: function(data) {
                    $(".modal-spinner").hide();
                    $('.result').html(data.view);
                }
            });
        });

        $( document ).on( "submit","#add_contract_source",function( event ) {
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
           
            errors = contractSourceValidation(formObj,errors);

            if( errors == 0 ) {
                btnObj.attr("disabled",true);
                btnObj.find("i").addClass('fa-spinner fa-spin');
                $.ajax({
                    url: baseUrl+"/contraact-source",
                    type:'POST',
                    data:formdata,
                    success: function(data) {
                        if($.isEmptyObject(data.error)){
                            var oTable = $('#datatable').dataTable(); 
                            oTable.fnDraw(false);
                            formObj[0].reset();
                            $(".contract-source-modal").modal('hide');
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

        $( document ).on( 'click',".edit-contract-source",function( event ) {
            var title = $(this).data('title'); 
            $('.modal-title').text(title);
            $(".modal-spinner").show();
            $('.result').html("");
            $(".contract-source-modal").modal({
    backdrop: 'static',
    keyboard: true,
    show: true
});
            var id = $(this).data('id');
            $.ajax({
                url: baseUrl+"/contraact-source/"+id+"/edit",
                type:'GET',
                success: function(data) {
                    $(".modal-spinner").hide();
                    $('.result').html(data.view);
                }
            });
        });

        $( document ).on( "submit","#updat_contract_source",function( event ) {
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
            errors = contractSourceValidation(formObj,errors);

            if( errors == 0 ) {
                btnObj.attr("disabled",true);
                btnObj.find("i").addClass('fa-spinner fa-spin');
                $.ajax({
                    url: baseUrl+"/contraact-source/"+id,
                    type:'POST',
                    data:formdata,
                    success: function(data) {
                        if($.isEmptyObject(data.error)){
                            $(".contract-source-modal").modal('hide');
                            var oTable = $('#datatable').dataTable(); 
                            oTable.fnDraw(false);
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
        
        $( document ).on( "click",".delete-contract-source",function( event ) {
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
                    url: baseUrl+"/delete-contraact-source",
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
    function contractSourceValidation(formObj,errors){
        //remove error class
        formObj.find('input').removeClass('parsley-error');
        formObj.find('span').removeClass('parsley-error');
        
        //find flields 
        var sourceObj = formObj.find('input[name="source"]');
        var Source    = sourceObj.val();
        
        //check value 
        if( Source =="" ) {
            errors = 1;
            sourceObj.addClass('parsley-error');
        }
        return errors;
    }
</script> 
@endsection