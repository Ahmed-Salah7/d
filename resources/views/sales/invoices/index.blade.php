@extends('layouts.app')
@section('title') Invoices List @endsection
@section('content')
<!-- Page-Title -->
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h4 class="page-title m-0">{{ __('page.invoices_list') }}</h4>
                </div>
                <div class="col-md-4">
                    <div class="float-right">
                        <div class="dropdown">
                          <!--   <a href="{{ url('offices/create') }}"> -->
                                <button class="btn btn-primary add-invoice" type="button" data-title="{{ __('page.add_invoice') }}">
                                    <i class="ti-plus mr-1"></i> {{ __('page.add_invoice') }}
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
                        <th width="15%"> {{ __('page.date') }}</th>
                        <th width="10%"> {{ __('page.customer') }}</th>
                        <th width="15%"> {{ __('page.total') }}</th>
                        <th width="15%"> {{ __('page.paid') }}</th>
                        <th width="15%"> {{ __('page.balance') }}</th>
                        <th width="10%"> {{ __('page.due_date') }}</th>
                        <th width="10%"> {{ __('page.status') }}</th>
                        <th width="10%"> {{ __('page.action') }}</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->

<div class="modal fade bs-example-modal-lg invoice-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
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

<div class="modal fade bs-example-modal-lg view-invoice-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body">
                <div class="modal-spinner">
                    <div class="d-flex justify-content-center mt-5 mb-5">
                        <div class="spinner-border" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                    </div>
                </div>
                <div class="result-view">
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
              url: "{{ url('/sales/invoice') }}" ,
              type: 'GET',
             },
             columns: [
                      { data: 'date', name: 'date' },
                      { data: 'customer_name', name: 'customer_name' },
                       { data: 'grand_total', name: 'grand_total' },
                       { data: 'paid', name: 'paid' },
                       { data: 'balance', name: 'balance' },
                       { data: 'due_date', name: 'due_date' },
                       { data: 'status', name: 'status' },
                      {data: 'action', name: 'action', orderable: false},
                   ],
            order: [[0, 'desc']]
        });

        //religion code
        $( document ).on( 'click',".add-invoice",function( event ) {
            var title = $(this).data('title');
            $('.modal-title').text(title);
            $(".modal-spinner").show();
            $('.result').html("");
            $(".invoice-modal").modal({
    backdrop: 'static',
    keyboard: true,
    show: true
});
            $.ajax({
                url: baseUrl+"/sales/invoice/create",
                type:'GET',
                success: function(data) {
                    $(".modal-spinner").hide();
                    $('.result').html(data.view);
                }
            });
        });

        $( document ).on( "submit","#add_invoice",function( event ) {
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
            errors = invoiceValidation(formObj,errors);

            if( errors == 0 ) {
                btnObj.attr("disabled",true);
                btnObj.find("i").addClass('fa-spinner fa-spin');
                $.ajax({
                    url: baseUrl+"/sales/invoice",
                    type:'POST',
                    data:formdata,
                    success: function(data) {
                        if($.isEmptyObject(data.error)){
                            var oTable = $('#datatable').dataTable();
                            oTable.fnDraw(false);
                            formObj[0].reset();
                            $(".invoice-modal").modal('hide');
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

        $( document ).on( 'click',".edit-invoce",function( event ) {
            var title = $(this).data('title');
            $('.modal-title').text(title);
            $(".modal-spinner").show();
            $('.result').html("");
            $(".invoice-modal").modal({
    backdrop: 'static',
    keyboard: true,
    show: true
});
            var id = $(this).data('id');
            $.ajax({
                url: baseUrl+"/sales/invoice/"+id+"/edit",
                type:'GET',
                success: function(data) {
                    $(".modal-spinner").hide();
                    $('.result').html(data.view);
                }
            });
        });

        $( document ).on( "submit","#update_invoice",function( event ) {
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
            errors = invoiceValidation(formObj,errors);

            if( errors == 0 ) {
                btnObj.attr("disabled",true);
                btnObj.find("i").addClass('fa-spinner fa-spin');
                $.ajax({
                    url: baseUrl+"/sales/invoice/"+id,
                    type:'POST',
                    data:formdata,
                    success: function(data) {
                        if($.isEmptyObject(data.error)){
                            $(".invoice-modal").modal('hide');
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

        $( document ).on( "click",".delete-invoice",function( event ) {
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
                        url: baseUrl+"/sales/delete-invoice",
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

        $( document ).on( "click",".view-invoice",function(){
            var title = $(this).data('title');
            $('.modal-title').text(title);
            $(".modal-spinner").show();
            $('.result-view').html("");
            $(".view-invoice-modal").modal({
    backdrop: 'static',
    keyboard: true,
    show: true
});
            var id = $(this).data('id');
            $.ajax({
                url: baseUrl+"/sales/invoice/"+id,
                type:'GET',
                success: function(data) {
                    $(".modal-spinner").hide();
                    $('.result-view').html(data.view);
                }
            });
        });

        $( document ).on( "click",".invoce-payment-add",function(){
            var title = $(this).data('title');
            $('.modal-title').text(title);
            $(".modal-spinner").show();
            $('.result').html("");
            $(".invoice-modal").modal({
    backdrop: 'static',
    keyboard: true,
    show: true
});
            var id = $(this).data('id');
            $.ajax({
                url: baseUrl+"/sales/invoice-payment-add/"+id,
                type:'GET',
                success: function(data) {
                    $(".modal-spinner").hide();
                    $('.result').html(data.view);
                }
            });
        });

        $( document ).on( "click",".invoce-payment-add",function(){
            var title = $(this).data('title');
            $('.modal-title').text(title);
            $(".modal-spinner").show();
            $('.result').html("");
            $(".invoice-modal").modal({
    backdrop: 'static',
    keyboard: true,
    show: true
});
            var id = $(this).data('id');
            $.ajax({
                url: baseUrl+"/sales/invoice-payment-add/"+id,
                type:'GET',
                success: function(data) {
                    $(".modal-spinner").hide();
                    $('.result').html(data.view);
                }
            });
        });

        $( document ).on( "submit","#add_invoice_payment",function( event ) {
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
            errors = invoicePaymenyValidation(formObj,errors);

            if( errors == 0 ) {
                btnObj.attr("disabled",true);
                btnObj.find("i").addClass('fa-spinner fa-spin');
                $.ajax({
                    url: baseUrl+"/sales/invoice-payment-add/"+id,
                    type:'POST',
                    data:formdata,
                    success: function(data) {
                        if($.isEmptyObject(data.error)){
                            var oTable = $('#datatable').dataTable();
                            oTable.fnDraw(false);
                            formObj[0].reset();
                            $(".invoice-modal").modal('hide');
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

        $( document ).on( "click",".invoce-payment-view",function(){
            var title = $(this).data('title');
            $('.modal-title').text(title);
            $(".modal-spinner").show();
            $('.result').html("");
            $(".invoice-modal").modal('show');
            var id = $(this).data('id');
            $.ajax({
                url: baseUrl+"/sales/invoice-payment-view/"+id,
                type:'GET',
                success: function(data) {
                    $(".modal-spinner").hide();
                    $('.result').html(data.view);
                }
            });
        });

        $( document ).on( "click",".edit-invoice-payment",function(){
            var title = $(this).data('title');
            $('.modal-title').text(title);
            $(".modal-spinner").show();
            $('.result').html("");
            var id = $(this).data('id');
            $.ajax({
                url: baseUrl+"/sales/invoice-payment-edit/"+id,
                type:'GET',
                success: function(data) {
                    $(".modal-spinner").hide();
                    $('.result').html(data.view);
                }
            });
        });

        $( document ).on( "submit","#update_invoice_payment",function( event ) {
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
            errors = invoicePaymenyValidation(formObj,errors);

            if( errors == 0 ) {
                btnObj.attr("disabled",true);
                btnObj.find("i").addClass('fa-spinner fa-spin');
                $.ajax({
                    url: baseUrl+"/sales/invoice-payment-update/"+id,
                    type:'POST',
                    data:formdata,
                    success: function(data) {
                        if($.isEmptyObject(data.error)){
                            var oTable = $('#datatable').dataTable();
                            oTable.fnDraw(false);
                            formObj[0].reset();
                            $(".invoice-modal").modal('hide');
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

        $( document ).on( "click",".delete-invoice-payment",function( event ) {
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
                        url: baseUrl+"/sales/delete-invoice-payment",
                        type: "POST",
                        data: {_token: token,id:id },
                        success: function (data) {
                            if($.isEmptyObject(data.error)){
                                $(".invoice-modal").modal('hide');
                                var oTable = $('#datatable').dataTable();
                                oTable.fnDraw(false);
                                swal(
                                    recordMsgarray.deleted_title,
                                    data.success,
                                    'success'
                                );
                            } else {
                               printErrorMsg(data.error);
                            }
                        }
                    });
                }
            })
        });

        $( document ).on( "click",".download-pdf",function(){
            var id = $(this).data('id');
            $.ajax({
                url: baseUrl+"/sales/invoice/pdf/"+id,
                type:'GET',
                success: function(data) {
                    $(".modal-spinner").hide();
                    $('.result').html(data.view);
                    if(!$.isEmptyObject(data.error)){
                        printErrorMsg(data.error);
                    }

                }
            });
        });

        $( document ).on( "keyup change","#tab_logic tbody",function( event ) {
            calc();
        });
        $( document ).on( "keyup change","#tax",function( event ) {
            calc();
        });
        $( document ).on( "keyup change","#order_discount",function( event ) {
            calc();
        });

    });
    function invoiceValidation(formObj,errors){
        //remove error class
        formObj.find('input').removeClass('parsley-error');
        formObj.find('span').removeClass('parsley-error');

        //find flields
        var dateObj = formObj.find('input[name="date"]');
        var date    = dateObj.val();

        //find flields
        var timeObj = formObj.find('input[name="time"]');
        var time    = timeObj.val();

        var customerObj = formObj.find('select[name="customer_id"]');
        var customer    = customerObj.val();

        var dueDateObj = formObj.find('input[name="due_date"]');
        var dueDate    = dueDateObj.val();

        var statusObj = formObj.find('select[name="status"]');
        var status    = statusObj.val();

        var productObj = formObj.find("#product");
        var product    = productObj.val();

        var qtyObj = formObj.find("#qty");
        var qty    = qtyObj.val();

        var priceObj = formObj.find("#price");
        var price    = priceObj.val();

        //check value
        if( date =="" ) {
            errors = 1;
            dateObj.addClass('parsley-error');
            dateObj.closest('div').find('span').addClass('parsley-error');
        }
        if( time =="" ) {
            errors = 1;
            timeObj.addClass('parsley-error');
            timeObj.closest('div').find('span').addClass('parsley-error');
        }
        if( customer =="" ) {
            errors = 1;
            customerObj.addClass('parsley-error');
        }
        if( dueDate =="" ) {
            errors = 1;
            dueDateObj.addClass('parsley-error');
            dueDateObj.closest('div').find('span').addClass('parsley-error');
        }
        if( status =="" ) {
            errors = 1;
            statusObj.addClass('parsley-error');
        }
        if( product =="" ) {
            errors = 1;
            productObj.addClass('parsley-error');
        }
        if( qty =="" ) {
            errors = 1;
            qtyObj.addClass('parsley-error');
        }
        if( price =="" ) {
            errors = 1;
            priceObj.addClass('parsley-error');
        }
        return errors;
    }

    function invoicePaymenyValidation(formObj,errors){
        //remove error class
        formObj.find('input').removeClass('parsley-error');
        formObj.find('span').removeClass('parsley-error');

        //find flields
        var amountPaidObj = formObj.find('input[name="amount_paid"]');
        var amountPaid    = amountPaidObj.val();

        //check value
        if( amountPaid =="" ) {
            errors = 1;
            amountPaidObj.addClass('parsley-error');
        }
        return errors;
    }

    function calc()
    {
        $('#tab_logic tbody tr').each(function(i, element) {
            var html = $(this).html();
            if(html!='')
            {
                var qty = $(this).find('.qty').val();
                var price = $(this).find('.price').val();
                if( qty!="" ||  price!="") {
                    var total = qty*price;
                    $(this).find('.total').text(total.toFixed(2));
                }
                calc_total();
            }
        });
    }

    function calc_total()
    {

        total=0;
        $('.total').each(function() {
            if( $(this).text() !="" ) {
                total += parseInt($(this).text());
            }
        });
        var orderDiscount = parseInt($('#order_discount').val());

        if(Math.floor(orderDiscount) == orderDiscount && $.isNumeric(orderDiscount)) {
            var orderDiscount = orderDiscount;
        } else {
            var orderDiscount = 0;
        }
        if(isNaN(total)){
            var tax_sum = 0;
            var total = 0;
        }
        $('#discount').text(orderDiscount.toFixed(2));
        $('#sub_total').text(total.toFixed(2));
        total = total-orderDiscount;
        tax_sum=total/100*$('#tax').val();
        $('#tax_amount').text(tax_sum.toFixed(2));
        $('#total_amount').text(((tax_sum+total)).toFixed(2));
    }

</script>
@endsection