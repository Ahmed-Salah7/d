@extends('layouts.app')
@section('title') Reports @endsection
@section('content')
    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h4 class="page-title m-0">{{ __('page.contract_report') }}</h4>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group col-md-6 float-right">
                            <label for="sel1">{{ __('page.select_report') }}:</label>
                            <select class="form-control" id="select_report">
                                <option value="">{{ __('page.select_report') }}</option>
                                <option value="cv_report">{{ __('page.cv_report') }}</option>
                                <option value="customer_report">{{ __('page.customer_report') }}</option>
                                <option value="contract_report"
                                        selected="selected">{{ __('page.contract_report') }}</option>
                                <option value="ticket_report">{{ __('page.ticket_report') }}</option>
                                <option value="invoice_report">{{ __('page.invoice_report') }}</option>
                                <option value="arrival_report">{{ __('page.arrival_report') }}</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="all-report">
        <!-- end page title end breadcrumb -->
    </div>
    <div class="spinner">
        <div class="d-flex justify-content-center mt-5 mb-5">
            <div class="spinner-border" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script type="text/javascript">
        $(document).ready(function () {
            var baseUrl = $("#baseUrl").data('url');
            var token = $("#token").attr('content');
            $.ajax({
                url: baseUrl + "/reports/contract-view",
                type: 'GET',
                success: function (data) {
                    $(".spinner").hide();
                    $('.all-report').html(data.view);
                    $('.page-title').text(data.Title);
                }
            });
            $(document).on('change', '#select_report', function () {
                $(".spinner").show();
                $('.all-report').html("");
                var report = $(this).val();
                if (report == 'cv_report' || report == "") {
                    $.ajax({
                        url: baseUrl + "/reports/cv-report-view",
                        type: 'GET',
                        success: function (data) {
                            $(".spinner").hide();
                            $('.all-report').html(data.view);
                            $('.page-title').text(data.Title);
                        }
                    });
                } else if (report == 'customer_report') {
                    $.ajax({
                        url: baseUrl + "/reports/customer-view",
                        type: 'GET',
                        success: function (data) {
                            $(".spinner").hide();
                            $('.all-report').html(data.view);
                            $('.page-title').text(data.Title);
                        }
                    });
                } else if (report == 'contract_report') {
                    $.ajax({
                        url: baseUrl + "/reports/contract-view",
                        type: 'GET',
                        success: function (data) {
                            $(".spinner").hide();
                            $('.all-report').html(data.view);
                            $('.page-title').text(data.Title);
                        }
                    });
                } else if (report == 'ticket_report') {
                    $.ajax({
                        url: baseUrl + "/reports/ticket-view",
                        type: 'GET',
                        success: function (data) {
                            $(".spinner").hide();
                            $('.all-report').html(data.view);
                            $('.page-title').text(data.Title);
                        }
                    });
                } else if (report == 'invoice_report') {
                    $.ajax({
                        url: baseUrl + "/reports/invoice-view",
                        type: 'GET',
                        success: function (data) {
                            $(".spinner").hide();
                            $('.all-report').html(data.view);
                            $('.page-title').text(data.Title);
                        }
                    });
                } else if (report == 'arrival_report') {
                    $.ajax({
                        url: baseUrl + "/reports/arrival-report-view",
                        type: 'GET',
                        success: function (data) {
                            $(".spinner").hide();
                            $('.all-report').html(data.view);
                            $('.page-title').text(data.Title);
                        }
                    });
                }
            });
        });
    </script>
@endsection