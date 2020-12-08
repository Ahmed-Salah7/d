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
                        <th> {{ __('page.occupation') }}</th>
                        <th> {{ __('page.nationality') }}</th>
                        <th> {{ __('page.religion') }}</th>
                        <th> {{ __('page.age') }}</th>
                        <th> {{ __('page.previous_experience') }}</th>
                        <th> {{ __('page.office') }}</th>
                        <th> {{ __('page.passport_number') }}</th>
                        <th> {{ __('page.reservation') }}</th>
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
             url: baseUrl+"/reports/cv-report",
              type: 'GET',
              data: function (d) {
                    d.nationality_id = $('#nationality_id').val();
                    d.startdate = $('#startdate').val();
                    d.enddate = $('#enddate').val();
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