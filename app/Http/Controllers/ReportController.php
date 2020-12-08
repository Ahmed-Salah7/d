<?php

namespace App\Http\Controllers;

use App\Cv;
use App\Customer;
use App\EmploymentContract;
use App\Ticket;
use App\Invoice;
use App\Nationalitie;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Redirect, Response;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('checkadmin');
        $this->middleware('role_or_permission:cv report', ['only' => ['cvReportView', 'cvReport']]);
        $this->middleware('role_or_permission:customer report', ['only' => ['customerView', 'customer']]);
        $this->middleware('role_or_permission:contract report', ['only' => ['contractView', 'contract']]);
        $this->middleware('role_or_permission:ticket report', ['only' => ['ticketView', 'ticket']]);
        $this->middleware('role_or_permission:invoice report', ['only' => ['invoiceView', 'invoice']]);
        $this->middleware('role_or_permission:arrival report', ['only' => ['arrivalReportView', 'arrivalReport']]);
    }

    public function index()
    {
        return view('reports.index');
    }

    public function cvReportView()
    {
        $Nationalities = Nationalitie::where('status', '1')->get();
        $Title = __('page.cv_reports');
        $view = view('reports.cv_reports', compact('Nationalities'))->render();
        return response()->json(['view' => $view, 'Title' => $Title]);
    }

    public function cvReport(Request $request)
    {
        if (request()->ajax()) {
            $params = $request->all();
            $startdate = "";
            $enddate = "";
            $nationality = "";

            $query = Cv::leftJoin('professions', 'cv.profession_id', '=', 'professions.id')
                ->leftJoin('nationalities', 'cv.nationality_id', '=', 'nationalities.id')
                ->leftJoin('religions', 'cv.religion_id', '=', 'religions.id')
                ->leftJoin('offices', 'cv.office_id', '=', 'offices.id')
                ->select(
                    'cv.*',
                    'professions.*',
                    'nationalities.*',
                    'religions.*',
                    'offices.*',
                    'cv.id as id',
                    'offices.name as office_name',
                    'cv.status as status',
                    'cv.name as cv_name'
                )
                ->orderBy('cv.id', 'DESC');
            $query->when(request('nationality_id') != '', function ($q) {
                return $q->where('cv.nationality_id', request('nationality_id'));
            });
            $query->when(request('enddate') != '' && request('startdate') != '', function ($q) {
                $startdate = Carbon::parse(str_replace('/', '-', request('startdate')))->format('Y-m-d') . ' 00:00:00';
                $enddate = Carbon::parse(str_replace('/', '-', request('enddate')))->format('Y-m-d') . ' 23:59:59';
                return $q->whereBetween('cv.created_at', [$startdate, $enddate]);
            });
            $cv = $query->get();
            return datatables()->of($cv)
                ->addColumn('status', 'reports.status.status')
                ->addColumn('nationality', 'office_work.cv.nationality')
                ->addColumn('religion', 'office_work.cv.religion')
                ->addColumn('occupation', 'office_work.cv.occupation')
                ->addColumn('previous_experience', 'reports.status.cv_pre_experience')
                ->addColumn('reservation', 'reports.status.cv_reservation')
                ->rawColumns(['status', 'nationality', 'religion', 'occupation', 'previous_experience', 'reservation'])
                ->addIndexColumn()
                ->make(true);
        }
    }

    public function customerView()
    {
        $Nationalities = Nationalitie::where('status', '1')->get();
        $Title = __('page.customer_reports');
        $view = view('reports.customer_reports', compact('Nationalities'))->render();
        return response()->json(['view' => $view, 'Title' => $Title]);
    }

    public function customer(Request $request)
    {
        if (request()->ajax()) {
            $params = $request->all();
            $startdate = "";
            $enddate = "";
            $nationality = "";

            $query = Customer::leftJoin('nationalities', 'customers.nationality_id', '=', 'nationalities.id')
                ->select(
                    'customers.*',
                    'nationalities.*',
                    'customers.status as status',
                    'customers.id as id'
                )
                ->orderBy('customers.id', 'DESC');
            $query->when(request('nationality_id') != '', function ($q) {
                return $q->where('customers.nationality_id', request('nationality_id'));
            });
            $query->when(request('enddate') != '' && request('startdate') != '', function ($q) {
                $startdate = Carbon::parse(str_replace('/', '-', request('startdate')))->format('Y-m-d') . ' 00:00:00';
                $enddate = Carbon::parse(str_replace('/', '-', request('enddate')))->format('Y-m-d') . ' 23:59:59';
                return $q->whereBetween('customers.created_at', [$startdate, $enddate]);
            });
            $Customers = $query->get();
            return datatables()->of($Customers)
                ->addColumn('nationality', 'office_work.cv.nationality')
                ->addColumn('status', 'reports.status.status')
                ->rawColumns(['status', 'nationality'])
                ->addIndexColumn()
                ->make(true);
        }
    }

    public function contractView()
    {
        $Nationalities = Nationalitie::where('status', '1')->get();
        $Title = __('page.contract_reports');
        $view = view('reports.contract_reports', compact('Nationalities'))->render();
        return response()->json(['view' => $view, 'Title' => $Title]);
    }

    public function contract(Request $request)
    {
        if (request()->ajax()) {
            $params = $request->all();
            $query = EmploymentContract::leftJoin('customers', 'employment_contracts.customer_id', '=', 'customers.id')
                ->leftJoin('religions', 'employment_contracts.religion_id', '=', 'religions.id')
                ->leftJoin('nationalities', 'employment_contracts.nationality_id', '=', 'nationalities.id')
                ->leftJoin('offices', 'employment_contracts.office_id', '=', 'offices.id')
                ->leftJoin('cv', 'employment_contracts.cv_id', '=', 'cv.id')
                ->select(
                    'employment_contracts.*',
                    'customers.name as customer_name',
                    'customers.id_card_number as id_card_number',
                    'religions.*',
                    'nationalities.*',
                    'offices.name as offfice_name',
                    'employment_contracts.id as id',
                    'employment_contracts.office_id as office_id',
                    'employment_contracts.status as status',
                    'cv.name as cv_name'
                )
                ->where('customers.status', 1)
                ->where('employment_contracts.displayed', 1)
                ->whereNull('customers.deleted_at')
                ->orderBy('employment_contracts.id', 'DESC');
            $query->when(request('nationality_id') != '', function ($q) {
                return $q->where('cv.nationality_id', request('nationality_id'));
            });
            $query->when(request('contract_no') != '', function ($q) {
                return $q->where('employment_contracts.contract_number', request('contract_no'));
            });
            $query->when(request('office_id') != '', function ($q) {
                return $q->where('employment_contracts.office_id', request('office_id'));
            });
            $query->when(request('enddate') != '' && request('startdate') != '', function ($q) {
                $startdate = Carbon::parse(str_replace('/', '-', request('startdate')))->format('Y-m-d') . ' 00:00:00';
                $enddate = Carbon::parse(str_replace('/', '-', request('enddate')))->format('Y-m-d') . ' 23:59:59';
                return $q->whereBetween('employment_contracts.date_of_contract', [$startdate, $enddate]);
            });
            $EmploymentContract = $query->get();
            return datatables()->of($EmploymentContract)
                ->addColumn('nationality', 'office_work.cv.nationality')
                ->addColumn('religion', 'office_work.customers.religion')
                ->addColumn('status', 'reports.status.contract_status')
                ->addColumn('date_of_contract', 'reports.date_of_contract')
                ->addColumn('local_office', 'reports.local_office')
                ->addColumn('outside_office', 'reports.outside_office')
                ->addColumn('source', function ($EmploymentContract){
                    $outside = isset($EmploymentContract->source)?   $EmploymentContract->source->source:'-';
                    return $outside;
                })
                ->addColumn('outside', function ($EmploymentContract){
                    $outside = isset($EmploymentContract->office)?   $EmploymentContract->office->name:'-';
                    return $outside;
                })
                ->rawColumns(['religion','source', 'status', 'nationality', 'date_of_contract'])
                ->addIndexColumn()
                ->make(true);
        }
    }

    public function ticketView()
    {
        $Title = __('page.ticket_reports');
        $view = view('reports.ticket_reports')->render();
        return response()->json(['view' => $view, 'Title' => $Title]);
    }

    public function ticket(Request $request)
    {
        if (request()->ajax()) {
            $params = $request->all();
            $startdate = "";
            $enddate = "";
            $nationality = "";

            $query = Ticket::leftJoin('ticket_thread', 'tickets.id', '=', 'ticket_thread.ticket_id')
                ->select(
                    'tickets.*',
                    'ticket_thread.title as thread_title'
                )
                ->where('ticket_thread.title', '!=', '')
                ->orderBy('tickets.id', 'DESC');
            $query->when(request('status') != '', function ($q) {
                return $q->where('tickets.status', request('status'));
            });
            $query->when(request('enddate') != '' && request('startdate') != '', function ($q) {
                $startdate = Carbon::parse(str_replace('/', '-', request('startdate')))->format('Y-m-d') . ' 00:00:00';
                $enddate = Carbon::parse(str_replace('/', '-', request('enddate')))->format('Y-m-d') . ' 23:59:59';
                return $q->whereBetween('tickets.created_at', [$startdate, $enddate]);
            });
            $Tickets = $query->get();
            return datatables()->of($Tickets)
                ->addColumn('subject', 'reports.ticket_subject')
                ->addColumn('status', 'reports.status.ticket_status')
                ->addColumn('last_replier', 'support.tickets.last_replier')
                ->addColumn('last_activity', 'support.tickets.last_activity')
                ->rawColumns(['subject', 'status', 'last_activity', 'last_replier'])
                ->addIndexColumn()
                ->make(true);
        }
    }

    public function invoiceView()
    {
        $Title = __('page.invoice_reports');
        $Nationalities = Nationalitie::where('status', '1')->get();
        $view = view('reports.invoice_reports', compact('Nationalities'))->render();
        return response()->json(['view' => $view, 'Title' => $Title]);
    }

    public function invoice(Request $request)
    {
        if (request()->ajax()) {
            $params = $request->all();
            $startdate = "";
            $enddate = "";
            $nationality = "";

            $query = Invoice::leftJoin('customers', 'invoices.customer_id', '=', 'customers.id')
                ->select(
                    'invoices.*',
                    'invoices.id as id',
                    'customers.name as customer_name'
                )
                ->orderBy('invoices.id', 'DESC');
            $query->when(request('status') != '', function ($q) {
                return $q->where('invoices.status', request('status'));
            });
            $query->when(request('enddate') != '' && request('startdate') != '', function ($q) {
                $startdate = Carbon::parse(str_replace('/', '-', request('startdate')))->format('Y-m-d') . ' 00:00:00';
                $enddate = Carbon::parse(str_replace('/', '-', request('enddate')))->format('Y-m-d') . ' 23:59:59';
                return $q->whereBetween('invoices.created_at', [$startdate, $enddate]);
            });
            $Invoices = $query->get();
            return datatables()->of($Invoices)
                ->addColumn('balance', 'sales.invoices.invoice_balance')
                ->addColumn('paid', 'sales.invoices.invoice_paid')
                ->addColumn('status', 'sales.invoices.status_label')
                ->rawColumns(['status', 'balance', 'paid'])
                ->addIndexColumn()
                ->make(true);
        }
    }


    public function arrivalReportView()
    {
        $Nationalities = Nationalitie::where('status', '1')->get();
        $Title = __('page.arrival_report');
        $view = view('reports.arrival_reports', compact('Nationalities'))->render();
        return response()->json(['view' => $view, 'Title' => $Title]);
    }

    public function arrivalReport(Request $request)
    {
        if (request()->ajax()) {
            $params = $request->all();
            $query = EmploymentContract::leftJoin('customers', 'employment_contracts.customer_id', '=', 'customers.id')
                ->leftJoin('religions', 'employment_contracts.religion_id', '=', 'religions.id')
                ->leftJoin('nationalities', 'employment_contracts.nationality_id', '=', 'nationalities.id')
                ->leftJoin('offices', 'employment_contracts.office_id', '=', 'offices.id')
                ->leftJoin('cv', 'employment_contracts.cv_id', '=', 'cv.id')
                ->select(
                    'employment_contracts.*',
                    'customers.name as customer_name',
                    'religions.*',
                    'nationalities.*',
                    'offices.name as offfice_name',
                    'employment_contracts.id as id',
                    'employment_contracts.office_id as office_id',
                    'employment_contracts.status as status',
                    'cv.name as cv_name'
                )
                ->where('customers.status', 1)
                ->where('employment_contracts.displayed', 1)
                ->whereNull('customers.deleted_at')
                ->orderBy('employment_contracts.id', 'DESC');
            $query->when(request('nationality_id') != '', function ($q) {
                return $q->where('cv.nationality_id', request('nationality_id'));
            });
            $query->when(request('contract_no') != '', function ($q) {
                return $q->where('employment_contracts.contract_number', request('contract_no'));
            });
            $query->when(request('office_id') != '', function ($q) {
                return $q->where('employment_contracts.office_id', request('office_id'));
            });
            $query->when(request('enddate') != '' && request('startdate') != '', function ($q) {
                $startdate = Carbon::parse(str_replace('/', '-', request('startdate')))->format('Y-m-d') . ' 00:00:00';
                $enddate = Carbon::parse(str_replace('/', '-', request('enddate')))->format('Y-m-d') . ' 23:59:59';
                return $q->whereBetween('employment_contracts.date_of_contract', [$startdate, $enddate]);
            });
            $EmploymentContract = $query->get();
            return datatables()->of($EmploymentContract)
                ->addColumn('nationality', 'office_work.cv.nationality')
                ->addColumn('religion', 'office_work.customers.religion')
                ->addColumn('status', 'reports.status.contract_status')
                ->addColumn('date_of_contract', 'reports.date_of_contract')
                ->addColumn('local_office', 'reports.local_office')
                ->addColumn('outside_office', 'reports.outside_office')
                ->addColumn('arrival_date', function ($EmploymentContract) {
                    return $EmploymentContract->arrival_date ?? '-';
                })
                ->addColumn('arrival_time', function ($EmploymentContract) {
                    return $EmploymentContract->arrival_time ?? '-';
                })
                ->addColumn('ticket', function ($EmploymentContract) {
                    return $EmploymentContract->ticket ?? '-';
                })
                ->rawColumns(['religion', 'status', 'nationality', 'date_of_contract'])
                ->addIndexColumn()
                ->make(true);
        }
    }

}
