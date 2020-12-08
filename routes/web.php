<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/clear-cache', function () {
    Artisan::call('config:cache');
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    dd("clear cache");
});
Route::get('locale/{locale}', function ($locale) {
    Session::put('locale', $locale);
    return redirect()->back();
});
//login route
Route::get('/login', 'Auth\LoginController@loginShow');
Route::post('/get-login', 'Auth\LoginController@getLogin');
Route::get('logout', 'Auth\LoginController@getLogout');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');

Route::group(['middleware' =>  ['admin','agencystaff']], function() {
		Route::get('/','DashboardController@index');
		Route::get('/dashboard/get-customer-contracts','DashboardController@getCustomerContracts');
		//Nationalities route
		Route::resource('/nationalitie', 'NationalitieController');
		Route::post('/delete-nationality', 'NationalitieController@destroy');
		Route::get('/nationality-status-update', 'NationalitieController@statusUpdate');
		//religion route
		Route::resource('/religion', 'ReligionController');
		Route::post('/delete-religion', 'ReligionController@destroy');
		//religion route
		Route::resource('/profession', 'ProfessionController');
		Route::post('/delete-profession', 'ProfessionController@destroy');
		//contraact-source route
		Route::resource('/contraact-source', 'ContractSourceController');
		Route::post('/delete-contraact-source', 'ContractSourceController@destroy');
		//airport route
		Route::resource('/airport', 'AirportController');
		Route::post('/delete-airport', 'AirportController@destroy');
		//marketers route
		Route::resource('/marketer', 'MarketerController');
		Route::post('/delete-marketer', 'MarketerController@destroy');
		//terms-and-advantage route
		Route::resource('/terms-and-advantage', 'TermsAndAdvantageController');
		Route::post('/delete-terms-and-advantage', 'TermsAndAdvantageController@destroy');
		//Qualifications and experience route
		Route::resource('/qualifications-and-experience', 'QualificationsAndExperienceController');
		Route::post('/delete-qualifications-and-experience', 'QualificationsAndExperienceController@destroy');
		//office route
		Route::resource('/offices', 'OfficesController');
		Route::post('/delete-offices', 'OfficesController@destroy');
		Route::get('/office-status-update', 'OfficesController@statusUpdate');
		//user route
		Route::resource('/users', 'UsersController');
		Route::post('/delete-user', 'UsersController@destroy');
		Route::get('/user-status-update', 'UsersController@statusUpdate');
		//status route
		Route::resource('/status', 'StatusController');
		Route::post('/delete-status', 'StatusController@destroy');
		//country route
		Route::resource('/countrys', 'CountrysController');
		Route::post('/delete-country', 'CountrysController@destroy');
		//activity-log route
		Route::get('/activity-log','ActivityLogController@index');
		//office work  route
		Route::group(['prefix' => 'office-work'], function() {
			//costomer route
			Route::resource('/customer', 'CustomerController');
			Route::post('/delete-customer', 'CustomerController@destroy');
			Route::get('/customer-status-update', 'CustomerController@statusUpdate');
			Route::get('/get-customer-details/{id}', 'CustomerController@getCustomerDetails');
			Route::get('/get-customer-contracts/{id}', 'CustomerController@getCustomerContracts');
			Route::get('/get-customer-contracts', 'DashboardController@getCustomerContracts');
			Route::get('/get-contract-status/{id}', 'CustomerController@getContractStatus');
			Route::post('/customer-details-update/{id}', 'CustomerController@customerDetailsUpdate');
			Route::post('/delete-contract', 'CustomerController@destroy_contract');
			Route::post('/employment-contract/{id}', 'CustomerController@employmentContract');
			Route::get('/contract-list', 'CustomerController@contractList');
			Route::get('/contract-status-update', 'CustomerController@contractStatusUpdate');
			Route::get('/displayed-status-update', 'CustomerController@displayedStatusUpdate');
		});

		Route::group(['prefix' => 'accounting'], function() {
			Route::resource('/cost-center', 'CostCenterController');
			Route::post('/delete-cost-center', 'CostCenterController@destroy');
			//currencies route
			Route::resource('/currency', 'CurrencyController');
			Route::post('/delete-currency', 'CurrencyController@destroy');
		});

		Route::group(['prefix' => 'sales'], function() {
			//invoices route
			Route::get('/invoice/pdf/{id}','InvoiceController@invoicePDF');
			Route::resource('/invoice', 'InvoiceController');
			Route::post('/delete-invoice', 'InvoiceController@destroy');
			Route::get('/invoice-payment-add/{id}', 'InvoiceController@paymentCreate');
			Route::post('/invoice-payment-add/{id}', 'InvoiceController@paymentStore');
			Route::get('/invoice-payment-view/{id}', 'InvoiceController@paymentShow');
			Route::post('/delete-invoice-payment', 'InvoiceController@paymentDestroy');
			Route::get('/invoice-payment-edit/{id}', 'InvoiceController@paymentEdit');
			Route::post('/invoice-payment-update/{id}', 'InvoiceController@paymentUpdate');
			Route::get('/pdf/{id}', 'InvoiceController@viewpf');
		});
		Route::group(['prefix' => 'reports'], function() {
			Route::get('/','ReportController@index');
			Route::get('/cv-report-view','ReportController@cvReportView');
			Route::get('/cv-report','ReportController@cvReport');
			Route::get('/customer-view','ReportController@customerView');
			Route::get('/customer','ReportController@customer');
			Route::get('/contract-view','ReportController@contractView');
			Route::get('/contract','ReportController@contract');
			Route::get('/ticket-view','ReportController@ticketView');
			Route::get('/ticket','ReportController@ticket');
			Route::get('/invoice-view','ReportController@invoiceView');
			Route::get('/invoice','ReportController@invoice');
		});
});

