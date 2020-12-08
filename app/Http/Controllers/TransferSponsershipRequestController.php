<?php

namespace App\Http\Controllers;

use App\Customer;
use App\TransferOfSponsorshipRequest;

use App\Worker;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Validator;
use Illuminate\Support\Facades\Log;


class TransferSponsershipRequestController extends Controller
{
    public function __construct()
    {
        $this->middleware('role_or_permission:view transfer sponsership request');
        $this->middleware('role_or_permission:create transfer sponsership request', ['only' => ['create', 'store']]);
        $this->middleware('role_or_permission:edit transfer sponsership request', ['only' => ['update', 'edit']]);
        $this->middleware('role_or_permission:delete transfer sponsership request', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if(request()->ajax()) {

            if($request->under_experiment == 1) {
                $TransferOfSponsorshipRequest = TransferOfSponsorshipRequest::
                where('expiration_date_experiment', '>=', \DB::raw('NOW()'))
                ->orderBy('transfer_of_sponsorship_requests.id', 'DESC');
            }else{
                $TransferOfSponsorshipRequest = TransferOfSponsorshipRequest::
                where('expiration_date_experiment', '<', \DB::raw('NOW()'))
                    ->orderBy('transfer_of_sponsorship_requests.id', 'DESC');
            }

            $TransferOfSponsorshipRequest->when(request('startdate'), function ($q) {
                $startdate = Carbon::parse(str_replace('/', '-', request('startdate')))->format('Y-m-d') . ' 00:00:00';
                return $q->where('date_transfer_sponsorship', '>=', $startdate);
            });

            $TransferOfSponsorshipRequest->when(request('enddate'), function ($q) {
                $enddate = Carbon::parse(str_replace('/', '-', request('enddate')))->format('Y-m-d') . ' 23:59:59';
                return $q->where('date_transfer_sponsorship', '<=', $enddate);
            });

            $TransferOfSponsorshipRequest = $TransferOfSponsorshipRequest->get();
            return datatables()->of($TransferOfSponsorshipRequest)
                ->addIndexColumn()
                ->addColumn('worker', function ($TransferOfSponsorshipRequest){
                    return $TransferOfSponsorshipRequest->worker->name ?? '';
                })
                ->addColumn('customer_current', function ($TransferOfSponsorshipRequest){
                    return $TransferOfSponsorshipRequest->customer_current->name ?? '';
                })
                ->addColumn('customer_new', function ($TransferOfSponsorshipRequest){
                    return $TransferOfSponsorshipRequest->customer_new->name ?? '';
                })
                ->addColumn('action', 'transfer_sponsership_requests.action_button')
                ->rawColumns(['action','worker'])
                ->make(true);

        }

        return view('transfer_sponsership_requests.index');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $Workers = Worker::used()->get();
        $Customers = Customer::get();

        $view = view('transfer_sponsership_requests.add',compact('Workers','Customers'))->render();

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
        $validator = Validator::make($request->all(), [
                'worker_id' => 'required',
                'customer_id_current' => 'required',
                'customer_id_new' => 'required',
                'date_transfer_sponsorship' => 'required|date',
                'cost_transfer_sponsorship' => 'required|numeric',
                'expiration_date_experiment' => 'required|date',
                'daily_salary' => 'required',
            ],
            [
                'worker_id.required' => __('message.worker_required'),
                'customer_id_current.required' => __('message.customer_current_required'),
                'customer_id_new.required' => __('message.customer_new_required'),
                'date_transfer_sponsorship.required' => __('message.date_transfer_sponsorship_required'),
                'cost_transfer_sponsorship.required' => __('message.cost_transfer_sponsorship_required'),
                'expiration_date_experiment.required' => __('message.expiration_date_experiment_required'),
                'daily_salary.required' => __('message.daily_salary_required'),

            ]
        );

        if ($validator->passes()) {
            $params = $request->all();
            $TransferOfSponsorshipRequest = TransferOfSponsorshipRequest::create($params);

            if ($TransferOfSponsorshipRequest){
                $now = Carbon::now()->format('MY');

                if($request->attatches) {
                    $imageName = rand() . '_' . $request->attatches->getClientOriginalName();
                    $request->attatches->move(public_path('storage/attatches/' . $now), $imageName);
                    $attatches = 'storage/attatches/' . $now . '/' . $imageName;
                    $TransferOfSponsorshipRequest->attatches = $attatches;
                    unset($params['attatches']);
                }
                $TransferOfSponsorshipRequest->save();
                addToLog('add_transfer_sponsership_request',$TransferOfSponsorshipRequest->id,$TransferOfSponsorshipRequest->id ,'TransferOfSponsorshipRequest');
                return response()->json(['success' => __('message.create_success')]);
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

        $id = $getId;
        if( $id != "" ) {
            $TransferOfSponsorshipRequest = TransferOfSponsorshipRequest::where('id',$id)->first();
            if( $TransferOfSponsorshipRequest ) {
                $Workers = Worker::used($TransferOfSponsorshipRequest->worker_id)->get();
                $Customers = Customer::get();

                $view = view('transfer_sponsership_requests.edit',compact('TransferOfSponsorshipRequest'
                    ,'Workers','Customers'))->render();

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
        $validator = Validator::make($request->all(), [
            'worker_id' => 'required',
            'customer_id_current' => 'required',
            'customer_id_new' => 'required',
            'date_transfer_sponsorship' => 'required|date',
            'cost_transfer_sponsorship' => 'required|numeric',
            'expiration_date_experiment' => 'required|date',
            'daily_salary' => 'required',
        ],
            [
                'worker_id.required' => __('message.worker_required'),
                'customer_id_current.required' => __('message.customer_current_required'),
                'customer_id_new.required' => __('message.customer_new_required'),
                'date_transfer_sponsorship.required' => __('message.date_transfer_sponsorship_required'),
                'cost_transfer_sponsorship.required' => __('message.cost_transfer_sponsorship_required'),
                'expiration_date_experiment.required' => __('message.expiration_date_experiment_required'),
                'daily_salary.required' => __('message.daily_salary'),

            ]
        );

        if ($validator->passes()) {
            $params = $request->all();
            $id = $getId;
            if( $id != "" ) {
                $TransferOfSponsorshipRequest = TransferOfSponsorshipRequest::where('id',$id)->first();

                if( $TransferOfSponsorshipRequest ) {

                    $TransferOfSponsorshipRequest->update($params);
                    $now = Carbon::now()->format('MY');

                    if($request->attatches) {
                        $imageName = $request->attatches->getClientOriginalName();
                        $request->attatches->move(public_path('storage/attatches/' . $now), $imageName);
                        $attatches = 'storage/attatches/' . $now . '/' . $imageName;
                        $TransferOfSponsorshipRequest->attatches = $attatches;
                        unset($params['attatches']);
                    }
                    $TransferOfSponsorshipRequest->save();
                    $params['id'] = $TransferOfSponsorshipRequest->id;
                    addToLog('edit_transfer_sponsership_request',serialize($params),$TransferOfSponsorshipRequest->id ,'TransferOfSponsorshipRequest');
                    return response()->json(['success' => __('message.update_success')]);
                } else {
                    return response()->json(['error' => array('failed' =>  __('message.not_found') )]);
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
        $params = $request->all();
        $id = $params['id'];
        if( $id != "" ) {
            $TransferOfSponsorshipRequest = TransferOfSponsorshipRequest::find($id);
            if( $TransferOfSponsorshipRequest ) {
                $TransferOfSponsorshipRequest->delete();
                addToLog('delete_transfer_sponsership_request',$TransferOfSponsorshipRequest->id,$TransferOfSponsorshipRequest->id ,'TransferOfSponsorshipRequest');
                return response()->json(['success' => __('message.delete_text')]);
            } else {
                return response()->json(['error' => array('failed' =>  __('message.not_found') )]);
            }
        }
        return response()->json(['error' =>   __('message.create_failed')]);
    }


	
}
