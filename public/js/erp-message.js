function printErrorMsg (msg) {
    $(".print-error-msg").find("ul").html('');
    $(".print-error-msg").css('display','block');
    $.each( msg, function( key, value ) {
        $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
    });
}

function printSuccessMsg (msg) {
    $(".print-success-msg").css('display','block');
    $(".print-success-msg").html('');
    $(".print-success-msg").append('<div class="alert alert-success alert-dismissible fade show  " role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"<span aria-hidden="true"></span></button><span class="success-msg">'+msg+'</span></div>');
}

function singleErrorMsg (msg) {
    $(".print-singlerror-msg").css('display','block');
    $(".print-singlerror-msg").html('');
    $(".print-singlerror-msg").append('<div class="alert alert-danger alert-dismissible fade show mb-0" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> <span class="error-msg">'+msg+'</span></div>');
}