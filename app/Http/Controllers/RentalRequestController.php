<?php

namespace App\Http\Controllers;

use App\Customer;
use App\RentalRequest;

use App\Worker;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Validator;
use Illuminate\Support\Facades\Log;


class RentalRequestController extends Controller
{
    public function __construct()
    {
        $this->middleware('role_or_permission:view rental request');
        $this->middleware('role_or_permission:create rental request', ['only' => ['create', 'store']]);
        $this->middleware('role_or_permission:edit rental request', ['only' => ['update', 'edit']]);
        $this->middleware('role_or_permission:delete rental request', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->ajax()) {

            $RentalRequests = RentalRequest::
                whereRaw('NOW() < DATE_ADD(start_rental, INTERVAL +duration_in_month MONTH)')
                ->orderBy('rental_requests.id', 'DESC');
            $RentalRequests->when(request('enddate') != '' && request('startdate') != '', function ($q) {
                $startdate = Carbon::parse(str_replace('/', '-', request('startdate')))->format('Y-m-d') . ' 00:00:00';
                $enddate = Carbon::parse(str_replace('/', '-', request('enddate')))->format('Y-m-d') . ' 23:59:59';
                return $q->whereBetween('start_rental', [$startdate, $enddate]);
            });
            $RentalRequests->get();

            if(request()->expired == 1) {
                $RentalRequestsExpired = RentalRequest::
                whereRaw('NOW() >= DATE_ADD(start_rental, INTERVAL +duration_in_month MONTH)')
                ->orderBy('rental_requests.id', 'DESC');

                $RentalRequestsExpired->when(request('enddate') != '' && request('startdate') != '', function ($q) {
                    $startdate = Carbon::parse(str_replace('/', '-', request('startdate')))->format('Y-m-d') . ' 00:00:00';
                    $enddate = Carbon::parse(str_replace('/', '-', request('enddate')))->format('Y-m-d') . ' 23:59:59';
                    return $q->whereBetween('start_rental', [$startdate, $enddate]);
                });
                $RentalRequestsExpired->get();
                return datatables()->of($RentalRequestsExpired)
                    ->addIndexColumn()
                    ->addColumn('worker', function ($RentalRequestsExpired){
                        return $RentalRequestsExpired->worker->name;
                    })
                    ->addColumn('customer', function ($RentalRequestsExpired){
                        return $RentalRequestsExpired->customer->name??'';
                    })
                    ->addColumn('action', 'rental_requests.action_button')
                    ->rawColumns(['action','worker'])
                    ->make(true);
            }

            return datatables()->of($RentalRequests)
                ->addIndexColumn()
                ->addColumn('worker', function ($RentalRequests){
                    return $RentalRequests->worker->name;
                })
                ->addColumn('customer', function ($RentalRequestsExpired){
                    return $RentalRequestsExpired->customer->name??'';
                })
                ->addColumn('action', 'rental_requests.action_button')
                ->rawColumns(['action','worker'])
                ->make(true);

        }

        return view('rental_requests.index');

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

        $view = view('rental_requests.add',compact('Workers','Customers'))->render();

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
            'customer_id' => 'required',
            'duration_in_month' => 'required',
            'start_rental' => 'required|date',
            'cost' => 'required',
//            'other_cost' => 'required',
//            'attatches' => 'required',
            'total_cost' => 'required',
//            'notes' => 'required',
        ]
        ,[
            'worker_id.required' => __('message.worker_required'),
            'customer_id.required' => __('message.customer_required'),
            'duration_in_month.required' => __('message.duration_in_month_required'),
            'start_rental.required' => __('message.start_rental_required'),
            'cost.required' => __('message.cost_required'),
//            'other_cost.required' => __('message.other_cost_required'),
//            'attatches.required' => __('message.attatches_required'),
            'total_cost.required' => __('message.total_cost_required'),
//            'notes.required' => __('message.notes_required'),
        ]
        );

        if ($validator->passes()) {
            $params = $request->all();
            $RentalRequest = RentalRequest::create($params);

            if ($RentalRequest){
                $now = Carbon::now()->format('MY');

                if($request->attatches) {
                    $imageName = rand() . '_' . $request->attatches->getClientOriginalName();
                    $request->attatches->move(public_path('storage/attatches/' . $now), $imageName);
                    $attatches = 'storage/attatches/' . $now . '/' . $imageName;
                    $RentalRequest->attatches = $attatches;
                    unset($params['attatches']);
                }
                $RentalRequest->save();
                addToLog('add_rental_request',$RentalRequest->id ,$RentalRequest->id,'RentalRequest');
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
            $RentalRequest = RentalRequest::where('id',$id)->first();
            if( $RentalRequest ) {
                $Workers = Worker::used($RentalRequest->worker_id)->get();
                $Customers = Customer::get();

                $view = view('rental_requests.edit',compact('RentalRequest','Workers','Customers'))->render();

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
                'customer_id' => 'required',
                'duration_in_month' => 'required',
                'start_rental' => 'required|date',
                'cost' => 'required',
//            'other_cost' => 'required',
//            'attatches' => 'required',
                'total_cost' => 'required',
//            'notes' => 'required',
            ]
            ,[
                'worker_id.required' => __('message.worker_required'),
                'customer_id.required' => __('message.customer_required'),
                'duration_in_month.required' => __('message.duration_in_month_required'),
                'start_rental.required' => __('message.start_rental_required'),
                'cost.required' => __('message.cost_required'),
//            'other_cost.required' => __('message.other_cost_required'),
//            'attatches.required' => __('message.attatches_required'),
                'total_cost.required' => __('message.total_cost_required'),
//            'notes.required' => __('message.notes_required'),
            ]
        );

        if ($validator->passes()) {
            $params = $request->all();
            $id = $getId;
            if( $id != "" ) {
                $RentalRequest = RentalRequest::where('id',$id)->first();

                if( $RentalRequest ) {

                    $RentalRequest->update($params);
                    $now = Carbon::now()->format('MY');

                    if($request->attatches) {
                        $imageName = rand() . '_' . $request->attatches->getClientOriginalName();
                        $request->attatches->move(public_path('storage/attatches/' . $now), $imageName);
                        $attatches = 'storage/attatches/' . $now . '/' . $imageName;
                        $RentalRequest->attatches = $attatches;
                        unset($params['attatches']);
                    }
                    $RentalRequest->save();
                    $params['id'] = $RentalRequest->id;
                    addToLog('edit_rental_request',serialize($params),$RentalRequest->id ,'RentalRequest');
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
            $RentalRequest = RentalRequest::find($id);
            if( $RentalRequest ) {
                $RentalRequest->delete();
                addToLog('delete_rental_request',$RentalRequest->id ,$RentalRequest->id,'RentalRequest');
                return response()->json(['success' => __('message.delete_text')]);
            } else {
                return response()->json(['error' => array('failed' =>  __('message.not_found') )]);
            }
        }
        return response()->json(['error' =>   __('message.create_failed')]);
    }


	
}
