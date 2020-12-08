@extends('layouts.app')
@section('title') Currencies list @endsection
@section('content') 
<!-- Page-Title -->

<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h4 class="page-title m-0">{{ __('page.currencies_list') }}</h4>
                </div>
                <div class="col-md-4">
                    <div class="float-right">
                        <div class="dropdown">
                          <!--   <a href="{{ url('offices/create') }}"> -->
                                <button class="btn btn-primary add-currency" type="button" data-title="{{ __('page.add_currency') }}">
                                    <i class="ti-plus mr-1"></i> {{ __('page.add_currency') }}
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
                        <th width="30%"> {{ __('page.currency_name') }}</th>
                        <th width="30%"> {{ __('page.currency_name_english') }}</th>
                        <th width="30%"> {{ __('page.abbreviation') }}</th>
                        <th width="10%"> {{ __('page.action') }}</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->

<div class="modal fade bs-example-modal-lg currency-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
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
              url: "{{ url('/accounting/currency') }}" ,
              type: 'GET',
             },
             columns: [
                      { data: 'currency_name', name: 'currency_name' },
                      { data: 'currency_name_english', name: 'currency_name_english' },
                      { data: 'abbreviation', name: 'abbreviation' },
                      {data: 'action', name: 'action', orderable: false},
                   ],
            order: [[0, 'desc']]
        });

        //religion code
        $( document ).on( 'click',".add-currency",function( event ) {
            var title = $(this).data('title'); 
            $('.modal-title').text(title);
            $(".modal-spinner").show();
            $('.result').html("");
            $(".currency-modal").modal('show');
            $.ajax({
                url: baseUrl+"/accounting/currency/create",
                type:'GET',
                success: function(data) {
                    $(".modal-spinner").hide();
                    $('.result').html(data.view);
                }
            });
        });

        $( document ).on( "submit","#add_currency",function( event ) {
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
           
            errors = currencyValidation(formObj,errors);

            if( errors == 0 ) {
                btnObj.attr("disabled",true);
                btnObj.find("i").addClass('fa-spinner fa-spin');
                $.ajax({
                    url: baseUrl+"/accounting/currency",
                    type:'POST',
                    data:formdata,
                    success: function(data) {
                        if($.isEmptyObject(data.error)){
                            var oTable = $('#datatable').dataTable(); 
                            oTable.fnDraw(false);
                            formObj[0].reset();
                            $(".currency-modal").modal('hide');
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

        $( document ).on( 'click',".edit-currency",function( event ) {
            var title = $(this).data('title'); 
            $('.modal-title').text(title);
            $(".modal-spinner").show();
            $('.result').html("");
            $(".currency-modal").modal('show');
            var id = $(this).data('id');
            $.ajax({
                url: baseUrl+"/accounting/currency/"+id+"/edit",
                type:'GET',
                success: function(data) {
                    $(".modal-spinner").hide();
                    $('.result').html(data.view);
                }
            });
        });

        $( document ).on( "submit","#update_currency",function( event ) {
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
            errors = currencyValidation(formObj,errors);

            if( errors == 0 ) {
                btnObj.attr("disabled",true);
                btnObj.find("i").addClass('fa-spinner fa-spin');
                $.ajax({
                    url: baseUrl+"/accounting/currency/"+id,
                    type:'POST',
                    data:formdata,
                    success: function(data) {
                        if($.isEmptyObject(data.error)){
                            $(".currency-modal").modal('hide');
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
        
        $( document ).on( "click",".delete-currency",function( event ) {
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
                        url: baseUrl+"/accounting/delete-currency",
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
    function currencyValidation(formObj,errors){
        //remove error class
        formObj.find('input').removeClass('parsley-error');
        formObj.find('span').removeClass('parsley-error');
        
        //find flields 
        var currencyNameObj = formObj.find('input[name="currency_name"]');
        var currencyName    = currencyNameObj.val();
        
        var currencyNameEnglishObj = formObj.find('input[name="currency_name_english"]');
        var currencyNameEnglish   = currencyNameEnglishObj.val();
        
        var abbreviationObj = formObj.find('input[name="abbreviation"]');
        var abbreviation   = abbreviationObj.val();
        
        //check value 
        if( currencyName =="" ) {
            errors = 1;
            currencyNameObj.addClass('parsley-error');
        }
        if( currencyNameEnglish =="" ) {
            errors = 1;
            currencyNameEnglishObj.addClass('parsley-error');
        }
         if( abbreviation =="" ) {
            errors = 1;
            abbreviationObj.addClass('parsley-error');
        }
        return errors;
    }
</script> 
@endsection