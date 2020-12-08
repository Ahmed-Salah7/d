@extends('layouts.app')
@section('title') cv list @endsection
@section('content')
<!-- Page-Title -->
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h4 class="page-title m-0">{{ __('page.cv_list') }}</h4>
                </div>
                <div class="col-md-4">
                    <div class="float-right">
                        <div class="dropdown">
                            <button class="btn btn-primary add-cv" type="button" data-title="{{ __('page.add_cv') }}">
                                <i class="ti-plus mr-1"></i> {{ __('page.add_cv') }}
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

                    <div class="col-md-3">
                        <div class="form-group">
                            <label>{{ __('page.office') }}</label>
                            <select class="form-control" name="office_id" id="office_id">
                                <option value="">{{ __('page.select_office') }}</option>
                                @if( count($Offices) > 0 )
                                    @foreach( $Offices as $Office )
                                        <option value='{{ $Office->id }}'> {{ (Session::get('locale') =='en') ? $Office->name : $Office->name  }} </option>
                                    @endforeach
                                @endif
                            </select>
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
                        <th> {{ __('page.occupation') }}</th>
                        <th> {{ __('page.nationality') }}</th>
                        <th> {{ __('page.religion') }}</th>
                        <th> {{ __('page.age') }}</th>
                        <th> {{ __('page.previous_experience') }}</th>
                        <th> {{ __('page.office') }}</th>
                        <th> {{ __('page.passport_number') }}</th>
                        <th> {{ __('page.reservation') }}</th>
                        <th> {{ __('page.status') }}</th>
                        <th> {{ __('page.action') }}</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->
<div class="modal fade bs-example-modal-lg cv-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
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
                url: baseUrl+"/office-work/cv" ,
                type: 'GET',
                data: function (d) {
                    d.nationality_id = $('#nationality_id').val();
                    d.office_id = $('#office_id').val();

                },
             },
             columns: [
                      { data: 'cv_name', name: 'cv_name' },
                      { data: 'occupation', name: 'occupation' },
                      { data: 'nationality', name: 'nationality' },
                      { data: 'religion', name: 'religion' },
                      { data: 'age', name: 'age' },
                      { data: 'previous_experience', name: 'previous_experience' },
                      { data: 'office_name', name: 'office_name' },
                      { data: 'passport_number', name: 'passport_number' },
                      { data: 'reservation', name: 'reservation' },
                      { data: 'status', name: 'status' },
                      {data: 'action', name: 'action', orderable: false},
                   ],
            order: [[0, 'desc']]
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
        //CV code
        $( document ).on( 'click',".add-cv",function( event ) {
            var title = $(this).data('title');
            $('.modal-title').text(title);
            $(".modal-spinner").show();
            $('.result').html("");
            $(".cv-modal").modal({
    backdrop: 'static',
    keyboard: true,
    show: true
});
            $.ajax({
                url: baseUrl+"/office-work/cv/create",
                type:'GET',
                success: function(data) {
                    $(".modal-spinner").hide();
                    $('.result').html(data.view);
                }
            });
        });

        $( document ).on( "submit","#add_cv",function( event ) {
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
            errors = cvValidation(formObj,errors);

            if( errors == 0 ) {
                btnObj.attr("disabled",true);
                btnObj.find("i").addClass('fa-spinner fa-spin');
                $.ajax({
                    url: baseUrl+"/office-work/cv",
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
                            $(".cv-modal").modal('hide');
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

        $( document ).on( 'click',".edit-cv",function( event ) {
            var title = $(this).data('title');
            $('.modal-title').text(title);
            $(".modal-spinner").show();
            $('.result').html("");
            $(".cv-modal").modal({
    backdrop: 'static',
    keyboard: true,
    show: true
});
            var id = $(this).data('id');
            $.ajax({
                url: baseUrl+"/office-work/cv/"+id+"/edit",
                type:'GET',
                success: function(data) {
                    $(".modal-spinner").hide();
                    $('.result').html(data.view);
                }
            });
        });

        $( document ).on( "submit","#updat_cv",function( event ) {
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
            errors = cvValidation(formObj,errors);

            if( errors == 0 ) {
                btnObj.attr("disabled",true);
                btnObj.find("i").addClass('fa-spinner fa-spin');
                $.ajax({
                    url: baseUrl+"/office-work/cv/"+id,
                    type:'POST',
                    data:formdata,
                    dataType:'JSON',
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(data) {
                        if($.isEmptyObject(data.error)){
                            $(".cv-modal").modal('hide');
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

        $( document ).on( "change",".cv_status",function( event ) {
            if ($(this).prop('checked')==true){
                var status = 1;
            } else {
                var status = 2;
            }
            var id  = $(this).data('id');
            var formdata = {'id':id,'status':status};
            if( status ){
                $.ajax({
                    url: baseUrl+"/office-work/cv-status-update",
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

        $( document ).on( "click",".delete-cv",function( event ) {
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
                        url: baseUrl+"/office-work/delete-cv",
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
    function cvValidation(formObj,errors,edit=''){
        //remove error class
        formObj.find('input').removeClass('parsley-error');
        formObj.find('span').removeClass('parsley-error');

        //find flields
        var nameObj = formObj.find('input[name="name"]');
        var name    = nameObj.val();

        var occupationObj = formObj.find('select[name="profession_id"]');
        var occupation    = occupationObj.val();

        var nationalityObj = formObj.find('select[name="nationality_id"]');
        var nationality    = nationalityObj.val();

        var religionObj = formObj.find('select[name="religion_id"]');
        var religion    = religionObj.val();

        var ageObj = formObj.find('input[name="age"]');
        var age = ageObj.val();

        var previousExperienceObj = formObj.find('select[name="previous_experience"]');
        var previousExperience    = previousExperienceObj.val();

        var officeObj = formObj.find('select[name="office_id"]');
        var office = officeObj.val();

        var passportNumberObj = formObj.find('input[name="passport_number"]');
        var passportNumber = passportNumberObj.val();

        var reservationObj = formObj.find('select[name="reservation"]');
        var reservation = reservationObj.val();

        var statusObj = formObj.find('select[name="status"]');
        var status    = statusObj.val();

        //check value
        if( name =="" ) {
            errors = 1;
            nameObj.addClass('parsley-error');
        }
        if( occupation =="" ) {
            errors = 1;
           occupationObj.addClass('parsley-error');
        }
        if( nationality ==""   ) {
            errors = 1;
            nationalityObj.addClass('parsley-error');
        }
        if( religion =="" ) {
            errors = 1;
            religionObj.addClass('parsley-error');
        }
        if( age =="" ) {
            errors = 1;
            ageObj.addClass('parsley-error');
        }
        if( previousExperience =="" ) {
            errors = 1;
            previousExperienceObj.addClass('parsley-error');
        }
        if( office =="" ) {
            errors = 1;
            officeObj.addClass('parsley-error');
        }
        if( passportNumber =="" ) {
            errors = 1;
            passportNumberObj.addClass('parsley-error');
        }
        if( reservation =="" ) {
            errors = 1;
            reservationObj.addClass('parsley-error');
        }
        if( status =="" ) {
            errors = 1;
            statusObj.addClass('parsley-error');
        }
        return errors;
    }

</script>
@endsection