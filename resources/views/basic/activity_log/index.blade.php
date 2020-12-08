@extends('layouts.app')
@section('title') Activity Logs @endsection
@section('content') 
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h4 class="page-title m-0">{{ __('page.activity_logs') }}</h4>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card m-b-30">
            @include('includes.message')
            <div class="card-body">
                <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                    <tr>
                        <th width="10%">{{ __('page.no') }}</th>
                        <th width="20%">{{ __('page.user_name') }}</th>
                        <th width="50%">{{ __('page.activity_data') }}</th>
                        <th width="20%">{{ __('page.model_number') }}</th>
                        <th width="20%">{{ __('page.identifier') }}</th>
                        <th width="20%">{{ __('page.date') }}</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->
@endsection
@section('js')
<script type="text/javascript">
    $( document ).ready( function(){
         $('#datatable').DataTable({
                "language": {
                    "url": lang
                },
             processing: true,
             serverSide: true,
             ordering: false,
             ajax: {
              url: "{{ url('/activity-log') }}" ,
              type: 'GET',
             },
             columns: [
                     {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                      { data: 'username', name: 'username' },
                      { data: 'activity_log_key', name: 'activity_log_key' },
                      {data: 'model_id', name: 'model_id'},
                      {data: 'identifier', name: 'identifier'},
                      {data: 'created_at', name: 'created_at', orderable: false},
                   ],
            order: [[0, 'desc']]
        });
    });
</script> 
@endsection