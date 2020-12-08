<?php

namespace App\Http\Controllers;

use App\AccoumodationType;
use App\Relay;
use App\RentalRequest;
use App\TransferOfSponsorshipRequest;
use App\Worker;
use Illuminate\Http\Request;

class AccoumodationController extends Controller
{
    public function __construct()
    {
        $this->middleware('role_or_permission:view accommodation');
    }
    public function accommodation(){
        $workersCount = Worker::used()->get()->count();

        $AccoumodationTypesCount = AccoumodationType::get()->count();

        $RentalRequestsExpiredCount = RentalRequest::
            whereRaw('NOW() >= DATE_ADD(start_rental, INTERVAL +duration_in_month MONTH)')
            ->count();


        $RentalRequestsCount = RentalRequest::
            whereRaw('NOW() < DATE_ADD(start_rental, INTERVAL +duration_in_month MONTH)')
            ->count();

        $TransferOfSponsorshipRequestCount = TransferOfSponsorshipRequest::get()->count();

        $TransferOfSponsorship_UnderExperimentRequestCount = TransferOfSponsorshipRequest::
        where('expiration_date_experiment', '>=', \DB::raw('NOW()'))->get()->count();

        $RelayCount = Relay::get()->count();

        return view('dashboard.accommodation',compact('workersCount','AccoumodationTypesCount'
            ,'RentalRequestsCount','TransferOfSponsorshipRequestCount','RelayCount'
            ,'TransferOfSponsorship_UnderExperimentRequestCount','RentalRequestsExpiredCount'));

    }
}
