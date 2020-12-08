<div class="card mb-0">
    @include('includes.form_error')
    <div class="card-body pb-0">
        <form method="POST" id="update_invoice" autocomplete="off">
            @method('PATCH')
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{ __('page.date') }}</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="yyyy/mm/dd" id="date"
                                           name="date"
                                           value="{{ (isset($Invoice->date )) ? Carbon\Carbon::parse($Invoice->date)->format('Y/m/d') : '' }}">
                                    <div class="input-group-append bg-custom b-0"><span class="input-group-text"><i
                                                    class="mdi mdi-calendar"></i></span></div>
                                </div><!-- input-group -->
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{ __('page.time') }}</label>
                                <div class="input-group">
                                    <input type="time" class="form-control text-left" name="time" min="00:00"
                                           max="24:59"
                                           value="{{ (isset($Invoice->date )) ? Carbon\Carbon::parse($Invoice->date)->format('H:i') : '' }}">
                                    <div class="input-group-append bg-custom b-0"><span class="input-group-text"><i
                                                    class="mdi mdi-clock-outline"></i></span></div>
                                </div><!-- input-group -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>{{ __('page.customer') }}</label>
                        <select class="form-control" name="customer_id" id="customer">
                            <option value="">{{ __('page.select_customer') }}</option>
                            @if( count($Customers) > 0 )
                                @foreach( $Customers as $Customer )
                                    <option value="{{ $Customer->id }}" @if( isset($Invoice->customer_id) && $Invoice->customer_id == $Customer->id ) {{ 'selected'}} @endif>{{ $Customer->name }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>


                <div class="col-md-3">
                    <div class="form-group">
                        <label>{{ __('page.contract') }}</label>
                        <select class="form-control" name="contract_id" id="contract">
                            <option value="">{{ __('page.select_contract') }}</option>
                            @if( count($contracts) > 0 )
                                @foreach( $contracts as $contract )
                                    <option value="{{ $contract->id }}"
                                    @if( isset($Invoice->contract_id) && $Invoice->contract_id == $contract->id ) {{ 'selected'}} @endif>
                                        {{ $contract->contract_number }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label>{{ __('page.due_date') }}</label>
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="mm/dd/yyyy" id="due_date"
                                   name="due_date"
                                   value="{{ (isset($Invoice->due_date )) ? Carbon\Carbon::parse($Invoice->due_date)->format('Y/m/d') : '' }}">
                            <div class="input-group-append bg-custom b-0"><span class="input-group-text"><i
                                            class="mdi mdi-calendar"></i></span></div>
                        </div><!-- input-group -->
                    </div>
                </div>
{{--                <div class="col-md-3">--}}
{{--                    <div class="form-group">--}}
{{--                        <label>{{ __('page.shipping') }}</label>--}}
{{--                        <input type="text" class="form-control"--}}
{{--                               value="{{ (isset($Invoice->shipped_to )) ? $Invoice->shipped_to : '' }}" name="shipping"--}}
{{--                               id="shipping">--}}
{{--                    </div>--}}
{{--                </div>--}}
                <div class="col-md-4">
                    <div class="form-group">
                        <label>{{ __('page.order_discount') }}</label>
                        <input type="number" class="form-control"
                               value="{{ (isset($Invoice->discount )) ? $Invoice->discount : '' }}" name="discount"
                               id="order_discount" min="0">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>{{ __('page.status') }}</label>
                        <select class="form-control" name="status" id="status">
                            <option value="">{{ __('page.select_status') }}</option>
                            <option value="1" @if( isset($Invoice->status) && $Invoice->status == 1 ) {{ 'selected'}} @endif>{{ __('page.canceled') }}</option>
                            <option value="2" @if( isset($Invoice->status) && $Invoice->status == 2 ) {{ 'selected'}} @endif>{{ __('page.overdue') }}</option>
                            <option value="3" @if( isset($Invoice->status) && $Invoice->status == 3 ) {{ 'selected'}} @endif>{{ __('page.paid') }}</option>
                            <option value="4" @if( isset($Invoice->status) && $Invoice->status == 4 ) {{ 'selected'}} @endif>{{ __('page.pending') }}</option>
                        </select>
                    </div>
                </div>
{{--                <div class="col-md-3">--}}
{{--                    <div class="form-group">--}}
{{--                        <label>{{ __('page.contract') }}</label>--}}
{{--                        <select class="form-control" name="contract_id" id="contract">--}}
{{--                            <option value="">{{ __('page.contract') }}</option>--}}
{{--                            @foreach($EmploymentContracts as $EmploymentContract)--}}
{{--                                <option {{$Invoice->contract_id == $EmploymentContract->id ? "selected" : ''}} value="{{$EmploymentContract->id}}">{{ $EmploymentContract->contract_number }}</option>--}}
{{--                            @endforeach--}}
{{--                        </select>--}}
{{--                    </div>--}}
{{--                </div>--}}
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive erp-table">
                        <table class="table table-bordered table-hover" id="tab_logic">
                            <thead>
                            <tr>
                                <th class="text-left" widht="5%"> #</th>
                                <th class="text-center" width="35%">{{ __('page.product') }}</th>
                                <th class="text-center" width="20%">{{ __('page.qty') }}</th>
                                <th class="text-center" width="20%">{{ __('page.price') }}</th>
                                <th class="text-center" width="20%">{{ __('page.total') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php $total = 0; @endphp
                            @if( count($InvoiceItems) > 0 )
                                @foreach( $InvoiceItems as $InvoiceItem )
                                    @php $total += $InvoiceItem->unit_price * $InvoiceItem->quantity; @endphp
                                    <tr id='addr{{ $loop->index }}'>
                                        <td>{{ $loop->iteration }}</td>
                                        <td><input type="text" name='product[]' id="product"
                                                   placeholder="{{ __('page.enter_product') }}" class="form-control"
                                                   value="{{ $InvoiceItem->item_descriptions }}"/></td>
                                        <td><input type="number" name='qty[]' id="qty"
                                                   placeholder="{{ __('page.enter_qty') }}" class="form-control qty"
                                                   step="0" min="0" value="{{ $InvoiceItem->quantity }}"/></td>
                                        <td><input type="number" name='price[]' id="price"
                                                   placeholder="{{ __('page.enter_price') }}" class="form-control price"
                                                   step="0.00" min="0" value="{{ $InvoiceItem->unit_price }}"/></td>
                                        <td>
                                            <span class="text-box total">{{ number_format($InvoiceItem->quantity *  $InvoiceItem->unit_price,2) }}</span>
                                        </td>
                                    </tr>
                                @endforeach
                                <tr id='addr{{ count($InvoiceItems) }}'></tr>
                            @else
                                <tr id='addr0'>
                                    <td>1</td>
                                    <td><input type="text" name='product[]' id="product"
                                               placeholder="{{ __('page.enter_product') }}" class="form-control"/></td>
                                    <td><input type="number" name='qty[]' id="qty"
                                               placeholder="{{ __('page.enter_qty') }}" class="form-control qty"
                                               step="0" min="0"/></td>
                                    <td><input type="number" name='price[]' id="price"
                                               placeholder="{{ __('page.enter_price') }}" class="form-control price"
                                               step="0.00" min="0"/></td>
                                    <td><span class="text-box total"></span></td>
                                </tr>
                                <tr id='addr1'></tr>
                            @endif
                            <tr class="sub_total">
                                <th colspan="3">
                                    <button type="button" class="btn btn-primary btn-sm" id="add_row"><i
                                                class="fas fa-plus"></i></button>
                                    <button type="button" class="btn btn-danger btn-sm" id='delete_row'><i
                                                class="fas fa-minus"></i></button>
                                </th>
                                <th>{{ __('page.total') }}:</th>
                                <th><span id="sub_total">{{ number_format($total,2)}}</span></th>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row mt-1">
                <div class="col-md-12">
                    <div class="table-responsive erp-table">
                        <table class="table table-bordered table-hover" id="tab_logic_total">
                            <tbody>
                            <tr>
                                <th class="text-center" width="25%"> {{ __('page.order_discount') }} </th>
                                <th class="text-center" width="25%"> {{ __('page.order_tax') }} </th>
                                <th class="text-center" width="25%"> {{ __('page.tax_amount') }} </th>
                                <th class="text-center" width="25%"> {{ __('page.grand_total') }} </th>
                            </tr>
                            <tr>
                                <td class="text-center"><span class="text-box"
                                                              id="discount">{{ $Invoice->discount  }}</span></td>
                                <td class="text-center">
                                    <div class="input-group mb-2 mb-sm-0">
                                        <input type="number" class="form-control" id="tax" placeholder="0" name="tax"
                                               value="{{ $Invoice->tax  }}">
                                        <div class="input-group-addon">%</div>
                                    </div>
                                </td>
                                @php
                                    $taxAmount =  $Invoice->total / 100 *  $Invoice->tax;
                                @endphp
                                <td class="text-center"><span class="text-box"
                                                              id="tax_amount">{{ number_format($taxAmount,2) }}</span>
                                </td>
                                <td class="text-center"><span class="text-box"
                                                              id="total_amount">{{ $Invoice->grand_total  }}</span></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>{{ __('page.notes') }}</label>
                        <textarea class="form-control" rows="5" id="notes"
                                  name="notes">{{ $Invoice->notes  }}</textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group mb-0">
                        <button type="submit" class="btn btn-primary"
                                data-id="{{ base64_encode(\Carbon\Carbon::now()->format('MY').'-'.base64_encode($Invoice->id)) }}">{{ __('page.add_invoice') }}
                            <i class="fas "></i></button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $("#date").hijriDatePicker({
            hijri: true,
            format: "DD/MM/YYYY",
            hijriFormat: 'iYYYY/iMM/iDD',
        });
        $("#due_date").hijriDatePicker({
            hijri: true,
            format: "DD/MM/YYYY",
            hijriFormat: 'iYYYY/iMM/iDD',
        });
        var i = '{{ count($InvoiceItems) }}';
        $(document).on("click", "#add_row", function (event) {
            i = parseInt(i);
            b = i - 1;
            $('#addr' + i).html($('#addr' + b).html()).find('td:last-child').find('.total').text('');
            $('#addr' + i).find('td:first-child').html(i + 1);
            $('#addr' + i).find('td').find('#product').val("");
            $('#addr' + i).find('td').find('#qty').val("");
            $('#addr' + i).find('td').find('#price').val("");
            $(".sub_total").before('<tr id="addr' + (i + 1) + '"></tr>');
            i++;
        });
        $(document).on("click", "#delete_row", function (event) {
            if (i > 1) {
                $("#addr" + (i - 1)).html('');
                i--;
            }
            calc();
        });
    });
</script>


<script type="text/javascript">
    $(document).ready(function () {
        $('select[name="customer_id"]').on('change', function () {
            var customerId = $(this).val();
            if (customerId) {
                $.ajax({
                    url: "{{ url('/sales/customer/contract/') }}/" + customerId,
                    type: "GET",
                    success: function (data) {

                        $('select[name="contract_id"]').empty();
                        $('select[name="contract_id"]').append("<option value=''>{{ __('page.select_contract') }}</option>");
                        $.each(data, function (key, value) {
                            $('select[name="contract_id"]').append('<option value="' + key + '">' + value + '</option>');
                        });
                    }
                });
            } else {
                $('select[name="city"]').html(
                    "<option value=''>{{ __('page.select_contract') }}</option>"
                );
            }
        });
    });
</script>