<?php

namespace App\Http\Controllers;

use App\CostCenter;
use Illuminate\Http\Request;
use Redirect,Response;
use Validator;
class CostCenterController extends Controller
{
    public function __construct()
    {
        $this->middleware('role_or_permission:view cost center');
        $this->middleware('role_or_permission:create cost center', ['only' => ['create', 'store']]);
        $this->middleware('role_or_permission:edit cost center', ['only' => ['update', 'edit']]);
        $this->middleware('role_or_permission:delete cost center', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->ajax()) {
            $CostCenters = CostCenter::orderBy('id', 'DESC')->get();

            return datatables()->of($CostCenters)
                ->addColumn('action', 'accounting.cost_centers.action_button')
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }
       return view('accounting.cost_centers.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $view = view('accounting.cost_centers.add')->render(); 
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
            'center_name' => 'required|unique:cost_centers',
            'center_name_english' => 'required',
        ],[
            'center_name.required' => __('message.center_name_required'),
            'center_name.unique' => __('message.center_unique'),
            'center_name_english.required' => __('message.center_english_required'),
        ]);

        if ($validator->passes()) {
            $params = $request->all();
            $data = array();
            $data['center_name'] = $params['center_name'];
            $data['center_name_english'] = $params['center_name_english'];
            $data['notes'] = $params['notes'];
            $CostCenter = CostCenter::create($data);
            if ( $CostCenter ){
                   addToLog('create_cost_center',$CostCenter->id,$CostCenter->id,'CostCenter' );
                return response()->json(['success' => __('message.cost_center_create_success')]);
            } else {
                return response()->json(['error' => array('failed' =>  __('message.create_failed') )]);  
            }  
        }
        return response()->json(['error'=>$validator->errors()->all()]); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\costCenter  $costCenter
     * @return \Illuminate\Http\Response
     */
    public function show(costCenter $costCenter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\costCenter  $costCenter
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$getId)
    {
        $getId  = explode("-",base64_decode($getId));
        $id = base64_decode($getId['1']);
        if( $id != "" ) {
            
            $CostCenter = CostCenter::where('id',$id)->first();
            if( $CostCenter ) {
                $view = view('accounting.cost_centers.edit',compact('CostCenter'))->render(); 
                return response()->json(['view' => $view ]);
            } else {
                return response()->json('error', __('message.cost_center_not_found')); 
            }
        }
        return response()->json('error',  __('message.create_failed')); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\costCenter  $costCenter
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $getId)
    {
        $getId  = explode("-",base64_decode($getId));
        $id = base64_decode($getId['1']);
        if( $id != "" ) {
            $validator = Validator::make($request->all(), [
                'center_name' => 'required|unique:cost_centers,center_name,'.$id,
                'center_name_english' => 'required',
            ],[
                'center_name.required' => __('message.center_name_required'),
                'center_name.unique' => __('message.center_unique'),
                'center_name_english.required' => __('message.center_english_required'),
            ]);
            
            if ($validator->passes()) {
                $params = $request->all();
                $data   = array();
                
                $CostCenter = CostCenter::where('id',$id)->first();
                if( $CostCenter ) {
                    $data['center_name'] = $params['center_name'];
                    $data['center_name_english'] = $params['center_name_english'];
                    $data['notes'] = $params['notes'];
                    $CostCenter->update($data);
                    $data['id'] = $CostCenter->id; 
                    addToLog('update_cost_center',serialize($data),$CostCenter->id ,'CostCenter');
                    return response()->json(['success' => __('message.cost_center_update_success')]);
                } else {
                    return response()->json(['error' => array('failed' =>  __('message.cost_center_not_found') )]); 
                }
            }
            return response()->json(['error'=>$validator->errors()->all()]); 
        }
         return response()->json(['error' => array('failed' =>  __('message.create_failed') )]); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\costCenter  $costCenter
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $params = $request->all();
        $getId  = explode("-",base64_decode($params['id']));
        $id = base64_decode($getId['1']);
        if( $id != "" ) {
            $CostCenter = CostCenter::find($id);
            if( $CostCenter ) {
                $CostCenter->delete();
                addToLog('delete_cost_center',$CostCenter->id,$CostCenter->id,'CostCenter' );
                return response()->json(['success' => __('message.delete_text')]);
            } else {
                return response()->json(['error' =>  __('message.cost_center_not_found')]); 
            }
        }
        return response()->json(['error' => __('message.create_failed')]); 
    }
}
