<?php

namespace App\Http\Controllers;

use App\VisaType;
use App\Worker;
use Illuminate\Http\Request;
use App\Customer;
use App\EmploymentContract;
use App\Profession;
use App\Nationalitie;
use App\Destination;
use App\ContractSource;
use App\Airport;
use App\Religion;
use App\TermsAndAdvantage;
use App\QualificationsAndExperience;
use App\CostCenter;
use App\Currencie;
use App\Marketer;
use App\Status;
use App\Cv;
use App\Offices;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use DB;

class DashboardController extends Controller
{
    public function index()
    {

        $totalContractsGrouped = EmploymentContract::where('status', 1)
            ->get()
            ->groupBy(function ($val) {
                return Carbon::parse($val->created_at)->format('Y');
            })->toArray();

        $workersCount = Worker::used()->get()->count();
        $TotlaCustomer = Customer::count();
        $TotlaCV = Cv::count();
        $TotalApproval = EmploymentContract::where('status', 2)->orWhereNull('status')->count();
        $TotalContracts = EmploymentContract::where('status', 1)->count();
        $TotalOverdueContracts = EmploymentContract::where('date_of_contract', '<=', Carbon::now()->subDays(90)->toDateString())->where('status', '1')->count();
        $TotalArrivals = EmploymentContract::whereDate('arrival_date', '>=', Carbon::now()->format('Y-m-d'))->where('status', '1')->where('status', 1)->count();
        $UnderWarranty = EmploymentContract::where('arrival_date', '<=', Carbon::now()->toDateString())->where('arrival_date', '>=', Carbon::now()->subDays(90)->toDateString())->where('status', 1)->count();
        $newContaract = EmploymentContract::where('arrival_date', '<=', Carbon::now()->toDateString())->where('date_of_contract', '>=', Carbon::now()->subDays(90)->toDateString())->where('status', 1)->count();
        return view('dashboard.index', compact('workersCount','totalContractsGrouped', 'TotlaCustomer', 'TotalApproval', 'TotalContracts', 'TotalOverdueContracts', 'TotlaCV', 'UnderWarranty', 'TotalArrivals'));
    }

    public function getCustomerContracts()
    {
        /*$EmploymentContract = EmploymentContract::select('customer_id')->get()->toArray();*/
        $Customers = Customer::where('status', 1)->get();
        $EmploymentContract = array();
        $Professions = Profession::get();
        $Nationalities = Nationalitie::where('status', 1)->get();
        $Destinations = Destination::get();
        $ContractSources = ContractSource::get();
        $Airports = Airport::get();
        $Religions = Religion::get();
        $TermsAndAdvantages = TermsAndAdvantage::get();
        $QualificationsAndExperiences = QualificationsAndExperience::get();
        $CostCenters = CostCenter::get();
        $Marketers = Marketer::get();
        $Status = Status::orderBy('office_type', 'DESC')->get();
        $Offices = Offices::where('status', 1)->get();
        $CV = Cv::used()->where('status', 1)->get();
        $VisaTypes = VisaType::get();
        $view = view('office_work.customers.contract', compact('VisaTypes','Customers', 'EmploymentContract', 'Professions', 'Nationalities', 'Destinations', 'ContractSources', 'Airports', 'Religions', 'TermsAndAdvantages', 'QualificationsAndExperiences', 'CostCenters', 'Marketers', 'Status', 'Offices', 'CV'))->render();
        return response()->json(['view' => $view]);
    }
}
