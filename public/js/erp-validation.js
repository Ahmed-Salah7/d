 function costCenterValidation(formObj,errors){
    //remove error class
    formObj.find('input').removeClass('parsley-error');
    formObj.find('span').removeClass('parsley-error');
    
    //find flields 
    var centerNameObj = formObj.find('input[name="center_name"]');
    var centerName    = centerNameObj.val();
    
    var centerNameEnglishObj = formObj.find('input[name="center_name_english"]');
    var centerNameEnglish   = centerNameEnglishObj.val();
    
    //check value 
    if( centerName =="" ) {
        errors = 1;
        centerNameObj.addClass('parsley-error');
    }
    if( centerNameEnglish =="" ) {
        errors = 1;
        centerNameEnglishObj.addClass('parsley-error');
    }
    return errors;
}

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

function airportValidation(formObj,errors){
    //remove error class
    formObj.find('input').removeClass('parsley-error');
    formObj.find('span').removeClass('parsley-error');
    
    //find flields 
    var airportObj = formObj.find('input[name="airport"]');
    var airport    = airportObj.val();
    
    var airportEnglishObj = formObj.find('input[name="airport_english"]');
    var airportEnglish   = airportEnglishObj.val();
    
    //check value 
    if( airport =="" ) {
        errors = 1;
        airportObj.addClass('parsley-error');
    }
    if( airportEnglish =="" ) {
        errors = 1;
        airportEnglishObj.addClass('parsley-error');
    }
    return errors;
}