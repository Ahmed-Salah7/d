<?php

namespace App\Http\Controllers;

use App\EmploymentContract;
use App\Invoice;
use App\InvoiceItem;
use App\Customer;
use App\Status;
use App\invoicePayment;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Redirect, Response;
use Validator;
use DB;
use PDF;
use SnappyPDF;

class InvoiceController extends Controller
{
    public function __construct()
    {

        $this->middleware('checkadmin');
        $this->middleware('role_or_permission:view invoice', ['only' => ['index']]);
        $this->middleware('role_or_permission:create invoice', ['only' => ['create', 'store']]);
        $this->middleware('role_or_permission:edit invoice', ['only' => ['update', 'edit']]);
        $this->middleware('role_or_permission:delete invoice', ['only' => ['destroy']]);


        $this->middleware('role_or_permission:view payment', ['only' => ['paymentShow']]);
        $this->middleware('role_or_permission:create payment', ['only' => ['paymentCreate', 'paymentStore']]);
        $this->middleware('role_or_permission:edit payment', ['only' => ['paymentEdit', 'paymentupdate']]);
        $this->middleware('role_or_permission:delete payment', ['only' => ['paymentDestroy']]);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if (request()->ajax()) {
            $Invoices = Invoice::leftJoin('customers', 'invoices.customer_id', '=', 'customers.id')
                ->select(
                    'invoices.*',
                    'invoices.id as id',
                    'customers.name as customer_name'
                )
                ->orderBy('invoices.id', 'DESC')->get();
            return datatables()->of($Invoices)
                ->addColumn('action', 'sales.invoices.action_button')
                ->addColumn('balance', 'sales.invoices.invoice_balance')
                ->addColumn('paid', 'sales.invoices.invoice_paid')
                ->addColumn('status', 'sales.invoices.status_label')
                ->rawColumns(['action', 'status', 'balance', 'paid'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('sales.invoices.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $Customers = Customer::where('status', 1)->get();
        $Status = Status::get();

        $EmploymentContracts = EmploymentContract::get();
        $view = view('sales.invoices.add', compact('EmploymentContracts', 'Customers', 'Status'))->render();
        return response()->json(['view' => $view]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'date' => 'required',
            'time' => 'required',
            'customer_id' => 'required',
            'due_date' => 'required',
            'status' => 'required',
            "product.0" => "required",
            "qty.0" => "required",
            "price.0" => "required",
        ], [
            'date.required' => __('message.date_required'),
            'time.required' => __('message.time_required'),
            'customer_id.required' => __('message.customer_id_required'),
            'due_date.required' => __('message.due_date_required'),
            'status.required' => __('message.status_required'),
            'product.0.required' => __('message.product_required'),
            'qty.0.required' => __('message.qty_required'),
            'price.0.required' => __('message.price_required')
        ]);

        if ($validator->passes()) {

            $params = $request->all();
            $data = array();
            $data['date'] = Carbon::parse($params['date'] . "" . $params['time'])->format('Y-m-d H:i');
            $data['customer_id'] = $params['customer_id'];
            $data['contract_id'] = $params['contract_id'];
            $data['due_date'] = Carbon::parse($params['due_date'])->format('Y-m-d');
//            $data['shipped_to'] = $params['shipping'];
            $data['discount'] = $params['discount'];
            $data['notes'] = $params['notes'];
            $data['tax'] = $params['tax'];
            $data['status'] = $params['status'];
            DB::beginTransaction();
            $Invoice = Invoice::create($data);
            if ($Invoice) {
                if (count($params['product']) > 0) {
                    $Total = 0;
                    for ($i = 0; $i <= count($params['product']); $i++) {
                        if (isset($params['product'][$i]) && isset($params['price'][$i]) && isset($params['qty'][$i]) &&
                            $params['product'][$i] != "" && $params['price'][$i] != "" && $params['qty'][$i] != "") {
                            $Total += $params['price'][$i] * $params['qty'][$i];
                            try {
                                InvoiceItem::create(['invoice_id' => $Invoice->id, 'item_descriptions' => $params['product'][$i], 'unit_price' => $params['price'][$i], 'quantity' => $params['qty'][$i]]);
                            } catch (\PDOException $e) {
                                DB::rollback();
                                return response()->json(['error' => array('failed' => __('message.create_failed'))]);
                            }
                        }
                    }
                }
                try {
                    $tax = 00;
                    if (isset($params['tax']) && $params['tax'] != "") {
                        $Total = $Total - $params['discount'];
                        $tax = $Total / 100 * $params['tax'];
                    }
                    $grandTotal = $Total + $tax;
                    $Invoice->update(['grand_total' => $grandTotal, 'total' => $Total]);
                } catch (\PDOException $e) {
                    DB::rollback();
                    return response()->json(['error' => array('failed' => __('message.create_failed'))]);
                }
                DB::commit();
                addToLog('create_invoice', $Invoice->id,$Invoice->id,'Invoice');
                return response()->json(['success' => __('message.invoice_create_success')]);
            } else {
                DB::rollback();
                return response()->json(['error' => array('failed' => __('message.create_failed'))]);
            }
        }
        return response()->json(['error' => $validator->errors()->all()]);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Invoice $invoice
     * @return \Illuminate\Http\Response
     */
    public function show($getId)
    {

        $getId = explode("-", base64_decode($getId));
        $id = base64_decode($getId['1']);

        if ($id != "") {
            $Invoice = Invoice::where('id', $id)->first();
            if ($Invoice) {
                $InvoiceItems = InvoiceItem::where('invoice_id', $id)->get();
                $Customers = Customer::where('status', 1)->get();
                $invoicePayments = invoicePayment::where('invoice_id', $id)->get();
                $EmploymentContracts = EmploymentContract::get();
                $view = view('sales.invoices.view', compact('EmploymentContracts', 'Invoice', 'InvoiceItems', 'Customers', 'invoicePayments'))->render();
                return response()->json(['view' => $view]);
            } else {
                return response()->json('error', __('message.invoice_not_found'));
            }
        }
        return response()->json('error', __('message.create_failed'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Invoice $invoice
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $getId)
    {
        $getId = explode("-", base64_decode($getId));
        $id = base64_decode($getId['1']);
        if ($id != "") {
            $Invoice = Invoice::where('id', $id)->first();
            if ($Invoice) {
                $InvoiceItems = InvoiceItem::where('invoice_id', $id)->get();
                $Customers = Customer::where('status', 1)->get();
                $EmploymentContracts = EmploymentContract::get();
                $contracts = $Invoice->Customer ? $Invoice->Customer->contracts : [];
                $view = view('sales.invoices.edit', compact('contracts', 'EmploymentContracts', 'Invoice', 'InvoiceItems', 'Customers'))->render();
                return response()->json(['view' => $view]);
            } else {
                return response()->json('error', __('message.invoice_not_found'));
            }
        }
        return response()->json('error', __('message.create_failed'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Invoice $invoice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $getId)
    {
        $getId = explode("-", base64_decode($getId));
        $id = base64_decode($getId['1']);
        if ($id != "") {
            $validator = Validator::make($request->all(), [
                'date' => 'required',
                'time' => 'required',
                'customer_id' => 'required',
                'due_date' => 'required',
                'status' => 'required',
                "product.0" => "required",
                "qty.0" => "required",
                "price.0" => "required",
            ], [
                'date.required' => __('message.date_required'),
                'time.required' => __('message.time_required'),
                'customer_id.required' => __('message.customer_id_required'),
                'due_date.required' => __('message.due_date_required'),
                'status.required' => __('message.status_required'),
                'product.0.required' => __('message.product_required'),
                'qty.0.required' => __('message.qty_required'),
                'price.0.required' => __('message.price_required')
            ]);

            if ($validator->passes()) {
                $params = $request->all();
                $data = array();

                $Invoice = Invoice::where('id', $id)->first();
                if ($Invoice) {
                    $data['date'] = Carbon::parse($params['date'] . "" . $params['time'])->format('Y-m-d H:i');
                    $data['customer_id'] = $params['customer_id'];
                    $data['contract_id'] = $params['contract_id'];
                    $data['due_date'] = Carbon::parse($params['due_date'])->format('Y-m-d');
//                    $data['shipped_to'] = $params['shipping'];
                    $data['discount'] = $params['discount'];
                    $data['notes'] = $params['notes'];
                    $data['tax'] = $params['tax'];
                    $data['status'] = $params['status'];
                    DB::beginTransaction();
                    $Invoice->update($data);
                    if (count($params['product']) > 0) {
                        InvoiceItem::where('invoice_id', $id)->delete();
                        $Total = 0;
                        for ($i = 0; $i <= count($params['product']); $i++) {
                            if (isset($params['product'][$i]) && isset($params['price'][$i]) && isset($params['qty'][$i]) &&
                                $params['product'][$i] != "" && $params['price'][$i] != "" && $params['qty'][$i] != "") {
                                $Total += $params['price'][$i] * $params['qty'][$i];
                                try {
                                    InvoiceItem::create(['invoice_id' => $Invoice->id, 'item_descriptions' => $params['product'][$i], 'unit_price' => $params['price'][$i], 'quantity' => $params['qty'][$i]]);
                                } catch (\PDOException $e) {
                                    DB::rollback();
                                    return response()->json(['error' => array('failed' => __('message.create_failed'))]);
                                }
                            }
                        }
                    }
                    try {
                        $tax = 00;
                        if (isset($params['tax']) && $params['tax'] != "") {
                            $Total = $Total - $params['discount'];
                            $tax = $Total / 100 * $params['tax'];
                        }
                        $grandTotal = $Total + $tax;
                        $Invoice->update(['grand_total' => $grandTotal, 'total' => $Total]);
                    } catch (\PDOException $e) {
                        DB::rollback();
                        return response()->json(['error' => array('failed' => __('message.create_failed'))]);
                    }
                    $data['id'] = $Invoice->id;

                    addToLog('update_invoice', serialize($data),$Invoice->id,'Invoice');
                    DB::commit();
                    return response()->json(['success' => __('message.invoice_update_success')]);
                } else {
                    return response()->json(['error' => array('failed' => __('message.invoice_not_found'))]);
                }
            }
            return response()->json(['error' => $validator->errors()->all()]);
        }
        return response()->json(['error' => array('failed' => __('message.create_failed'))]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Invoice $invoice
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $params = $request->all();
        $getId = explode("-", base64_decode($params['id']));
        $id = base64_decode($getId['1']);
        if ($id != "") {
            $Invoice = Invoice::find($id);
            if ($Invoice) {
                $Invoice->delete();
                InvoiceItem::where('invoice_id', $id)->delete();
                addToLog('delete_invoice', $Invoice->id,$Invoice->id,'Invoice');
                return response()->json(['success' => __('message.delete_text')]);
            } else {
                return response()->json(['error' => __('message.invoice_not_found')]);
            }
        }
        return response()->json(['error' => __('message.create_failed')]);
    }

    public function invoicePDF($getId)
    {
        $getId = explode("-", base64_decode($getId));
        $id = base64_decode($getId['1']);
        if ($id != "") {
            $Invoice = Invoice::where('id', $id)->first();
            if ($Invoice) {
                $InvoiceItems = InvoiceItem::where('invoice_id', $id)->get();
                $invoicePayments = invoicePayment::where('invoice_id', $id)->get();
                $pdf = SnappyPDF::loadView('sales.invoices.invoice_pdf', compact('Invoice', 'InvoiceItems', 'invoicePayments'));
                return $pdf->download('Invoice-' . $id . '.pdf');
            } else {
                return redirect('/sales/invoice')->with('error', __('message.invoice_not_found'));
            }
        }
        return redirect('/sales/invoice')->with('error', __('message.create_failed'));
    }

    public function paymentCreate($getId)
    {
        $getId = explode("-", base64_decode($getId));
        $id = base64_decode($getId['1']);
        if ($id != "") {
            $Invoice = Invoice::where('id', $id)->first();
            if ($Invoice) {
                $view = view('sales.invoices.add_payment', compact('Invoice'))->render();
                return response()->json(['view' => $view]);
            } else {
                return response()->json('error', __('message.invoice_not_found'));
            }
        }
        return response()->json('error', __('message.create_failed'));
    }

    public function paymentStore(Request $request, $getId)
    {
        $getId = explode("-", base64_decode($getId));
        $id = base64_decode($getId['1']);
        if ($id != "") {
            $validator = Validator::make($request->all(), [
                'amount_paid' => 'required',
            ], [
                'amount_paid.required' => __('message.amount_paid_required')
            ]);

            if ($validator->passes()) {
                $params = $request->all();
                $data = array();
                $amount_paid = 0;
                if (isset($params['date']) && $params['date'] != "") {
                    $date = Carbon::parse($params['date'])->format('Y-m-d');
                } else {
                    $date = Carbon::now()->format('Y-m-d');
                }
                if (is_numeric($params['amount_paid'])) {
                    if (getPaidAmount($id) >= $params['amount_paid']) {
                        $amount_paid = $params['amount_paid'];
                    } else {
                        $amount_paid = getPaidAmount($id);
                    }
                }
                $Invoice = Invoice::where('id', $id)->first();
                if ($Invoice) {
                    $data['invoice_id'] = $id;
                    $data['date'] = $date;
                    $data['amount_paid'] = $amount_paid;
                    $data['note'] = $params['notes'];
                    DB::beginTransaction();
                    try {
                        $invoicePayment = invoicePayment::create($data);
                    } catch (\PDOException $e) {
                        DB::rollback();
                        return response()->json(['error' => array('failed' => __('message.create_failed'))]);
                    }
                    getInvoicesStatus($invoicePayment->invoice_id);
                    addToLog('add_invoice_payment', serialize($invoicePayment->id),$invoicePayment->id,'invoicePayment');
                    DB::commit();
                    return response()->json(['success' => __('message.invoice_payment_create_success')]);
                } else {
                    return response()->json(['error' => array('failed' => __('message.invoice_not_found'))]);
                }
            }
            return response()->json(['error' => $validator->errors()->all()]);
        }
        return response()->json(['error' => array('failed' => __('message.create_failed'))]);
    }

    public function paymentShow($getId)
    {
        $getId = explode("-", base64_decode($getId));
        $id = base64_decode($getId['1']);
        if ($id != "") {
            $Invoice = Invoice::where('id', $id)->first();
            $invoicePayments = invoicePayment::where('invoice_id', $id)->get();
            if ($Invoice) {
                $view = view('sales.invoices.view_payment', compact('Invoice', 'invoicePayments'))->render();
                return response()->json(['view' => $view]);
            } else {
                return response()->json('error', __('message.invoice_not_found'));
            }
        }
        return response()->json('error', __('message.create_failed'));
    }

    public function paymentDestroy(Request $request)
    {
        $params = $request->all();
        $getId = explode("-", base64_decode($params['id']));
        $id = base64_decode($getId['1']);
        if ($id != "") {
            $invoicePayment = invoicePayment::find($id);
            if ($invoicePayment) {
                $invoicePayment->delete();
                addToLog('delete_invoice_payment', $invoicePayment->id, $invoicePayment->id,'invoicePayment');
                $invoicePaid = invoicePaid($invoicePayment->invoice_id);
                if ($invoicePaid == 0) {
                    $Invoice = Invoice::where('id', $invoicePayment->invoice_id)->update(['status' => 2]);
                } else {
                    $Invoice = Invoice::where('id', $invoicePayment->invoice_id)->update(['status' => 5]);
                }
                return response()->json(['success' => __('message.delete_text')]);
            } else {
                return response()->json(['error' => array('failed' => __('message.invoice_payment_not_found'))]);
            }
        }
        return response()->json(['error' => array('failed' => __('message.create_failed'))]);
    }

    public function paymentEdit($getId)
    {
        $getId = explode("-", base64_decode($getId));
        $id = base64_decode($getId['1']);
        if ($id != "") {
            $invoicePayment = invoicePayment::where('id', $id)->first();
            if ($invoicePayment) {
                $view = view('sales.invoices.edit_payment', compact('invoicePayment'))->render();
                return response()->json(['view' => $view]);
            } else {
                return response()->json('error', __('message.invoice_payment_not_found'));
            }
        }
        return response()->json('error', __('message.create_failed'));
    }


    public function paymentupdate(Request $request, $getId)
    {
        $getId = explode("-", base64_decode($getId));
        $id = base64_decode($getId['1']);
        if ($id != "") {
            $validator = Validator::make($request->all(), [
                'amount_paid' => 'required',
            ], [
                'amount_paid.required' => __('message.amount_paid_required')
            ]);

            if ($validator->passes()) {
                $params = $request->all();
                $data = array();
                $amount_paid = 0;
                if (isset($params['date']) && $params['date'] != "") {
                    $date = Carbon::parse($params['date'])->format('Y-m-d');
                } else {
                    $date = Carbon::now()->format('Y-m-d');
                }
                if (is_numeric($params['amount_paid'])) {
                    $amount_paid = $params['amount_paid'];
                }
                $invoicePayment = invoicePayment::where('id', $id)->first();
                if ($invoicePayment) {
                    $data['date'] = $date;
                    $data['amount_paid'] = $amount_paid;
                    $data['note'] = $params['notes'];
                    DB::beginTransaction();
                    try {
                        $invoicePayment->update($data);
                    } catch (\PDOException $e) {
                        DB::rollback();
                        return response()->json(['error' => array('failed' => __('message.create_failed'))]);
                    }
                    $data['id'] = $invoicePayment->id;
                    getInvoicesStatus($invoicePayment->invoice_id);
                    addToLog('update_invoice_payment', serialize($data),$invoicePayment->id,'invoicePayment');
                    DB::commit();
                    return response()->json(['success' => __('message.invoice_payment_update_success')]);
                } else {
                    return response()->json(['error' => array('failed' => __('message.invoice_payment_not_found'))]);
                }
            }
            return response()->json(['error' => $validator->errors()->all()]);
        }
        return response()->json(['error' => array('failed' => __('message.create_failed'))]);
    }

    public function viewpf($getId)
    {
        $getId = explode("-", base64_decode($getId));
        $id = base64_decode($getId['1']);
        if ($id != "") {
            $Invoice = Invoice::where('id', $id)->first();
            if ($Invoice) {
                $InvoiceItems = InvoiceItem::where('invoice_id', $id)->get();
                $invoicePayments = invoicePayment::where('invoice_id', $id)->get();
                return view('myPDF', compact('Invoice', 'InvoiceItems', 'invoicePayments'));
            } else {
                return response()->json('error', __('message.invoice_not_found'));
            }
        }
        return response()->json('error', __('message.create_failed'));
    }

    public function customer_contracts($id)
    {
        $customer = Customer::find($id);
        $contracts = $customer->contracts->pluck('contract_number', 'id')->toArray();
        return $contracts;
    }
}
