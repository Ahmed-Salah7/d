<?php

namespace App\Http\Controllers;

use App\Customer;
use App\VisaType;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Validator;
use Illuminate\Support\Facades\Log;


class VisaTypeController extends Controller
{
    public function __construct()
    {
        $this->middleware('role_or_permission:view visa type');
        $this->middleware('role_or_permission:create visa type', ['only' => ['create', 'store']]);
        $this->middleware('role_or_permission:edit visa type', ['only' => ['update', 'edit']]);
        $this->middleware('role_or_permission:delete visa type', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->ajax()) {

            $VisaType = VisaType::orderBy('visa_types.id', 'DESC')->get();

            return datatables()->of($VisaType)
//                ->rawColumns()
                ->addIndexColumn()
                ->addColumn('action', 'visa_types.action_button')
                ->rawColumns(['action'])
                ->make(true);

        }

        return view('visa_types.index');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $view = view('visa_types.add')->render();

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
            $VisaType = VisaType::create($params);

            if ($VisaType){
                addToLog('add_visa_type',$VisaType->id,$VisaType->id  ,'VisaType');
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
            $VisaType = VisaType::where('id',$id)->first();
            if( $VisaType ) {
                $view = view('visa_types.edit',compact('VisaType'))->render();

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
                $VisaType = VisaType::where('id',$id)->first();

                if( $VisaType ) {

                    $VisaType->update($params);

                    $params['id'] = $VisaType->id;
                    addToLog('edit_visa_type',serialize($params) ,$VisaType->id,'VisaType');
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
            $VisaType = VisaType::find($id);
            if( $VisaType ) {
                $VisaType->delete();
                addToLog('delete_visa_type',$VisaType->id,$VisaType->id ,'VisaType');
                return response()->json(['success' => __('message.delete_text')]);
            } else {
                return response()->json(['error' => array('failed' =>  __('message.not_found') )]);
            }
        }
        return response()->json(['error' =>   __('message.create_failed')]);
    }


	
}
