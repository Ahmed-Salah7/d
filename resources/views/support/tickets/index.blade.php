@extends('layouts.app')
@section('title') Tickets @endsection
@section('content') 
<!-- Page-Title -->
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h4 class="page-title m-0">{{ __('page.tickets') }}</h4>
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
            	<ul class="nav nav-tabs" role="tablist">
				    <li class="nav-item">
				        <a class="nav-link active" data-toggle="tab" href="#tab_1" aria-expanded="true">{{ __('page.opened') }} <span class="badge badge-warning opened_status">{{ openedStatus() }}</span></a>
				    </li>
				    <li class="nav-item">
				        <a class="nav-link" data-toggle="tab" href="#tab_2">{{ __('page.closed') }} <span class="badge badge-success close_status">{{ closedStatus() }}</span></a>
				    </li>
				</ul>

				<!-- Tab panes -->
				<div class="tab-content">
				    <div id="tab_1" class="container tab-pane active"><br>
				        <table id="openstatus" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
		                    <thead>
		                    <tr>
		                        <th width="20%"> {{ __('page.subject') }}</th>
                                <th  width="30%"> {{ __('page.ticket_id') }}</th>
                                <th  width="20%"> {{ __('page.last_activity') }}</th>
                                <th  width="20%"> {{ __('page.last_replier') }}</th>
                                <th  width="10%"> {{ __('page.status') }}</th>
		                    </tr>
		                    </thead>
		                   
		                </table>
				    </div>
				    <div id="tab_2" class="container tab-pane fade"><br>
				        <table id="closestatus" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
		                    <thead>
		                    <tr>
		                        <th width="20%"> {{ __('page.subject') }}</th>
                                <th  width="30%"> {{ __('page.ticket_id') }}</th>
                                <th  width="20%"> {{ __('page.last_activity') }}</th>
                                <th  width="10%"> {{ __('page.last_replier') }}</th>
                                <th  width="10%"> {{ __('page.close_by') }}</th>
                                <th  width="10%"> {{ __('page.status') }}</th>
		                    </tr>
		                    </thead>
		                   
		                </table>
				    </div>
				</div>
            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->
<div class="modal fade bs-example-modal-lg ticket-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
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
        $('#tab_2').trigger('click');
        $('#openstatus').DataTable({
                "language": {
                    "url": lang
                },
             processing: true,
             serverSide: true,
             ordering: false,
             ajax: {
             url: baseUrl+"/support/ticket/status-open" ,
              type: 'GET',
             },
             columns: [
                        { data: 'subject', name: 'subject' },
                        { data: 'ticket_number', name: 'ticket_number' },
                        { data: 'last_activity', name: 'last_activity' },
                        { data: 'last_replier', name: 'last_replier' },
                        { data: 'status', name: 'status' },
                   ],
            order: [[0, 'desc']]
        });
        $('#closestatus').DataTable({
                "language": {
                    "url": lang
                },
             processing: true,
             serverSide: true,
             ordering: false,
             ajax: {
             url: baseUrl+"/support/ticket/status-close" ,
              type: 'GET',
             },
             columns: [
                        { data: 'subject', name: 'subject' },
                        { data: 'ticket_number', name: 'ticket_number' },
                        { data: 'last_activity', name: 'last_activity' },
                        { data: 'last_replier', name: 'last_replier' },
                        { data: 'username', name: 'username' },
                        { data: 'status', name: 'status' },
                   ],
            order: [[0, 'desc']]
        });
        
		//ticket code
	    $( document ).on( "submit","#add_comment",function( event ) {
            event.preventDefault(); 
            $(".print-error-msg").css('display','none');
            $(".print-success-msg").css('display','none');
            //define variation
            var errors = 0;
            //get fome object
            var formObj = $(this);
             //get button object
            var btnObj   = formObj.find('button[type="submit"]');
            var id = btnObj.data('id');
            var formdata = new FormData(this);
            formdata.append('page','');
            errors = ticketValidation(formObj,errors);

            if( errors == 0 ) {
                btnObj.attr("disabled",true);
                btnObj.find("i").addClass('fa-spinner fa-spin');
                $.ajax({
                    url: baseUrl+"/support/ticket/add-comment/"+id,
                    type:'POST',
                    data:formdata,
                    dataType:'JSON',
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(data) {
                        if($.isEmptyObject(data.error)){
                            formObj[0].reset();
                            $(".ticket-modal").modal('hide');
                            $('.opened_status').text(data.openedStatus);
                            $('.close_status').text(data.closedStatus);
                            var openstatus = $('#openstatus').dataTable(); 
                            openstatus.fnDraw(false);
                            var closestatus = $('#closestatus').dataTable(); 
                            closestatus.fnDraw(false);
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

        $( document ).on( 'click',".check-ticket",function( event ) {
            var title = $(this).data('title'); 
            $('.modal-title').text(title);
            $(".modal-spinner").show();
            $('.result').html("");
            $(".ticket-modal").modal({
    backdrop: 'static',
    keyboard: true,
    show: true
});
            var id = $(this).data('id');
            $.ajax({
                url: baseUrl+"/support/ticket/check-ticket/"+id,
                type:'GET',
                success: function(data) {
                    $(".modal-spinner").hide();
                    $('.result').html(data.view);
                }
            });
        });

        $( document ).on( "click",".ticket_colse",function( event ) {
            var id  = $(this).data('id');
            var formdata = {'id':id,'page':''};
            if( id ){
                $.ajax({
                    url: baseUrl+"/support/ticket/ticket-close",
                    type:'GET',
                    data:formdata,
                    success: function(data) {
                        if($.isEmptyObject(data.error)){
                            $('[href="#tab_2"]').trigger('click');
                            $('.opened_status').text(data.openedStatus);
                            $('.close_status').text(data.closedStatus);
                            var openstatus = $('#openstatus').dataTable(); 
                            openstatus.fnDraw(false);
                            var closestatus = $('#closestatus').dataTable(); 
                            closestatus.fnDraw(false);
                            $(".ticket-modal").modal('hide');
                            printSuccessMsg(data.success);
                        } else {
                           singleErrorMsg(data.error);
                        }
                    }
                });
            }
        });

	});
	
	function ticketValidation(formObj,errors,edit=''){
        //remove error class
        formObj.find('input').removeClass('parsley-error');
        formObj.find('span').removeClass('parsley-error');
        
        //find flields 
        var messageObj = formObj.find('textarea[name="message"]');
        var message    = messageObj.val();
        
        //check value 
        if( message =="" ) {
            errors = 1;
            messageObj.addClass('parsley-error');
        }
        return errors;
    }
</script> 
@endsection