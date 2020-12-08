
<div class="ribbon">
@if( $Invoice->status == 1 )
<span class="danger">{{ __('page.canceled') }}</span>
@elseif( $Invoice->status == 2 )
<span class="danger">{{ __('page.overdue') }}</span>
@elseif( $Invoice->status == 3 )
<span class="success">{{ __('page.paid') }}</span>
@elseif( $Invoice->status == 4 )
<span class="warning">{{ __('page.pending') }}</span>
@elseif( $Invoice->status == 4 )
<span class="info">{{ __('page.partially_paid') }}</span>
@endif
</div>
<div class="row" id="printarea">
    <div class="col-12">
        <div class="card m-b-30">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <div class="invoice-title">
                            <h4 class="float-right font-16"><strong>{{ __('page.invoice_no') }} {{ $Invoice->id }}</strong></h4>
                            <h3 class="m-t-0">
                                <img src=" {{ asset('images/logo_dark.png') }}" alt="logo" height="28"/>
                            </h3>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-6 text-right">
                                <address>
                                    <strong>{{ __('page.billed_to') }}:</strong><br>
                                    {{ __('page.attn') }}:{{ $Invoice->Customer->name }}<br>
                                    {{ __('page.contract') }}:
                                    {{optional($Invoice->contract)->contract_number}}<br>

                                    {{ __('page.address') }}:
                                    @if( isset($Invoice->CustomerDetail->address_arabic) )
                                        {{ $Invoice->CustomerDetail->address_arabic }},
                                    @endif
                                    @if( Session::get('locale') =='en')
                                        @if( isset($Invoice->CustomerDetail->street_is_english) )
                                            {{ $Invoice->CustomerDetail->street_is_english }},
                                        @endif
                                    @else
                                        @if( isset($Invoice->CustomerDetail->street_is_arabic) )
                                            {{ $Invoice->CustomerDetail->street_is_arabic }},
                                        @endif
                                    @endif
                                    {{ (Session::get('locale') =='en') ?  ( isset($Invoice->CustomerDetail->city_is_english) ) ? $Invoice->CustomerDetail->city_is_english : ""   :  ( isset($Invoice->CustomerDetail->city_is_arabic) ) ? $Invoice->CustomerDetail->city_is_arabic : ""   }} <br>
                                    {{ __('page.mobile_number') }}: {{ ( isset($Invoice->Customer->mobile_number) ) ? $Invoice->Customer->mobile_number : ""  }}<br>
                                    {{ __('page.email') }}: {{ ( isset($Invoice->CustomerDetail->email) ) ? $Invoice->CustomerDetail->email : ""  }}
                                </address>
                            </div>
                            <div class="col-6 text-right">
                                <address>
                                    <strong>{{ __('page.shipped_to') }}:</strong><br>
                                    {{ $Invoice->shipped_to }}
                                </address>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 text-right">
                                 <address>
                                    {{ __('page.date') }} :{{ $Invoice->due_date }}
                                </address>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive erp-table">
                            <table class="table table-bordered table-hover" id="tab_logic">
                                <thead>
                                    <tr>
                                        <th class="text-left" widht="5%"> # </th>
                                        <th class="text-center" width="35%">{{ __('page.product') }}</th>
                                        <th class="text-center" width="20%">{{ __('page.price') }}</th>
                                        <th class="text-center" width="20%">{{ __('page.qty') }}</th>
                                        <th class="text-center" width="20%">{{ __('page.total') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $total = 0 @endphp
                                    @if( count($InvoiceItems) > 0 )
                                        @foreach( $InvoiceItems as $InvoiceItem )
                                            @php $total += $InvoiceItem->unit_price * $InvoiceItem->quantity; @endphp
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $InvoiceItem->item_descriptions }}</td>
                                                <td>{{ $InvoiceItem->unit_price }}</td>
                                                <td>{{ $InvoiceItem->quantity }}</td>
                                                <td>{{  number_format($InvoiceItem->quantity *  $InvoiceItem->unit_price,2) }}</td>
                                            </tr>
                                        @endforeach
                                    @endif
                                    <tr>
                                        <td colspan="4">{{ __('page.total') }}</td>
                                        <td>{{ number_format($total,2)  }}</td>
                                    </tr>
                                    @if( isset($Invoice->discount) && $Invoice->discount !="" )
                                        <tr>
                                            <td colspan="4">{{ __('page.order_discount') }} </td>
                                            <td>{{ number_format($Invoice->discount ,2) }}</td>
                                        </tr>
                                    @endif
                                    @if( isset($Invoice->tax) && $Invoice->tax !="" )
                                    @php
                                        $taxAmount =  $Invoice->total / 100 *  $Invoice->tax;
                                    @endphp
                                    <tr>
                                        <td colspan="4">{{ __('page.order_tax') }}</td>
                                        <td>{{ number_format($taxAmount ,2)  }}</td>
                                    </tr>
                                    @endif
                                    <tr>
                                        <td colspan="4">{{ __('page.grand_total') }}</td>
                                        <td>{{ number_format($total,2) }}</td>
                                    </tr>
                                     <tr>
                                        <td colspan="4">{{ __('page.paid') }}</td>
                                        <td>{{ invoicePaid($Invoice->id) }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="4">{{ __('page.balance') }}</td>
                                        <td>{{ invoicePaid($Invoice->id,'balance') }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="border">
                            <div class="p-2">
                                <label class="mb-0">{{ __('page.notes') }} :</label>
                                <div>{{  $Invoice->notes }}</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 pull-right">
                        <p>&nbsp;</p>
                        <p>&nbsp;</p>
                        <p class="mb-0" style="border-bottom: 1px solid #999;">&nbsp;</p>
                        <p>{!! __('page.signature_stamp') !!} </p>
                    </div>
                </div>
                <div class="col-xs-12" style="margin-top: 15px;">
                    <a class="btn btn-primary btn-sm btn-block waves-effect waves-light" href="{{ url('/sales/invoice/pdf/'. base64_encode(\Carbon\Carbon::now()->format('MY').'-'.base64_encode($Invoice->id)))}}">{{ __('page.download_as_pdf') }}</a>
                </div>
                @if( count($invoicePayments) > 0 )
                    <h3>{{ __('page.payment_details') }} ({{ __('page.invoice_no') }} {{ $Invoice->id }})</h3>
                    <div class="table-responsive erp-table">
                        <table class="table table-bordered table-hover" id="tab_logic">
                            <thead>
                                <tr>
                                    <th class="text-center" width="35%">{{ __('page.date') }}</th>
                                    <th class="text-center" width="20%">{{ __('page.amount') }}</th>
                                    <th class="text-center" width="20%">{{ __('page.note') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach( $invoicePayments as $invoicePayment )
                                    <tr>
                                        <td>{{ $invoicePayment->date }}</td>
                                        <td>{{ $invoicePayment->amount_paid }}</td>
                                        <td>{{ $invoicePayment->note }}</td>
                                   </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->