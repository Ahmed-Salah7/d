<?php

namespace App\Http\Controllers;

use App\Customer;
use App\CustomerDetail;
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
use App\Offices;
use App\Cv;
use App\VisaType;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Validator;
use Illuminate\Support\Facades\Log;
use DB;


class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('role_or_permission:view customer',['only' => ['index']]);
        $this->middleware('role_or_permission:create customer',['only' => ['create','store']]);
        $this->middleware('role_or_permission:edit customer',['only' => ['edit','update']]);
        $this->middleware('role_or_permission:delete customer',['only' => ['destroy']]);
        $this->middleware('role_or_permission:edit customer',['only' => ['customerDetailsUpdate']]);
        $this->middleware('role_or_permission:customer status',['only' => ['statusUpdate']]);
        $this->middleware('role_or_permission:edit customer',['only' => ['getCustomerDetails','customerDetailsUpdate']]);

        $this->middleware('role_or_permission:view contract',['only' => ['employmentContract']]);
        $this->middleware('role_or_permission:view contract',['only' => ['contractList']]);
        $this->middleware('role_or_permission:accept contract',['only' => ['contractStatusUpdate','displayedStatusUpdate']]);
        $this->middleware('role_or_permission:delete contract',['only' => ['destroy_contract']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->middleware('role_or_permission:view customer');

        if(request()->ajax()) {
        $Customers = Customer::leftJoin('nationalities', 'customers.nationality_id', '=', 'nationalities.id')
            ->select(
                    'customers.*',
                    'nationalities.*',
                    'customers.status as status',
                    'customers.id as id'
            )
            ->orderBy('customers.id', 'DESC');
            $Customers->when(request('name') != '', function ($q) {
                return $q->where('name', 'like', '%' . request('name') . '%');
            });
            $Customers->when(request('id_card_number') != '', function ($q) {
                return $q->where('id_card_number', 'like', '%' . request('id_card_number') . '%');
            });
            $Customers->when(request('mobile_number') != '', function ($q) {
                return $q->where('mobile_number', 'like', '%' . request('mobile_number') . '%');
            });

            $Customers = $Customers->get();
        return datatables()->of($Customers)
            ->addColumn('nationality', 'office_work.cv.nationality')
            ->addColumn('action', 'office_work.customers.action_button')
            ->addColumn('status', 'office_work.customers.status_checkbox')
            ->addColumn('procedures', 'office_work.customers.procedures_dropdown')
            ->addColumn('contracts', 'office_work.customers.count_customer_contract')
            ->rawColumns(['action','status','contracts','procedures','nationality'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('office_work.customers.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->middleware('role_or_permission:create customer');
        $Nationalities = Nationalitie::where('status','1')->get();
        $view = view('office_work.customers.add',compact('Nationalities'))->render();

        return response()->json(['view' => $view ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->middleware('role_or_permission:create customer');

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'id_number' => 'required',
        //    'place_of_issue' => 'required',
            'nationality_id' => 'required',
            'mobile_number' => 'required',
            'date_of_birth' => 'required',
        //    'status' => 'required',
        ],[
            'name.required' => __('message.office_name_required'),
            'id_number.required' => __('message.id_number_required'),
        //    'place_of_issue.required' => __('message.place_of_issue_required'),
            'nationality_id.required' => __('message.nationality_required'),
            'mobile_number.required' => __('message.mobile_number_required'),
            'date_of_birth.required' => __('message.date_of_birth_required'),
        //    'status.required' => __('message.status_required'),
        ]);

        if ($validator->passes()) {
            $params = $request->all();
            $data   = array();

            $data['name']           = $params['name'];
            $data['id_number']      = $params['id_number'];
        //    $data['place_of_issue'] = $params['place_of_issue'];
            $data['address'] = $params['address'];
            $data['work_place'] = $params['work_place'];
            $data['nationality_id'] = $params['nationality_id'];
            $data['mobile_number']  = $params['mobile_number'];
            $data['home_number']    = $params['home_number'];
            $data['id_card_number']    = $params['id_card_number'];
            $data['date_of_birth']  = Carbon::parse($params['date_of_birth'])->format('Y-m-d');
        //    $data['status']         = $params['status'];
            $data['status']         = 1;
            $Customer = Customer::create($data);
            if ( $Customer ){
                addToLog('create_customer',$Customer->id,$Customer->id ,'Customer');
                return response()->json(['success' => __('message.customer_create_success')]);
            } else {
                return response()->json(['error' => array('failed' =>  __('message.create_failed') )]);
            }
        }
        return response()->json(['error'=>$validator->errors()->all()]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Customer  $Customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$getId)
    {
        $this->middleware('role_or_permission:edit customer');
        $getId  = explode("-",base64_decode($getId));
        $id = base64_decode($getId['1']);
        if( $id != "" ) {
            $Customer = Customer::where('id',$id)->first();
            if( $Customer ) {
                $Nationalities = Nationalitie::where('status','1')->get();
                $view = view('office_work.customers.edit',compact('Customer','Nationalities'))->render();
                return response()->json(['view' => $view ]);
            } else {
               return response()->json('error', __('message.customer_not_found'));
            }
        }
        return response()->json('error',  __('message.create_failed'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Customer  $Customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $getId)
    {
        $this->middleware('role_or_permission:edit customer');
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'id_number' => 'required',
        //    'place_of_issue' => 'required',
            'nationality_id' => 'required',
            'mobile_number' => 'required',
            'date_of_birth' => 'required',
            'status' => 'required',
        ],[
            'name.required' => __('message.office_name_required'),
            'id_number.required' => __('message.id_number_required'),
            'place_of_issue.required' => __('message.place_of_issue_required'),
            'nationality_id.required' => __('message.nationality_required'),
            'mobile_number.required' => __('message.mobile_number_required'),
            'date_of_birth.required' => __('message.date_of_birth_required'),
            'status.required' => __('message.status_required'),
        ]);

        if ($validator->passes()) {
            $params = $request->all();
            $data   = array();
            $getId  = explode("-",base64_decode($getId));
            $id = base64_decode($getId['1']);
            if( $id != "" ) {
                $Customer = Customer::where('id',$id)->first();

                if( $Customer ) {
                    $data['name']           = $params['name'];
                    $data['id_number']      = $params['id_number'];
                //    $data['place_of_issue'] = $params['place_of_issue'];
                    $data['address'] = $params['address'];
                    $data['work_place'] = $params['work_place'];
                    $data['nationality_id'] = $params['nationality_id'];
                    $data['mobile_number']  = $params['mobile_number'];
                    $data['home_number']    = $params['home_number'];
                    $data['date_of_birth']  = Carbon::parse($params['date_of_birth'])->format('Y-m-d');
                    $data['status']         = $params['status'];
                    $data['id_card_number']    = $params['id_card_number'];
                    $Customer->update($data);

                    $data['id'] = $Customer->id;
                    addToLog('update_customer',serialize($data),$Customer->id,'Customer' );
                    return response()->json(['success' => __('message.customer_update_success')]);
                } else {
                    return response()->json(['error' => array('failed' =>  __('message.customer_not_found') )]);
                }
            }
           return response()->json(['error' => array('failed' =>  __('message.create_failed') )]);
        }
        return response()->json(['error'=>$validator->errors()->all()]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Customer  $Customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $this->middleware('role_or_permission:delete customer');
        $params = $request->all();
        $getId  = explode("-",base64_decode($params['id']));
        $id = base64_decode($getId['1']);
        if( $id != "" ) {
            $Customer = Customer::find($id);
            if( $Customer ) {
                $Customer->delete();
                addToLog('delete_customer',$Customer->id,$Customer->id ,'Customer');
                return response()->json(['success' => __('message.delete_text')]);
            } else {
                return response()->json(['error' => array('failed' =>  __('message.customer_not_found') )]);
            }
        }
        return response()->json(['error' =>   __('message.create_failed')]);
    }

    public function statusUpdate(Request $request)
    {
        $params = $request->all();
        $getId  = explode("-",base64_decode($params['id']));
        $id = base64_decode($getId['1']);
        if( $id != "" ) {
            $Customer = Customer::find($id);
            if( $Customer ) {
                $Customer->update(['status'=>$params['status']]);
                addToLog('customer_status_update',json_encode(array("customer_id"=>$Customer->id,'status'=>$params['status']) ),$id,'Customer');
                if( $params['status'] == '1' ){
                    return response()->json(['success' => __('message.customer_status_active_success') ]);
                } else {
                     return response()->json(['success' => __('message.customer_status_deactive_success') ]);
                }
            } else {
                return response()->json(['error' => __('message.customer_not_found')]);
            }
        }
        return response()->json(['error' =>   __('message.create_failed')]);
    }

    public function getCustomerDetails(Request $request,$getId)
    {
        $getId  = explode("-",base64_decode($getId));
        $id = base64_decode($getId['1']);
        if( $id != "" ) {
            $Customer = Customer::where('id',$id)->first();
            $CustomerDetail = CustomerDetail::where('customer_id',$id)->first();
             $Nationalities = Nationalitie::where('status','1')->get();
            if( $Customer ) {
                $view = view('office_work.customers.details',compact('Customer','CustomerDetail','Nationalities'))->render();
                return response()->json(['view' => $view ]);
            } else {
               return response()->json('error', __('message.customer_not_found'));
            }
        }
        return response()->json('error',  __('message.create_failed'));
    }

    public function customerDetailsUpdate(Request $request, $getId)
    {
        $params = $request->all();
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'id_number' => 'required',
            'nationality_id' => 'required',
            'mobile_number' => 'required',
//            'status' => 'required',
        ],[
            'name.required' => __('message.office_name_required'),
            'id_number.required' => __('message.id_number_required'),
            'nationality_id.required' => __('message.nationality_required'),
            'mobile_number.required' => __('message.mobile_number_required'),
//            'status.required' => __('message.status_required'),
        ]);
        if ($validator->passes()) {
            $params = $request->all();
            $data   = array();
            $getId  = explode("-",base64_decode($getId));
            $id = base64_decode($getId['1']);
            if( $id != "" ) {
                $Customer = Customer::where('id',$id)->first();

                if( $Customer ) {
                    $data['name']           = $params['name'];
                    $data['id_number']      = $params['id_number'];
                    $data['nationality_id'] = $params['nationality_id'];
                    $data['mobile_number']  = $params['mobile_number'];
                    $data['id_card_number'] = $params['id_card_number'];
                    $data['work_place']     = $params['work_place'];

                    $Customer->update($data);

                    $customer_details = $params['customer_details'];
                    if( isset($params['expiry_date']) && $params['expiry_date'] !="" ) {
                        $customer_details['expiry_date'] = Carbon::parse($params['expiry_date'])->format('Y-m-d');
                    }
                    if( isset($params['release_date']) && $params['release_date'] !="" ) {
                        $customer_details['release_date'] = Carbon::parse($params['release_date'])->format('Y-m-d');
                    }

                    $data['id'] = $Customer->id;
                    $CustomerDetail = CustomerDetail::updateOrCreate([ 'customer_id' => $Customer->id ],$customer_details);

                    $now = Carbon::now()->format('MY');

                    if($request->attatches) {
                        $imageName = rand() . '_' . $request->attatches->getClientOriginalName();
                        $request->attatches->move(public_path('storage/attatches/' . $now), $imageName);
                        $attatches = 'storage/attatches/' . $now . '/' . $imageName;
                        $CustomerDetail->attatches = $attatches;
                        unset($params['attatches']);
                    }

                    if($request->id_card_image) {
                        $imageName = rand() . '_' . $request->id_card_image->getClientOriginalName();
                        $request->id_card_image->move(public_path('storage/id_card_image/' . $now), $imageName);
                        $id_card_image = 'storage/id_card_image/' . $now . '/' . $imageName;
                        $CustomerDetail->id_card_image = $id_card_image;
                        unset($params['id_card_image']);
                    }
                    $CustomerDetail->save();
                    $userAllData = array('customer'=>$data,'customer_details'=>$customer_details);
                    addToLog('update_customer_details',serialize($userAllData),$Customer->id ,'Customer');

                   return response()->json(['success' => __('message.customer_details_update_success')]);
                } else {
                    return response()->json(['error' => array('failed' =>  __('message.customer_not_found') )]);
                }
            }
            return response()->json('error',  __('message.create_failed'));
        }
        return response()->json(['error'=>$validator->errors()->all()]);
    }

    public function getCustomerContracts($getId)
    {
        $this->middleware('role_or_permission:create contract');
        $getId  = explode("-",base64_decode($getId));
        $id = base64_decode($getId['1']);
        $contractId = "";
        if(isset($getId['2']) && $getId['2'] !="" ) {
            $contractId = base64_decode($getId['2']);
        }

        if( $id != "" ) {
            if(isset($contractId) && $contractId !="" ) {
                $EmploymentContract = EmploymentContract::where('id',$contractId)->first();
            } else {
                $EmploymentContract = EmploymentContract::where('customer_id',$id)->latest()->first();
            }
            $Customer = Customer::where('id',$id)->first();
            $Professions = Profession::get();
            $Nationalities = Nationalitie::where('status','1')->get();
            $Destinations = Destination::get();
            $ContractSources = ContractSource::get();
            $Airports = Airport::get();
            $Religions = Religion::get();
            $TermsAndAdvantages = TermsAndAdvantage::get();
            $QualificationsAndExperiences = QualificationsAndExperience::get();
            $CostCenters = CostCenter::get();
            $Marketers = Marketer::get();
            $Offices = Offices::where('status',1)->get();
            $EmploymentContractID =  EmploymentContract::select('cv_id')->whereNotNull('cv_id')->where('id','!=',$contractId)->get()->toArray();
            $EmploymentContractID =  array_values($EmploymentContractID);
            $CV = Cv::where('status',1)->whereNotIn('id', $EmploymentContractID)->get();
	    
            $Status = Status::orderBy('office_type', 'ASC')->get();
            $VisaTypes = VisaType::get();
            if( $Customer ) {
            	$view = view('office_work.customers.contract',compact('VisaTypes','Customer','EmploymentContract','Professions','Nationalities','Destinations','ContractSources','Airports','Religions','TermsAndAdvantages','QualificationsAndExperiences','CostCenters','Marketers','Status','Offices','CV'))->render();
                return response()->json(['view' => $view ]);
            } else {
               return response()->json('error', __('message.customer_not_found'));
            }
        }
        return response()->json('error',  __('message.create_failed'));
    }

    public function getContractStatus($id)
    {
        if( $id != "" ) {
            $Status = Status::orderBy('office_type', 'ASC')->get();
            $view = view('office_work.customers.contract_status',compact('id','Status'))->render();
            return response()->json(['view' => $view ]);
        }
        return response()->json('error',  __('message.create_failed'));
    }
    public function employmentContract(Request $request, $getId)
    {
        $params = $request->all();
        $employmentContract   = array();
        $getId  = explode("-",base64_decode($getId));
        $id = base64_decode($getId['1']);
        if( $id != "" ) {

                $Customer = Customer::where('id',$id)->first();
                if( $Customer ) {
                    $employmentContract =  $params['employment_Contract'];

                    if( isset($params['date']['date_of_contract']) && $params['date']['date_of_contract'] !="" ) {
                       // $employmentContract['date_of_contract'] = Carbon::parse($params['date']['date_of_contract'])->format('Y-m-d');
                        $employmentContract['date_of_contract'] =$params['date']['date_of_contract'];
                    }
                    if( isset($params['date']['visa_date']) && $params['date']['visa_date'] !="" ) {
                        $employmentContract['visa_date'] = Carbon::parse($params['date']['visa_date'])->format('Y-m-d');
                    }
                    if( isset($params['date']['corresponding_to_ad']) && $params['date']['corresponding_to_ad'] !="" ) {
                        $employmentContract['corresponding_to_ad'] = Carbon::parse($params['date']['corresponding_to_ad'])->format('Y-m-d');
                    }
//                    if( isset($params['date']['arrival_date']) && $params['date']['arrival_date'] !="" ) {
                    $employmentContract['arrival_date'] = $params['date']['arrival_date'];
//                    }
                    if( isset($request->notes) ) {
                        $employmentContract['notes'] =  $request->notes;
                    }
                    if( isset($params['extradata'])  ) {
                        $employmentContract['extradata'] = json_encode($params['extradata']);
                    }
                    if( isset($params['employment_contract'])) {
                        $employmentContract['customer_id'] = $id;
                        $emp_contract = EmploymentContract::Create($employmentContract,$params['employment_contract_id']);
                    } else {
                        if( isset($params['employment_contract_id']) && $params['employment_contract_id'] !="" ) {
                            $emp_contract = EmploymentContract::updateOrCreate([ 'id' =>$params['employment_contract_id'] ],$employmentContract);
                        } else {
                            $emp_contract =  EmploymentContract::updateOrCreate([ 'customer_id' => $Customer->id ],$employmentContract);
                        }
                    }
                    addToLog('employment_contract',serialize($employmentContract) ,$emp_contract->id,'EmploymentContract');

                    return response()->json(['success' => __('message.contract_save_success')]);
                } else {
                    return response()->json(['error' => array('failed' =>  __('message.customer_not_found') )]);
                }
        }
        return response()->json('error',  __('message.create_failed'));

    }

    public function contractList()
    { // approval  overduecontracts  arrivals

        if(request()->ajax()) {
        $query = EmploymentContract::leftJoin('customers', 'employment_contracts.customer_id', '=', 'customers.id')
        ->leftJoin('religions', 'employment_contracts.religion_id', '=', 'religions.id')
        ->leftJoin('cv', 'employment_contracts.cv_id', '=', 'cv.id')
        ->leftJoin('nationalities', 'employment_contracts.nationality_id', '=', 'nationalities.id')
        ->select(
                'employment_contracts.*',
                'customers.name as customer_name',
                'religions.*',
                'employment_contracts.id as id',
				'cv.name as cv_name',
				'nationalities.state as nationality'
        )
        ->where('customers.status',1)
        ->whereNull('customers.deleted_at')
        ->orderBy('employment_contracts.id', 'DESC');

        $query->when(request('c_id') != '', function ($q) {
            return $q->where('employment_contracts.customer_id', request('c_id'));
        });

        $query->when(request('compleated'), function ($q) {
            return $q->where('employment_contracts.compleated', 1);
        });
        $query->when(!request('compleated'), function ($q) {
            return $q->where('employment_contracts.compleated', 0);
        });

        $query->when(request('approved') != '', function ($q) {
            return $q->where('employment_contracts.status', '1');
        });

        $query->when(request('approval') != '', function ($q) {
             $getId  = explode("-",base64_decode(request('approval')));
             $id = base64_decode($getId['1']);
            return $q->where('employment_contracts.status', $id)->orWhereNull('employment_contracts.status');
        });
        $query->when(request('overduecontracts') != '', function ($q) {
            return $q->where('employment_contracts.date_of_contract','<=', Carbon::now()->subDays(90)->toDateString())->where('employment_contracts.status','1');
        });
        $query->when(request('underwarranty') != '', function ($q) {
            return $q->where('employment_contracts.arrival_date', '<=', Carbon::now()->toDateString())->where('employment_contracts.arrival_date', '>=', Carbon::now()->subDays(90)->toDateString())->where('employment_contracts.status',1);
			//
        });
        $query->when(request('arrivals') != '', function ($q) {
            return $q->whereDate('arrival_date','>=', Carbon::now()->format('Y-m-d'))->where('employment_contracts.status','1');
        });

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
		$c = 0;
		foreach($EmploymentContract as $e) {
			$EmploymentContract[$c]['test_hij'] =$this->Greg2Hijri($e->date_of_contract);
			$c++;
		}

		//var_dump($EmploymentContract);
		//Log::info(json_encode($EmploymentContract));
        return datatables()->of($EmploymentContract)
            ->addColumn('religion', 'office_work.customers.religion')
            ->addColumn('status', 'office_work.customers.contract_status_checkbox')
            ->addColumn('displayed', 'office_work.customers.displayed_status_checkbox')
            ->addColumn('action', 'office_work.customers.contract_action')
            ->addColumn('local', 'reports.local_office')
//            ->addColumn('outside', 'reports.outside_office')
            ->addColumn('airport_id', function ($EmploymentContract){
                $airport_name = isset($EmploymentContract->airport)?   (Session::get('locale') =='en') ? $EmploymentContract->airport->airport_english : $EmploymentContract->airport->airport:'-';
                return $airport_name;
            })
            ->addColumn('outside', function ($EmploymentContract){
                $outside = isset($EmploymentContract->office)?   $EmploymentContract->office->name:'-';
                return $outside;
            })
            ->addColumn('profession', function ($EmploymentContract){
                $outside = isset($EmploymentContract->profession)?   $EmploymentContract->profession->occupation:'-';
                return $outside;
            })
            ->addColumn('source', function ($EmploymentContract){
                $outside = isset($EmploymentContract->source)?   $EmploymentContract->source->source:'-';
                return $outside;
            })
            ->addColumn('remainder_contract', function ($EmploymentContract){
// modat el contract - 3dd el ayam men tarehk el contract

                $date = $EmploymentContract->date_of_contract ?? 0;
                $duration_of_the_contract = (integer) $EmploymentContract->duration_of_the_contract ?? 0;

                $date_of_contract = strtotime($date); // convert to timestamps
                $currentDate = strtotime(now()); // convert to timestamps
                $diffDays = (int)(($currentDate - $date_of_contract)/86400);
                $remainder_contract_in_days = $duration_of_the_contract - $diffDays;
                $remainder_contract_in_days = ($remainder_contract_in_days > 0) ? $remainder_contract_in_days: 0;

                $message = (Session::get('locale') =='en') ? ' day' : ' يوم' ;
                return  $remainder_contract_in_days . $message;
            })
            ->rawColumns(['religion','status','displayed','action'])
            ->addIndexColumn()
            ->make(true);
        }
       $Nationalities = Nationalitie::get();

       if(request('arrivals')){
           return view('office_work.customers.contract_list_arrivals',compact('Nationalities'));
       }
        return view('office_work.customers.contract_list',compact('Nationalities'));
    }

    public function contractStatusUpdate(Request $request)
    {
        $params = $request->all();
        $getId  = explode("-",base64_decode($params['id']));
        $id = base64_decode($getId['1']);
        if( \Auth()->user()->role_id == 1 ){
             if( $id != "" ) {
                $EmploymentContract = EmploymentContract::find($id);
                if( $EmploymentContract ) {
                    $EmploymentContract->update(['status'=>$params['status']]);
                    addToLog('employment_contract_sataus',json_encode(array("customer_id"=>$EmploymentContract->customer_id,'status'=>$params['status']) ),$id,'EmploymentContract');
                   if( $params['status'] == '1' ){
                        $status = __('message.contract_status_accept');
                        return response()->json(['success' =>'<a href="'.url("/").'" class="success-status">'.$status.'</a>' ]);
                    } else {
                        $status = __('message.contract_status_reject');
                        return response()->json(['success' =>'<a href="'.url("/").'" class="success-status">'.$status.'</a>' ]);
                    }
                } else {
                    return response()->json(['error' =>  __('message.contract_not_found')]);
                }
            }
            return response()->json(['error' =>  __('message.create_failed')]);
        } else {
             return response()->json(['error' =>  __('message.access_is_denied')]);
        }
    }

    public function displayedStatusUpdate(Request $request)
    {
        $params = $request->all();
        $getId  = explode("-",base64_decode($params['id']));
        $id = base64_decode($getId['1']);
        if( \Auth()->user()->role_id == 1 ){
             if( $id != "" ) {
                $EmploymentContract = EmploymentContract::find($id);
                if( $EmploymentContract ) {
                    $EmploymentContract->update(['displayed'=>$params['displayed']]);
                    addToLog('employment_contract_displayed_sataus',json_encode(array("customer_id"=>$EmploymentContract->customer_id,'displayed'=>$params['displayed']) ),$id,'EmploymentContract');

                    if( $params['displayed'] == '1' ){
                        return response()->json(['success' => __('message.show_in_report') ]);
                    } else {
                        return response()->json(['success' => __('message.not_show_in_report') ]);
                    }
                } else {
                    return response()->json(['error' =>  __('message.contract_not_found')]);
                }
            }
            return response()->json(['error' =>  __('message.create_failed')]);
        } else {
             return response()->json(['error' =>  __('message.access_is_denied')]);
        }
    }
	
	function intPart($float)
	{
		if ($float < -0.0000001)
			return ceil($float - 0.0000001);
		else
			return floor($float + 0.0000001);
	}

	function Greg2Hijri($date)
	{
		if(!$date)
			return $date;
		
		$string = false;
		$day = substr($date,7,2);
		$month = substr($date,4,2);
		$year = substr($date,0,4);
		$day   = (int) $day;
		$month = (int) $month;
		$year  = (int) $year;

		if (($year > 1582) or (($year == 1582) and ($month > 10)) or (($year == 1582) and ($month == 10) and ($day > 14)))
		{
			$jd = $this->intPart((1461*($year+4800+$this->intPart(($month-14)/12)))/4)+$this->intPart((367*($month-2-12*($this->intPart(($month-14)/12))))/12)-
			$this->intPart( (3* ($this->intPart(  ($year+4900+    $this->intPart( ($month-14)/12)     )/100)    )   ) /4)+$day-32075;
		}
		else
		{
			$jd = 367*$year-$this->intPart((7*($year+5001+$this->intPart(($month-9)/7)))/4)+$this->intPart((275*$month)/9)+$day+1729777;
		}

		$l = $jd-1948440+10632;
		$n = $this->intPart(($l-1)/10631);
		$l = $l-10631*$n+354;
		$j = ($this->intPart((10985-$l)/5316))*($this->intPart((50*$l)/17719))+($this->intPart($l/5670))*($this->intPart((43*$l)/15238));
		$l = $l-($this->intPart((30-$j)/15))*($this->intPart((17719*$j)/50))-($this->intPart($j/16))*($this->intPart((15238*$j)/43))+29;
    
		$month = $this->intPart((24*$l)/709);
		$day   = $l-$this->intPart((709*$month)/24);
		$year  = 30*$n+$j-30;
    
		$date = array();
		$date['year']  = $year;
		$date['month'] = $month;
		$date['day']   = $day;

		if (!$string)
			return $year.'-'.$month.'-'.$day;
		else
			return     "{$year}-{$month}-{$day}";
	}

    public function destroy_contract(Request $request)
    {
        $params = $request->all();
        $id = $params['id'];
        if( $id != "" ) {
            $EmploymentContract = EmploymentContract::find($id);
            if( $EmploymentContract ) {
                $EmploymentContract->delete();
                addToLog('delete_EmploymentContract',$EmploymentContract->id,$EmploymentContract->id,'EmploymentContract' );
                return response()->json(['success' => __('message.delete_text')]);
            } else {
                return response()->json(['error' => array('failed' =>  __('message.not_found') )]);
            }
        }
        return response()->json(['error' =>   __('message.create_failed')]);
    }

    public function select_nationality($nationality_id){
        $Cvs = Cv::where('nationality_id' , $nationality_id)->used()->get();
        $view = view('office_work.customers.cvs',compact('Cvs'))->render();
        return response()->json(['view' => $view ]);
    }

    public function select_cv($cv_id){

        $Cv = Cv::where('id' , $cv_id)->first();


        return response()->json([
            'religion_id'    => $Cv->religion_id,
            'profession_id'  => $Cv->profession_id,
            'office_id'      => $Cv->office_id,
            'age'            => $Cv->age,
        ]);
    }


}
