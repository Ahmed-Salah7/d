<?php

namespace App\Http\Controllers;

use App\LogActivity;
use App\AccoumodationType;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ActivityLogController extends Controller
{
    public function __construct()
    {
        $this->middleware('role_or_permission:view activity log');
    }

    public function index()
    {

        if(request()->ajax()) {
            if(\Auth()->user()->role_id == 1) {
                $LogActivity = LogActivity::orderBy('id', 'DESC')->get();
            } else {
                $LogActivity = LogActivity::where('user_id',\Auth()->user()->id)->orderBy('id', 'DESC')->get();
            }
            return datatables()->of($LogActivity)
            ->addColumn('activity_log_key', 'basic.activity_log.activity_log_key')
            ->addColumn('identifier', function ($LogActivity){
                $model = $LogActivity->model;
                if(!empty($model)) {
                    $model = '\\App\\'.$model;
                    $m = $model::find($LogActivity->model_id);

                    if(!empty($m)) {
                        if($LogActivity->model == 'AccoumodationType' || $LogActivity->model == 'Countrys'
                            || $LogActivity->model == 'Customer'|| $LogActivity->model == 'Cv'
                            || $LogActivity->model == 'Offices'|| $LogActivity->model == 'Status'
                            || $LogActivity->model == 'User'|| $LogActivity->model == 'VisaType'
                            || $LogActivity->model == 'Worker') {
                            return $m->name;
                        }elseif ($LogActivity->model == 'Airport'){
                            return $m->airport;
                        }elseif ($LogActivity->model == 'ContractSource'){
                            return $m->source;
                        }elseif ($LogActivity->model == 'CostCenter'){
                            return $m->center_name;
                        }elseif ($LogActivity->model == 'CostCenter'){
                            return $m->center_name;
                        }elseif ($LogActivity->model == 'Currencie'){
                            return $m->currency_name;
                        }elseif ($LogActivity->model == 'Destination'){
                            return $m->destination;
                        }elseif ($LogActivity->model == 'EmploymentContract'){
                            return $m->contract_number;
                        }elseif ($LogActivity->model == 'Invoice'){
                            return $m->date;
                        }elseif ($LogActivity->model == 'InvoiceItem'){
                            return $m->item_descriptions;
                        }elseif ($LogActivity->model == 'invoicePayment'){
                            return $m->date;
                        }elseif ($LogActivity->model == 'Marketer'){
                            return $m->marketer;
                        }elseif ($LogActivity->model == 'Nationalitie'){
                            return $m->nationality;
                        }elseif ($LogActivity->model == 'Profession'){
                            return $m->occupation;
                        }elseif ($LogActivity->model == 'QualificationsAndExperience'){
                            return $m->qualifications_and_experience;
                        }elseif ($LogActivity->model == 'Relay'){
                            return $m->passport_number;
                        }elseif ($LogActivity->model == 'Religion'){
                            return $m->religion;
                        }elseif ($LogActivity->model == 'RentalRequest'){
                            return $m->start_rental;
                        }elseif ($LogActivity->model == 'TermsAndAdvantage'){
                            return $m->terms_and_advantage;
                        }elseif ($LogActivity->model == 'Ticket'){
                            return $m->ticket_number;
                        }elseif ($LogActivity->model == 'TransferOfSponsorshipRequest'){
                            return $m->date_transfer_sponsorship;
                        }
                    }
                }
                return '';
            })
            ->editColumn('created_at', function ($request) {
                return $request->created_at->format('Y-m-d g:i a' ?? ''); // human readable format
            })
            ->rawColumns(['activity_log_key'])
            ->addIndexColumn()
            ->make(true);
        }

        return view('basic.activity_log.index');
    }
}
