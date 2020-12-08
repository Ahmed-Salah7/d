@extends('layouts.app')
@section('title') Customers list @endsection
@section('content')
<!-- Page-Title -->
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h4 class="page-title m-0">{{ __('page.customers_list') }}</h4>
                </div>
                <div class="col-md-4">
                    <div class="float-right">
                        <div class="dropdown">
                            <button class="btn btn-primary add-customer" type="button" data-title="{{ __('page.add_customer') }}">
                                <i class="ti-plus mr-1"></i> {{ __('page.add_customer') }}
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
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>{{ __('page.name') }}</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="name" name="name" value="" >
                            </div><!-- input-group -->
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>{{ __('page.id_card_number') }}</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="id_card_number" name="id_card_number" value="" >
                            </div><!-- input-group -->
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>{{ __('page.mobile_number') }}</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="mobile_number" name="mobile_number" value="" >
                            </div><!-- input-group -->
                        </div>
                    </div>


                    <div class="col-md-3">
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
                        <th> {{ __('page.id_number') }}</th>
                        <th> {{ __('page.id_card_number') }}</th>
                        <th> {{ __('page.mobile_number') }}</th>
                        <th> {{ __('page.date_of_birth') }}</th>
                        <th> {{ __('page.address') }}</th>
                        <th> {{ __('page.contracts') }}</th>
{{--                        <th> {{ __('page.nationality') }}</th>--}}
{{--                        <th> {{ __('page.home_number') }}</th>--}}
{{--                        <th> {{ __('page.title') }}</th>--}}
                        <th> {{ __('page.status') }}</th>
                        <th> {{ __('page.action') }}</th>
                        <th> {{ __('page.procedures') }}</th>
                    </tr>
                    </thead>

                </table>
            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->
