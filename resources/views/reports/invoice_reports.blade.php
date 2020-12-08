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
                            <label>{{ __('page.status') }}</label>
                            <select class="form-control" name="status" id="invoice_status">
                                <option value="">{{ __('page.select_status') }}</option>
                                <option value="1">{{ __('page.canceled') }}</option>
                                <option value="2">{{ __('page.overdue') }}</option>
                                <option value="3">{{ __('page.paid') }}</option>
                                <option value="4">{{ __('page.pending') }}</option>
                                <option value="5">{{ __('page.partially_paid') }}</option>
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
                        <th width="15%"> {{ __('page.date') }}</th>
                        <th width="15%"> {{ __('page.customer') }}</th>
                        <th width="15%"> {{ __('page.total') }}</th>
                        <th width="15%"> {{ __('page.paid') }}</th>
                        <th width="15%"> {{ __('page.balance') }}</th>
                        <th width="15%"> {{ __('page.due_date') }}</th>
                        <th width="10%"> {{ __('page.status') }}</th>
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
             url: baseUrl+"/reports/invoice",
              type: 'GET',
              data: function (d) {
                    d.status = $('#invoice_status').val();
                    d.startdate = $('#startdate').val();
                    d.enddate = $('#enddate').val();
                },
             },
            columns: [
                { data: 'date', name: 'date' },
                { data: 'customer_name', name: 'customer_name' },
                { data: 'grand_total', name: 'grand_total' },
                { data: 'paid', name: 'paid' },
                { data: 'balance', name: 'balance' },
                { data: 'due_date', name: 'due_date' },
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
            btnObj.attr("disabled",true);
            btnObj.find("i.spinner").addClass('fa-spinner fa-spin');
            var oTable = $('#datatable').dataTable();
            oTable.fnDraw(false);
            btnObj.attr("disabled",false);
            btnObj.find("i.spinner").removeClass('fa-spinner fa-spin');
        });

        $( document ).on( "change",".contract_status",function( event ) {
            var thisObj = $(this);
            if ($(this).prop('checked')==true){
                var status = 1;
            } else {
                var status = 2;
            }
            var id  = $(this).data('id');
            var formdata = {'id':id,'status':status};
            if( status ){
                $.ajax({
                    url: baseUrl+"/office-work/contract-status-update",
                    type:'GET',
                    data:formdata,
                    success: function(data) {
                        if($.isEmptyObject(data.error)){
                            printSuccessMsg(data.success);
                        } else {
                            thisObj.prop("checked", false);
                            singleErrorMsg(data.error);
                        }
                    }
                });
            }
        });
    });
</script>