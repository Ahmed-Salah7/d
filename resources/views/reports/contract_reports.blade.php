<div class="row">
    <div class="col-12">
        <div class="card m-b-30">
            @include('includes.message')
            <form method="GET" autocomplete="off" class="mt-3 pl-md-4 pr-md-4" id="search">
                <div class="row">
                     <div class="col-md-2">
                        <div class="form-group">
                            <label>{{ __('page.contract_no') }}</label>
                            <input type="text" class="form-control" id="contract_no" name="contract_no" value="" >
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>{{ __('page.from_date') }}</label>
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="yyyy/mm/dd" id="startdate" name="startdate" value="" >
                                <div class="input-group-append bg-custom b-0"><span class="input-group-text"><i class="mdi mdi-calendar"></i></span></div>
                            </div><!-- input-group -->
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>{{ __('page.to_date') }}</label>
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="yyyy/mm/dd" id="enddate" name="enddate" value="" >
                                <div class="input-group-append bg-custom b-0"><span class="input-group-text"><i class="mdi mdi-calendar"></i></span></div>
                            </div><!-- input-group -->
                        </div>
                    </div>
                    <div class="col-md-2">
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

                    <div class="col-md-2">
                        <div class="form-group">
                            <label>{{ __('page.office') }}</label>
                            <select class="form-control" name="office_id" id="office_id">
                                <option value="">{{ __('page.select_office') }}</option>
                                @if( count(\App\Offices::get()) > 0 )
                                    @foreach( \App\Offices::get() as $Office )
                                        <option value="{{ $Office->id }}">{{ $Office->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
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
                        <th width="10%"> {{ __('page.customer_name') }}</th>
                        <th width="5%"> {{ __('page.contract_no') }}</th>
                        <th width="5%"> {{ __('page.contract_date') }}</th>
                        <th width="10%"> {{ __('page.nationality') }}</th>
                        <th width="10%"> {{ __('page.visa_number') }}</th>
                        <th width="10%"> {{ __('page.id_card_number') }}</th>
                        <th width="5%"> {{ __('page.candidate') }}</th>
{{--                        <th width="10%"> {{ __('page.outside_office') }}</th>--}}
                        <th width="10%"> {{ __('page.external') }}</th>
                        <th width="10%"> {{ __('page.source') }}</th>
                        <th width="10%"> {{ __('page.local_office') }}</th>
                        <th width="10%"> {{ __('page.outside_office') }}</th>
                        <th width="10%"> {{ __('page.approve') }}</th>
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
             url: baseUrl+"/reports/contract",
              type: 'GET',
              data: function (d) {
                    d.nationality_id = $('#nationality_id').val();
                    d.office_id = $('#office_id').val();
                    d.startdate = $('#startdate').val();
                    d.enddate = $('#enddate').val();
                    d.contract_no = $('#contract_no').val();
                },
             },
             dom: 'Bft',
             buttons: [ 'excel',
                 'copy',
                 {
                     extend: 'print',
                     exportOptions: {
                         columns: [ 0, 1, 2, 3, 4, 5, 6,7,8,9,10 ] //Your Column value those you want
                     },
                    orientation : 'landscape',

                 },

             ],
            columns: [
                { data: 'customer_name', name: 'customer_name' },
                { data: 'contract_number', name: 'contract_number' },
                { data: 'date_of_contract', name: 'date_of_contract' },
                { data: 'nationality', name: 'nationality' },
                { data: 'visa_number', name: 'visa_number' },
                { data: 'id_card_number', name: 'id_card_number' },
                { data: 'cv_name', name: 'cv_name' },
                // { data: 'outside_office', name: 'outside_office' },
                { data: 'outside', name: 'outside'},
                { data: 'source', name: 'source'},
                { data: 'local_office', name: 'local_office' },
                { data: 'outside_office', name: 'outside_office' },
                {data: 'status', name: 'status'},
           ],
            order: [[0, 'desc']]
        });
        $('#startdate').hijriDatePicker({
            hijri : true,
            format: "DD/MM/YYYY",
            hijriFormat: 'iYYYY/iMM/iDD',
        });
        $('#enddate').hijriDatePicker({
            hijri : true,
            format: "DD-MM-YYYY",
            hijriFormat: 'iYYYY/iMM/iDD',
        });
        $( document ).on( "submit","#search",function( event ) {
            event.preventDefault();
            var formObj = $(this);
            var btnObj   = formObj.find('button[type="submit"]');
            btnObj.attr("disabled",true);
            btnObj.find("i.spinner").addClass('fa-spinner fa-spin');
            var oTable = $('#datatable').dataTable();
            oTable.fnDraw(false);
            btnObj.attr("disabled",false);
            btnObj.find("i.spinner").removeClass('fa-spinner fa-spin');
        });
    });
</script>


