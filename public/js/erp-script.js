$( document ).ready( function()  {
    var baseUrl = $("#baseUrl").data('url');
    var token = $("#token").attr('content');

    $( document ).on( "submit","#login_form",function( event ) {
        event.preventDefault();
        $(".print-error-msg").css('display','none');
        $(".print-success-msg").css('display','none');
        //define variation
        var errors = 0;
        //get fome object
        var formObj = $(this);
        //remove error class
        formObj.find('input').removeClass('parsley-error');
        //get button object
        var btnObj   = formObj.find('button[type="submit"]');
        var formdata = formObj.serialize();
        //find flields
        var userNameObj = formObj.find('input[name="username"]');
        var userName    = userNameObj.val();
        var passwordObj = formObj.find('input[name="password"]');
        var password    = passwordObj.val();
        var formdata    = formObj.serialize();
        //check value
        if( userName =="" ) {
            errors = 1;
            userNameObj.addClass('parsley-error');
        }
        if( password =="" ) {
            errors = 1;
            passwordObj.addClass('parsley-error');
        }

        if( errors == 0 ) {
            btnObj.attr("disabled",true);
            btnObj.find("i").addClass('fa-spinner fa-spin');
            $.ajax({
                url: baseUrl+"/get-login",
                type:'POST',
                data:formdata,
                success: function(data) {
                    if($.isEmptyObject(data.error)){
                        printSuccessMsg(data.success);
                         formObj[0].reset();
                        setTimeout(function(){
                         window.location = baseUrl+'/'
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

    $( document ).on( "submit","#reset_password_form",function( event ) {
        event.preventDefault();
        $(".print-error-msg").css('display','none');
        $(".print-success-msg").css('display','none');
        //define variation
        var errors = 0;
        //get fome object
        var formObj = $(this);
        //remove error class
        formObj.find('input').removeClass('parsley-error');
        //get button object
        var btnObj   = formObj.find('button[type="submit"]');
        var formdata = formObj.serialize();
        //find flields
        var emailObj = formObj.find('input[name="email"]');
        var email    = emailObj.val();
        var formdata = formObj.serialize();
        //check value
        if( email =="" ) {
            errors = 1;
            emailObj.addClass('parsley-error');
        }

        if( errors == 0 ) {
            btnObj.attr("disabled",true);
            btnObj.find("i").addClass('fa-spinner fa-spin');
            $.ajax({
                url: baseUrl+"/password/email",
                type:'POST',
                data:formdata,
                success: function(data) {
                    if($.isEmptyObject(data.error)){
                         formObj[0].reset();
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

    $( document ).on( "submit","#reset_password",function( event ) {
        event.preventDefault();
        $(".print-error-msg").css('display','none');
        $(".print-success-msg").css('display','none');
        //define variation
        var errors = 0;
        //get fome object
        var formObj = $(this);
        //remove error class
        formObj.find('input').removeClass('parsley-error');
        //get button object
        var btnObj   = formObj.find('button[type="submit"]');
        var formdata = formObj.serialize();
        //find flields
        var emailObj = formObj.find('input[name="email"]');
        var email    = emailObj.val();

        var passwordObj = formObj.find('input[name="password"]');
        var password    = passwordObj.val();

        var passwordConfirmationObj = formObj.find('input[name="password_confirmation"]');
        var passwordConfirmation    = passwordConfirmationObj.val();
        var formdata = formObj.serialize();
        //check value
        if( email =="" ) {
            errors = 1;
            emailObj.addClass('parsley-error');
        }

        if( password =="" ) {
            errors = 1;
            passwordObj.addClass('parsley-error');
        }

        if( passwordConfirmation =="" ) {
            errors = 1;
            passwordConfirmationObj.addClass('parsley-error');
        }

        if( errors == 0 ) {
            btnObj.attr("disabled",true);
            btnObj.find("i").addClass('fa-spinner fa-spin');
            $.ajax({
                url: baseUrl+"/password/reset",
                type:'POST',
                data:formdata,
                success: function(data) {
                    if($.isEmptyObject(data.error)){
                        printSuccessMsg(data.success);
                        formObj[0].reset();
                        setTimeout(function(){
                            window.location = baseUrl+'/'
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

    //cost center code
    $( document ).on( 'click',".add-cost-center",function( event ) {
        var title = $(this).data('title');
        $('.modal-title').text(title);
        $(".modal-spinner").show();
        $('.result').html("");
        $(".cost-center-modal").modal('show');
        $.ajax({
            url: baseUrl+"/accounting/cost-center/create",
            type:'GET',
            success: function(data) {
                $(".modal-spinner").hide();
                $('.result').html(data.view);
            }
        });
    });

    $( document ).on( "submit","#add_cost_center",function( event ) {
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

        errors = costCenterValidation(formObj,errors);

        if( errors == 0 ) {
            btnObj.attr("disabled",true);
            btnObj.find("i").addClass('fa-spinner fa-spin');
            $.ajax({
                url: baseUrl+"/accounting/cost-center",
                type:'POST',
                data:formdata,
                success: function(data) {
                    if($.isEmptyObject(data.error)){
                        var oTable = $('#datatable').dataTable();
                        oTable.fnDraw(false);
                        formObj[0].reset();
                        $(".cost-center-modal").modal('hide');
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

    $( document ).on( 'click',".edit-cost-center",function( event ) {
        var title = $(this).data('title');
        $('.modal-title').text(title);
        $(".modal-spinner").show();
        $('.result').html("");
        $(".cost-center-modal").modal('show');
        var id = $(this).data('id');
        $.ajax({
            url: baseUrl+"/accounting/cost-center/"+id+"/edit",
            type:'GET',
            success: function(data) {
                $(".modal-spinner").hide();
                $('.result').html(data.view);
            }
        });
    });

    $( document ).on( "submit","#update_cost_center",function( event ) {
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
        errors = costCenterValidation(formObj,errors);

        if( errors == 0 ) {
            btnObj.attr("disabled",true);
            btnObj.find("i").addClass('fa-spinner fa-spin');
            $.ajax({
                url: baseUrl+"/accounting/cost-center/"+id,
                type:'POST',
                data:formdata,
                success: function(data) {
                    if($.isEmptyObject(data.error)){
                        $(".cost-center-modal").modal('hide');
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

    $( document ).on( "click",".delete-cost-center",function( event ) {
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
                    url: baseUrl+"/accounting/delete-cost-center",
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

    //currencies code
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

    //Airport code
    jQuery( document ).on( 'click',".add-airport",function( event ) {
        var title = jQuery(this).data('title');
        jQuery('.modal-title').text(title);
        jQuery(".modal-spinner").show();
        jQuery('.result').html("");
        jQuery(".airport-modal").modal('show');
        $.ajax({
            url: baseUrl+"/airport/create",
            type:'GET',
            success: function(data) {
                $(".modal-spinner").hide();
                $('.result').html(data.view);
            }
        });
    });

    $( document ).on( "submit","#add_airport",function( event ) {
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

        errors = airportValidation(formObj,errors);

        if( errors == 0 ) {
            btnObj.attr("disabled",true);
            btnObj.find("i").addClass('fa-spinner fa-spin');
            $.ajax({
                url: baseUrl+"/airport",
                type:'POST',
                data:formdata,
                success: function(data) {
                    if($.isEmptyObject(data.error)){
                        var oTable = $('#datatable').dataTable();
                        oTable.fnDraw(false);
                        formObj[0].reset();
                        $(".airport-modal").modal('hide');
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

    $( document ).on( 'click',".edit-airport",function( event ) {
        var title = $(this).data('title');
        $('.modal-title').text(title);
        $(".modal-spinner").show();
        $('.result').html("");
        $(".airport-modal").modal('show');
        var id = $(this).data('id');
        $.ajax({
            url: baseUrl+"/airport/"+id+"/edit",
            type:'GET',
            success: function(data) {
                $(".modal-spinner").hide();
                $('.result').html(data.view);
            }
        });
    });

    $( document ).on( "submit","#update_airport",function( event ) {
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
        errors = airportValidation(formObj,errors);

        if( errors == 0 ) {
            btnObj.attr("disabled",true);
            btnObj.find("i").addClass('fa-spinner fa-spin');
            $.ajax({
                url: baseUrl+"/airport/"+id,
                type:'POST',
                data:formdata,
                success: function(data) {
                    if($.isEmptyObject(data.error)){
                        $(".airport-modal").modal('hide');
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

    $( document ).on( "click",".delete-airport",function( event ) {
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
                    url: baseUrl+"/delete-airport",
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