<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Relay;

use App\Worker;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Validator;


class RelayController extends Controller
{
    public function __construct()
    {
        $this->middleware('role_or_permission:view relay');
        $this->middleware('role_or_permission:create relay', ['only' => ['create', 'store']]);
        $this->middleware('role_or_permission:edit relay', ['only' => ['update', 'edit']]);
        $this->middleware('role_or_permission:delete relay', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->ajax()) {

            $Relay = Relay::orderBy('relays.id', 'DESC');
            $Relay->when(request('enddate') != '' && request('startdate') != '', function ($q) {
                $startdate = Carbon::parse(str_replace('/', '-', request('startdate')))->format('Y-m-d') . ' 00:00:00';
                $enddate = Carbon::parse(str_replace('/', '-', request('enddate')))->format('Y-m-d') . ' 23:59:59';
                return $q->whereBetween('date_deportation', [$startdate, $enddate]);
            });
            $Relay->get();
            return datatables()->of($Relay)
                ->addIndexColumn()
                ->addColumn('worker', function ($Relay){
                    return $Relay->worker->name ?? '';
                })
                ->addColumn('customer', function ($Relay){
                    return $Relay->customer->name ?? '';
                })
                ->addColumn('action', 'relays.action_button')
                ->rawColumns(['action','worker','customer'])
                ->make(true);

        }

        return view('relays.index');

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

        $view = view('relays.add',compact('Workers','Customers'))->render();

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
            'contract_number' => 'required|numeric',
            'passport_number' => 'required',
            'customer_id' => 'required',
            'reason_deportation' => 'required',
            'date_deportation' => 'required|date',
        ]
        ,[
            'worker_id.required' => __('message.worker_required'),
            'contract_number.required' => __('message.contract_number_required'),
            'passport_number.required' => __('message.passport_number_required'),
            'customer_id.required' => __('message.customer_required'),
            'reason_deportation.required' => __('message.reason_deportation_required'),
            'date_deportation.required' => __('message.date_deportation_required'),
        ]
        );

        if ($validator->passes()) {
            $params = $request->all();
            $Relay = Relay::create($params);

            if ($Relay){
                $now = Carbon::now()->format('MY');

                if($request->attatches) {
                    $imageName = rand() . '_' . $request->attatches->getClientOriginalName();
                    $request->attatches->move(public_path('storage/attatches/' . $now), $imageName);
                    $attatches = 'storage/attatches/' . $now . '/' . $imageName;
                    $Relay->attatches = $attatches;
                    unset($params['attatches']);
                }
                $Relay->save();
                addToLog('add_relay',$Relay->id,$Relay->id ,'Relay');
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
            $Relay = Relay::where('id',$id)->first();
            if( $Relay ) {
                $Workers = Worker::used($Relay->worker_id)->get();
                $Customers = Customer::get();

                $view = view('relays.edit',compact('Relay','Workers','Customers'))->render();

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
                'contract_number' => 'required|numeric',
                'passport_number' => 'required',
                'customer_id' => 'required',
                'reason_deportation' => 'required',
                'date_deportation' => 'required|date',
            ]
            ,[
                'worker_id.required' => __('message.worker_required'),
                'contract_number.required' => __('message.contract_number_required'),
                'passport_number.required' => __('message.passport_number_required'),
                'customer_id.required' => __('message.customer_required'),
                'reason_deportation.required' => __('message.reason_deportation_required'),
                'date_deportation.required' => __('message.date_deportation_required'),
            ]
        );

        if ($validator->passes()) {
            $params = $request->all();
            $id = $getId;
            if( $id != "" ) {
                $Relay = Relay::where('id',$id)->first();

                if( $Relay ) {

                    $Relay->update($params);
                    $now = Carbon::now()->format('MY');

                    if($request->attatches) {
                        $imageName = rand() . '_' . $request->attatches->getClientOriginalName();
                        $request->attatches->move(public_path('storage/attatches/' . $now), $imageName);
                        $attatches = 'storage/attatches/' . $now . '/' . $imageName;
                        $Relay->attatches = $attatches;
                        unset($params['attatches']);
                    }
                    $Relay->save();
                    $params['id'] = $Relay->id;
                    addToLog('edit_relay',serialize($params),$Relay->id ,'Relay');
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
            $Relay = Relay::find($id);
            if( $Relay ) {
                $Relay->delete();
                addToLog('delete_relay',$Relay->id,$Relay->id,'Relay' );
                return response()->json(['success' => __('message.delete_text')]);
            } else {
                return response()->json(['error' => array('failed' =>  __('message.not_found') )]);
            }
        }
        return response()->json(['error' =>   __('message.create_failed')]);
    }


	
}