<div class="modal fade bs-example-modal-lg customer-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
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
             url: baseUrl+"/office-work/customer" ,
              type: 'GET',
                 data: function (d) {
                     d.name = $('#name').val();
                     d.id_card_number = $('#id_card_number').val();
                     d.mobile_number = $('#mobile_number').val();
                 },
             },
             columns: [
                      { data: 'name', name: 'name' },
                      { data: 'id_number', name: 'id_number' },
                      { data: 'id_card_number', name: 'id_card_number' },
                      { data: 'mobile_number', name: 'mobile_number' },
                 { data: 'date_of_birth', name: 'date_of_birth' },
                 { data: 'address', name: 'address' },
                 { data: 'contracts', name: 'contracts' },
                 // { data: 'nationality', name: 'nationality' },
                 // { data: 'home_number', name: 'home_number' },
                 // { data: 'title', name: 'title' },
                      { data: 'status', name: 'status' },
                      {data: 'action', name: 'action', orderable: false},
                      {data: 'procedures', name: 'procedures'},
                   ],
            order: [[0, 'desc']]
        });
         //customer code
        $( document ).on( 'click',".add-customer",function( event ) {
            var title = $(this).data('title');
            $('.modal-title').text(title);
            $(".modal-spinner").show();
            $('.result').html("");
            $(".customer-modal").modal({
                backdrop: 'static',
                keyboard: true,
                show: true
            });
            $(".modal-close").attr("data-id", "add_customer");

            $.ajax({
                url: baseUrl+"/office-work/customer/create",
                type:'GET',
                success: function(data) {
                    $(".modal-spinner").hide();
                    $('.result').html(data.view);
                }
            });
        });
        $( document ).on( "submit","#search",function( event ) {
            event.preventDefault();
            var formObj = $(this);
            var btnObj   = formObj.find('button[type="submit"]');
            var formdata = formObj.serialize();
            btnObj.attr("disabled",true);
            btnObj.find("i.spinner").addClass('fa-spinner fa-spin');
            var oTable = $('#datatable').dataTable();
            oTable.fnDraw(false);
            btnObj.attr("disabled",false);
            btnObj.find("i.spinner").removeClass('fa-spinner fa-spin');
        });
        $( document ).on( "submit","#add_customer",function( event ) {
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
            errors = costomerValidation(formObj,errors);

            if( errors == 0 ) {
                btnObj.attr("disabled",true);
                btnObj.find("i").addClass('fa-spinner fa-spin');
                $.ajax({
                    url: baseUrl+"/office-work/customer",
                    type:'POST',
                    data:formdata,
                    success: function(data) {
                        if($.isEmptyObject(data.error)){
                            var oTable = $('#datatable').dataTable();
                            oTable.fnDraw(false);
                            formObj[0].reset();
                            $(".customer-modal").modal('hide');
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

        $( document ).on( 'click',".edit-customer",function( event ) {
            var title = $(this).data('title');
            $('.modal-title').text(title);
            $(".modal-spinner").show();
            $('.result').html("");
            $(".customer-modal").modal({
    backdrop: 'static',
    keyboard: true,
    show: true
});
            var id = $(this).data('id');
            $.ajax({
                url: baseUrl+"/office-work/customer/"+id+"/edit",
                type:'GET',
                success: function(data) {
                    $(".modal-spinner").hide();
                    $('.result').html(data.view);
                }
            });
        });

        $( document ).on( "submit","#updat_customer",function( event ) {
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
            errors = costomerValidation(formObj,errors);

            if( errors == 0 ) {
                btnObj.attr("disabled",true);
                btnObj.find("i").addClass('fa-spinner fa-spin');
                $.ajax({
                    url: baseUrl+"/office-work/customer/"+id,
                    type:'POST',
                    data:formdata,
                    success: function(data) {
                        if($.isEmptyObject(data.error)){
                            $(".customer-modal").modal('hide');
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

        $( document ).on( "change",".customer_status",function( event ) {
            if ($(this).prop('checked')==true){
                var status = 1;
            } else {
                var status = 2;
            }
            var id  = $(this).data('id');
            var formdata = {'id':id,'status':status};
            if( status ){
                $.ajax({
                    url: baseUrl+"/office-work/customer-status-update",
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

        $( document ).on( "click",".delete-customer",function( event ) {
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
                        url: baseUrl+"/office-work/delete-customer",
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

        $( document ).on( "click",".customer-details",function( event ) {
            var title = $(this).data('title');
            $('.modal-title').text(title);
            $(".modal-spinner").show();
            $('.result').html("");
            $(".customer-modal").modal({
    backdrop: 'static',
    keyboard: true,
    show: true
});
            var id = $(this).data('id');
            $.ajax({
                url: baseUrl+"/office-work/get-customer-details/"+id,
                type:'GET',
                success: function(data) {
                    $(".modal-spinner").hide();
                    $('.result').html(data.view);
                }
            });
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
            $(".employment-contract-modal").modal({ backdrop: 'static',
                        keyboard: true,
                        show: true});
            var id = $(this).data('id');
            $.ajax({
                url: baseUrl+"/office-work/get-customer-contracts/"+id,
                type:'GET',
                success: function(data) {
                    $(".modal-spinner").hide();
                    $('.employment-contract-result').html(data.view);
                }
            });
        });

        $( document ).on( "submit","#updat_customer_details",function( event ) {
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
            errors = costomerValidation(formObj,errors);

            if( errors == 0 ) {
                btnObj.attr("disabled",true);
                btnObj.find("i").addClass('fa-spinner fa-spin');
                $.ajax({
                    url: baseUrl+"/office-work/customer-details-update/"+id,
                    type:'POST',
                    dataType: "JSON",
                    data: new FormData(this),
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        if($.isEmptyObject(data.error)){
                            $(".customer-modal").modal('hide');
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
                    //url: baseUrl+"/office-work/employment-contract/"+id,
                    url: baseUrl+"/office-work/employment-contract/"+$('#customer-id').val(),
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
                    }
                });
            }
        });
    });
    function costomerValidation(formObj,errors,edit=''){
    //remove error class
        formObj.find('input').removeClass('parsley-error');
        formObj.find('span').removeClass('parsley-error');

        //find flields
        var nameObj = formObj.find('input[name="name"]');
        var name    = nameObj.val();

        var idNumberObj = formObj.find('input[name="id_number"]');
        var idNumber    = idNumberObj.val();

        var placeOfIssueObj = formObj.find('input[name="place_of_issue"]');
        var placeOfIssue    = placeOfIssueObj.val();

        var nationalityObj = formObj.find('input[name="nationality_id"]');
        var nationality    = nationalityObj.val();

        var mobileNumberObj = formObj.find('input[name="mobile_number"]');
        var mobileNumber    = mobileNumberObj.val();

        var titleObj = formObj.find('input[name="title"]');
        var title    = titleObj.val();

        var dateOfBirthObj = formObj.find('input[name="date_of_birth"]');
        var dateOfBirth = dateOfBirthObj.val();

        var statusObj = formObj.find('select[name="status"]');
        var status    = statusObj.val();

        //check value
        if( name =="" ) {
            errors = 1;
            nameObj.addClass('parsley-error');
        }
        if( idNumber =="" ) {
            errors = 1;
            idNumberObj.addClass('parsley-error');
        }
        if( placeOfIssue =="" ) {
            errors = 1;
            placeOfIssueObj.addClass('parsley-error');
        }
        if( nationality ==""   ) {
            errors = 1;
            nationalityObj.addClass('parsley-error');
        }
        if( mobileNumber =="" ) {
            errors = 1;
            mobileNumberObj.addClass('parsley-error');
        }
        if( title =="" ) {
            errors = 1;
            titleObj.addClass('parsley-error');
        }
        if( dateOfBirth =="" ) {
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

</script>
<script>
        $( document ).on( "click",".add-new-contract",function( event ) {
			var baseUrl = $("#baseUrl").data('url');
            var c_id = $(this).data('c_id');
            var title = $(this).data('title');
            $('.modal-title').text(title);
            $(".modal-spinner").show();
            $('.employment-contract-result').html("");

            $(".employment-contract-modal").modal({ backdrop: 'static',
                        keyboard: true,
                        show: true});
            $.ajax({
                url: baseUrl+"/dashboard/get-customer-contracts",
                type:'GET',
                success: function(data) {
                    $(".modal-spinner").hide();
                    $('.employment-contract-result').html(data.view);
					$('#customer-id').val(c_id);
					$('#customer-id').attr("disabled", true); 
                }
            });
        });

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
                    $(".customer-modal").modal('hide');
                }
            })
        });

</script>


@endsection