Route::group(['middleware' => ['admin', 'agencystaff']], function () {
    Route::get('/', 'DashboardController@index');
    Route::get('/dashboard/get-customer-contracts', 'DashboardController@getCustomerContracts');
    //Nationalities route
    Route::resource('/nationalitie', 'NationalitieController');
    Route::post('/delete-nationality', 'NationalitieController@destroy');
    Route::get('/nationality-status-update', 'NationalitieController@statusUpdate');
    //religion route
    Route::resource('/religion', 'ReligionController');
    Route::post('/delete-religion', 'ReligionController@destroy');
    //religion route
    Route::resource('/profession', 'ProfessionController');
    Route::post('/delete-profession', 'ProfessionController@destroy');
    //contraact-source route
    Route::resource('/contraact-source', 'ContractSourceController');
    Route::post('/delete-contraact-source', 'ContractSourceController@destroy');
    //airport route
    Route::resource('/airport', 'AirportController');
    Route::post('/delete-airport', 'AirportController@destroy');
    //marketers route
    Route::resource('/marketer', 'MarketerController');
    Route::post('/delete-marketer', 'MarketerController@destroy');
    //terms-and-advantage route
    Route::resource('/terms-and-advantage', 'TermsAndAdvantageController');
    Route::post('/delete-terms-and-advantage', 'TermsAndAdvantageController@destroy');
    //Qualifications and experience route
    Route::resource('/qualifications-and-experience', 'QualificationsAndExperienceController');
    Route::post('/delete-qualifications-and-experience', 'QualificationsAndExperienceController@destroy');
    //office route
    Route::resource('/offices', 'OfficesController');
    Route::post('/delete-offices', 'OfficesController@destroy');
    Route::get('/office-status-update', 'OfficesController@statusUpdate');
    //user route
    Route::resource('/users', 'UsersController');
    Route::post('/delete-user', 'UsersController@destroy');
    Route::get('/user-status-update', 'UsersController@statusUpdate');
    //status route
    Route::resource('/status', 'StatusController');
    Route::post('/delete-status', 'StatusController@destroy');
    //country route
    Route::resource('/countrys', 'CountrysController');
    Route::post('/delete-country', 'CountrysController@destroy');
    //activity-log route
    Route::get('/activity-log', 'ActivityLogController@index');
    //office work  route
    Route::group(['prefix' => 'office-work'], function () {
        //costomer route
        Route::resource('/customer', 'CustomerController');
        Route::post('/delete-customer', 'CustomerController@destroy');
        Route::get('/customer-status-update', 'CustomerController@statusUpdate');
        Route::get('/get-customer-details/{id}', 'CustomerController@getCustomerDetails');
        Route::get('/get-customer-contracts/{id}', 'CustomerController@getCustomerContracts');
        Route::get('/get-contract-status/{id}', 'CustomerController@getContractStatus');
        Route::post('/customer-details-update/{id}', 'CustomerController@customerDetailsUpdate');
        Route::post('/employment-contract/{id}', 'CustomerController@employmentContract');
        Route::get('/contract-list', 'CustomerController@contractList');
        Route::get('/contract-status-update', 'CustomerController@contractStatusUpdate');
        Route::get('/displayed-status-update', 'CustomerController@displayedStatusUpdate');
        Route::get('/contract/select_nationality/{nationality_id}', 'CustomerController@select_nationality');
        Route::get('/contract/select_cv/{cv_id}', 'CustomerController@select_cv');
    });
    Route::group(['prefix' => 'accounting'], function () {
        Route::resource('/cost-center', 'CostCenterController');
        Route::post('/delete-cost-center', 'CostCenterController@destroy');
        //currencies route
        Route::resource('/currency', 'CurrencyController');
        Route::post('/delete-currency', 'CurrencyController@destroy');
    });
    Route::group(['prefix' => 'support'], function () {
        //ticket route
        Route::get('/my-ticket', 'TicketController@myTicket');
        Route::get('/ticket', 'TicketController@index');
        Route::get('/add-ticket', 'TicketController@addTicket');
        Route::post('/add-ticket', 'TicketController@store');
        Route::get('/ticket/status-open-my-ticket', 'TicketController@statusOpenMyTicket');
        Route::get('/ticket/status-close-my-ticket', 'TicketController@statusCloseMyTicket');
        Route::get('/ticket/status-open', 'TicketController@statusOpen');
        Route::get('/ticket/status-close', 'TicketController@statusClose');
        Route::get('/ticket/check-ticket/{id}', 'TicketController@checkTicket');
        Route::get('/ticket/image/{id}', 'TicketController@getData');
        Route::post('/ticket/add-comment/{id}', 'TicketController@addComment');
        Route::get('/ticket/ticket-close', 'TicketController@ticketClose');
    });
    Route::group(['prefix' => 'sales'], function () {
        //invoices route
        Route::get('/invoice/pdf/{id}', 'InvoiceController@invoicePDF');
        Route::resource('/invoice', 'InvoiceController');
        Route::post('/delete-invoice', 'InvoiceController@destroy');
        Route::get('/invoice-payment-add/{id}', 'InvoiceController@paymentCreate');
        Route::post('/invoice-payment-add/{id}', 'InvoiceController@paymentStore');
        Route::get('/invoice-payment-view/{id}', 'InvoiceController@paymentShow');
        Route::post('/delete-invoice-payment', 'InvoiceController@paymentDestroy');
        Route::get('/invoice-payment-edit/{id}', 'InvoiceController@paymentEdit');
        Route::post('/invoice-payment-update/{id}', 'InvoiceController@paymentUpdate');
        Route::get('/pdf/{id}', 'InvoiceController@viewpf');
        Route::get('/customer/contract/{id}', 'InvoiceController@customer_contracts')->name('invoice.customer.contract');

    });
    Route::group(['prefix' => 'reports'], function () {
        Route::get('/', 'ReportController@index');
        Route::get('/cv-report-view', 'ReportController@cvReportView');
        Route::get('/cv-report', 'ReportController@cvReport');
        Route::get('/customer-view', 'ReportController@customerView');
        Route::get('/customer', 'ReportController@customer');
        Route::get('/contract-view', 'ReportController@contractView');
        Route::get('/contract', 'ReportController@contract');
        Route::get('/ticket-view', 'ReportController@ticketView');
        Route::get('/ticket', 'ReportController@ticket');
        Route::get('/invoice-view', 'ReportController@invoiceView');
        Route::get('/invoice', 'ReportController@invoice');

        Route::get('/arrival-report-view', 'ReportController@arrivalReportView');
        Route::get('/arrival-report', 'ReportController@arrivalReport');
    });

    Route::get('/accommodation', 'AccoumodationController@accommodation');

    Route::resource('/role', 'RoleController');
    Route::post('/delete-role', 'RoleController@destroy');

    Route::resource('/worker', 'WorkerController');
    Route::post('/delete-worker', 'WorkerController@destroy');

    Route::resource('/accommodation-type', 'AccommodationTypeController');
    Route::post('/delete-accommodation-type', 'AccommodationTypeController@destroy');

    Route::resource('/visa-type', 'VisaTypeController');
    Route::post('/delete-visa-type', 'VisaTypeController@destroy');

    Route::resource('/rental-request', 'RentalRequestController');
    Route::post('/delete-rental-request', 'RentalRequestController@destroy');

    Route::resource('/rental-request', 'RentalRequestController');
    Route::post('/delete-rental-request', 'RentalRequestController@destroy');

    Route::resource('/transfer-sponsership-request', 'TransferSponsershipRequestController');
    Route::post('/delete-transfer-sponsership-request', 'TransferSponsershipRequestController@destroy');

    Route::resource('/relay', 'RelayController');
    Route::post('/delete-relay', 'RelayController@destroy');
});

Route::group(['middleware' => ['admin']], function () {

    Route::group(['prefix' => 'office-work'], function () {
        //cv route
        Route::resource('/cv', 'CvController');
        Route::post('/delete-cv', 'CvController@destroy');
        Route::get('/cv-status-update', 'CvController@statusUpdate');
    });

    Route::group(['prefix' => 'support'], function() {
        //ticket route
        Route::get('/my-ticket','TicketController@myTicket');
        Route::get('/ticket','TicketController@index');
        Route::get('/add-ticket','TicketController@addTicket');
        Route::post('/add-ticket','TicketController@store');
        Route::get('/ticket/status-open-my-ticket','TicketController@statusOpenMyTicket');
        Route::get('/ticket/status-close-my-ticket','TicketController@statusCloseMyTicket');
        Route::get('/ticket/status-open','TicketController@statusOpen');
        Route::get('/ticket/status-close','TicketController@statusClose');
        Route::get('/ticket/check-ticket/{id}','TicketController@checkTicket');
        Route::get('/ticket/image/{id}','TicketController@getData');
        Route::post('/ticket/add-comment/{id}','TicketController@addComment');
        Route::get('/ticket/ticket-close','TicketController@ticketClose');
    });

});