<div class="card mb-0">
    @include('includes.form_error')
    <div class="card-body pb-0">
        <form method="POST" id="add_invoice_payment" autocomplete="off">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>{{ __('page.date') }}</label>
                         <div class="input-group">
                            <input type="text" class="form-control" placeholder="yyyy/mm/dd" id="date" name="date" value="" >
                            <div class="input-group-append bg-custom b-0"><span class="input-group-text"><i class="mdi mdi-calendar"></i></span></div>
                        </div><!-- input-group -->
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>{{ __('page.amount_paid') }}</label>
                        <input type="number" class="form-control" name="amount_paid" value="" min="1" max="{{ getPaidAmount($Invoice->id) }}">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>{{ __('page.notes') }}</label>
                       <textarea class="form-control" rows="5" id="notes" name="notes"></textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group mb-0">
                        <button type="submit" class="btn btn-primary"  data-id="{{ base64_encode(\Carbon\Carbon::now()->format('MY').'-'.base64_encode($Invoice->id)) }}">{{ __('page.add_payments') }} <i class="fas "></i></button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<script type="text/javascript">
    $( document ).ready( function(){
        $("#date").hijriDatePicker({
            hijri : true,
            format: "DD/MM/YYYY",
            hijriFormat: 'iYYYY/iMM/iDD',
        });
    });
</script>
