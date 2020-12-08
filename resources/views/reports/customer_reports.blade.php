<div class="row">
    <div class="col-12">
        <div class="card m-b-30">
            @include('includes.message')
            <form method="GET" autocomplete="off" class="mt-3 pl-md-4 pr-md-4" id="search">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>{{ __('page.from_date') }}</label>
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="yyyy/mm/dd" id="startdate" name="startdate" value="" >
                                <div class="input-group-append bg-custom b-0"><span class="input-group-text"><i class="mdi mdi-calendar"></i></span></div>
                            </div><!-- input-group -->
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>{{ __('page.to_date') }}</label>
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="yyyy/mm/dd" id="enddate" name="enddate" value="" >
                                <div class="input-group-append bg-custom b-0"><span class="input-group-text"><i class="mdi mdi-calendar"></i></span></div>
                            </div><!-- input-group -->
                        </div>
                    </div>
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
                        <th> {{ __('page.place_of_issue') }}</th>
                        <th> {{ __('page.nationality') }}</th>
                        <th> {{ __('page.mobile_number') }}</th>
                        <th> {{ __('page.home_number') }}</th>
                        <th> {{ __('page.title') }}</th>
                        <th> {{ __('page.date_of_birth') }}</th>
                        <th> {{ __('page.status') }}</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->
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
             url: baseUrl+"/reports/customer",
              type: 'GET',
              data: function (d) {
                    d.nationality_id = $('#nationality_id').val();
                    d.startdate = $('#startdate').val();
                    d.enddate = $('#enddate').val();
                },
             },
            dom: 'Bfrtip',
            buttons: [ 'excel', 'print'],
             columns: [
                  { data: 'name', name: 'name' },
                  { data: 'id_number', name: 'id_number' },
                  { data: 'place_of_issue', name: 'place_of_issue' },
                  { data: 'nationality', name: 'nationality' },
                  { data: 'mobile_number', name: 'mobile_number' },
                  { data: 'home_number', name: 'home_number' },
                  { data: 'title', name: 'title' },
                  { data: 'date_of_birth', name: 'date_of_birth' },
                  { data: 'status', name: 'status' },
               ],
            order: [[0, 'desc']]
        });
        $("#startdate").hijriDatePicker({
            hijri : true,
            format: "DD/MM/YYYY",
            hijriFormat: 'iYYYY/iMM/iDD',
        });
        $("#enddate").hijriDatePicker({
            hijri : true,
            format: "DD/MM/YYYY",
            hijriFormat: 'iYYYY/iMM/iDD',
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
    });
</script>