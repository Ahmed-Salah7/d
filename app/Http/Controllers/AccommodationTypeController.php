<?php

namespace App\Http\Controllers;

use App\Customer;
use App\AccoumodationType;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Validator;
use Illuminate\Support\Facades\Log;


class AccommodationTypeController extends Controller
{

    public function __construct()
    {
        $this->middleware('role_or_permission:view accommodation type');
        $this->middleware('role_or_permission:create accommodation type', ['only' => ['create', 'store']]);
        $this->middleware('role_or_permission:edit accommodation type', ['only' => ['update', 'edit']]);
        $this->middleware('role_or_permission:delete accommodation type', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {
        if(request()->ajax()) {

            $AccoumodationType = AccoumodationType::orderBy('accoumodation_types.id', 'DESC')->get();

            return datatables()->of($AccoumodationType)
//                ->rawColumns()
                ->addIndexColumn()
                ->addColumn('action', 'accoumodation_types.action_button')
                ->rawColumns(['action'])
                ->make(true);

        }

        return view('accoumodation_types.index');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $view = view('accoumodation_types.add')->render();

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
            'name' => 'required',
        ]
        ,[
            'name.required' => __('message.name_required'),
        ]
        );

        if ($validator->passes()) {
            $params = $request->all();
            $AccoumodationType = AccoumodationType::create($params);

            if ($AccoumodationType){
                addToLog('add_accoumodation_type',$AccoumodationType->id,$AccoumodationType->id ,'AccoumodationType');
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
            $AccoumodationType = AccoumodationType::where('id',$id)->first();
            if( $AccoumodationType ) {
                $view = view('accoumodation_types.edit',compact('AccoumodationType'))->render();

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
                'name' => 'required',
            ]
            ,[
                'name.required' => __('message.name_required'),
            ]
        );

        if ($validator->passes()) {
            $params = $request->all();
            $id = $getId;
            if( $id != "" ) {
                $AccoumodationType = AccoumodationType::where('id',$id)->first();

                if( $AccoumodationType ) {

                    $AccoumodationType->update($params);

                    $params['id'] = $AccoumodationType->id;
                    addToLog('edit_accoumodation_type',serialize($params),$AccoumodationType->id,'AccoumodationType' );
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
            $AccoumodationType = AccoumodationType::find($id);
            if( $AccoumodationType ) {
                $AccoumodationType->delete();
                addToLog('delete_accoumodation_type',$AccoumodationType->id,$AccoumodationType->id ,'AccoumodationType');
                return response()->json(['success' => __('message.delete_text')]);
            } else {
                return response()->json(['error' => array('failed' =>  __('message.not_found') )]);
            }
        }
        return response()->json(['error' =>   __('message.create_failed')]);
    }


	
}
