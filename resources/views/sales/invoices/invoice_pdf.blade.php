<!DOCTYPE html>
<html>
<head>
    <title></title>
     <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <style type="text/css">
            @page { margin: 0px;font-family: DejaVu Sans, sans-serif; }
             body {
                background: #f5f5f5;
                margin: 0;
                font-size: 13px;
                font-family: DejaVu Sans, sans-serif;
            }
            .font-16 {
                font-size: 16px;
            }
            .float-right, .close {
                float: left !important;
            }
            h1, h2, h3, h4, h5, h6 {
                margin: 10px 0;
                font-weight: 600;
                font-family: "Open Sans", sans-serif;
                margin-bottom: 0px;
            }
            hr {
                margin-top: 1rem;
                margin-bottom: 1rem;
                border: 0;
                border-top: 1px solid rgba(0, 0, 0, .1);
            }
            table.result_table { direction: rtl; }
            table.result_table caption, 
            table.result_table th, 
            table.result_table td { direction: ltr; }
            table{width: 100%;border-collapse: collapse;margin-bottom: 10px;font-family: DejaVu Sans, sans-serif;}
            table td, table th {  border: 1px solid #ddd; }
            table td, table th {  padding: 5px; }
            table th { text-align: center; }
            table td { text-align: right; }
            .ribbon {
                position: absolute;
                right: 0px;
                top: 0px;
                z-index: 1;
                overflow: hidden;
                width: 110px;
                height: 110px;
                text-align: right;
            }
            .ribbon span {
                font-size: 10px;
                font-weight: bold;
                color: #FFF;
                text-transform: uppercase;
                text-align: center;
                line-height: 11px;
                transform: rotate(45deg);
                -webkit-transform: rotate(45deg);
                width: 128px;
                display: block;
                background: #79A70A;
                position: absolute;
                top: 25px;
                right: -35px;
                padding: 4px;
            }
            .ribbon span.danger { background: #f24734; }
            .ribbon span.warning { background: #fdba45; }
            .ribbon span.info { background: #4bbbce; }
            .signature_stamp{ width:33.333333%; display:inline-block;float: right; }
            .main-div{ margin:10px 30px; }
            .invoice-title{ margin-top: 50px; }
        </style>
</head>
<body>
    <div class="ribbon">
        @if( $Invoice->status == 1 ) 
        <span class="danger">{{ __('page.canceled') }}</span>
        @elseif( $Invoice->status == 2 )
        <span class="danger">{{ __('page.overdue') }}</span>
        @elseif( $Invoice->status == 3 )
        <span class="success">{{ __('page.paid') }}</span>
        @elseif( $Invoice->status == 4 )
        <span class="warning">{{ __('page.pending') }}</span>
        @elseif( $Invoice->status == 5 )
        <span class="info">{{ __('page.partially_paid') }}</span>
        @endif
    </div>
    <div class="main-div">
        <div class="invoice-title">
            <div style="width:50%; display:inline-block;"><h3>{{ __('page.invoice_no') }} {{ $Invoice->id }}</h3></div><div style="width:50%; display:inline-block;text-align: right;"> <img src="{{ public_path('images/logo_dark.png') }}" alt="logo" height="28" style="padding-right: 40px;"></div>
        </div>
        <hr>
        <div style=" clear: both;"></div>
        <div style="width:50%; display:inline-block;float: right;">
           <strong>{{ __('page.billed_to') }}:</strong><br>
            {{ __('page.attn') }}:{{ $Invoice->Customer->name }}<br>
            {{ __('page.contract') }}:
            {{optional($Invoice->contract)->contract_number}}<br>
            {{ __('page.address') }}:{{ ( isset($Invoice->CustomerDetail->address_arabic) ) ? $Invoice->CustomerDetail->address_arabic : ""  }},
            {{ (Session::get('locale') =='en') ?  ( isset($Invoice->CustomerDetail->street_is_english) ) ? $Invoice->CustomerDetail->street_is_english : ""   :  ( isset($Invoice->CustomerDetail->street_is_arabic) ) ? $Invoice->CustomerDetail->street_is_arabic : ""   }},
            {{ (Session::get('locale') =='en') ?  ( isset($Invoice->CustomerDetail->city_is_english) ) ? $Invoice->CustomerDetail->city_is_english : ""   :  ( isset($Invoice->CustomerDetail->city_is_arabic) ) ? $Invoice->CustomerDetail->city_is_arabic : ""   }} <br>
            {{ __('page.mobile_number') }}: {{ ( isset($Invoice->Customer->mobile_number) ) ? $Invoice->Customer->mobile_number : ""  }}<br>
            {{ __('page.email') }}: {{ ( isset($Invoice->CustomerDetail->email) ) ? $Invoice->CustomerDetail->email : ""  }}
        </div>
        <div style="width:50%; display:inline-block;float: right;">
            <strong>{{ __('page.shipped_to') }}:</strong><br>
                {{ $Invoice->shipped_to }}
        </div>
        <div style=" clear: both;"></div>
        <div style="width:50%; display:inline-block;float: right; margin-top: 10px;margin-bottom: 10px; ">
             {{ __('page.date') }} :{{ $Invoice->due_date }}
        </div>
         <div style=" clear: both;"></div>
        <table dir="rtl" class="result_table" >
            <thead>
                <tr>
                  <th class="text-center" width="20%">{{ __('page.total') }}</th>
                    <th class="text-center" width="20%">{{ __('page.qty') }}</th>
                    <th class="text-center" width="20%">{{ __('page.price') }}</th>
                    <th class="text-center" width="35%">{{ __('page.product') }}</th>
                    <th class="text-left" widht="5%"> # </th>
                </tr>
            </thead>
            <tbody>
                @php $total = 0 @endphp
                @if( count($InvoiceItems) > 0 )
                    @foreach( $InvoiceItems as $InvoiceItem )
                        @php $total += $InvoiceItem->unit_price * $InvoiceItem->quantity; @endphp
                        <tr>
                            <td>{{ $InvoiceItem->quantity *  $InvoiceItem->unit_price }}</td>
                            <td>{{ $InvoiceItem->quantity }}</td>
                            <td>{{ $InvoiceItem->unit_price }}</td>
                            <td>{{ $InvoiceItem->item_descriptions }}</td>
                            <td>{{ $loop->iteration }}</td>
                        </tr>
                    @endforeach
                @endif
                <tr>
                    <td>{{ $total }}</td>
                    <td colspan="4">{{ __('page.total') }}</td>
                </tr>
                @if( isset($Invoice->discount) && $Invoice->discount !="" ) 
                    <tr>
                        <td>{{ $Invoice->discount }}</td>
                        <td colspan="4">{{ __('page.order_discount') }} </td>
                    </tr> 
                @endif
                @if( isset($Invoice->tax) && $Invoice->tax !="" ) 
                @php
                    $taxAmount =  $Invoice->total / 100 *  $Invoice->tax;
                @endphp
                <tr>
                   <td>{{ $taxAmount }}</td>
                    <td colspan="4">{{ __('page.order_tax') }}</td>
                </tr>
                @endif
                <tr>
                    <td>{{ $total }}</td>
                    <td colspan="4">{{ __('page.grand_total') }}</td>
                </tr> 
                 <tr>
                    <td>{{ invoicePaid($Invoice->id) }}</td>
                    <td colspan="4">{{ __('page.paid') }}</td>
                </tr> 
                <tr>
                    <td>{{ invoicePaid($Invoice->id,'balance') }}</td>
                    <td colspan="4">{{ __('page.balance') }}</td>
                </tr> 
                               
            </tbody>
        </table>
        <div style='border: 1px solid #dee2e6!important;text-align: right;font-family: "Open Sans", sans-serif;'>
            <div style="padding: .5rem!important;">
                <label class="mb-0" style="font-weight: 600;">{{ __('page.notes') }} :</label>
                <div>{{  $Invoice->notes }}</div>
            </div>
        </div>
        
            <div class="signature_stamp">
                <p>&nbsp;</p>
                <p>&nbsp;</p>
                <p class="mb-0" style="border-bottom: 1px solid #999;">&nbsp;</p>
                <p style="text-align: right;">{!! __('page.signature_stamp') !!} </p>
            </div>
        <div style=" clear: both;"></div>
         @if( count($invoicePayments) > 0 )
            <h3 style="width:100%; display:inline-block;text-align: right;">Payment Details (Invoice No 3)</h3>
            <table dir="rtl" class="result_table">
                <thead>
                    <tr>
                        <th class="text-center" width="20%">{{ __('page.note') }}</th>
                        <th class="text-center" width="20%">{{ __('page.amount') }}</th>
                        <th class="text-center" width="35%">{{ __('page.date') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach( $invoicePayments as $invoicePayment )
                        <tr>
                            <td>{{ $invoicePayment->note }}</td>
                            <td>{{ $invoicePayment->amount_paid }}</td>
                            <td>{{ $invoicePayment->date }}</td>
                       </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</body>
</html>