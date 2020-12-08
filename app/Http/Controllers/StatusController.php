<?php

namespace App\Http\Controllers;

use App\Status;
use App\Nationalitie;
use Illuminate\Http\Request;
use File;
use Redirect,Response;
use Validator;
class StatusController extends Controller
{
    public function __construct()
    {
        $this->middleware('role_or_permission:view status');
        $this->middleware('role_or_permission:create status', ['only' => ['create', 'store']]);
        $this->middleware('role_or_permission:edit status', ['only' => ['update', 'edit']]);
        $this->middleware('role_or_permission:delete status', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
       $Status = Status::leftJoin('nationalities', 'status.nationality_id', '=', 'nationalities.id')
       ->select('status.*',
                'nationalities.nationality_english',
                'nationalities.nationality')
       ->orderBy('id', 'DESC')->get();
        if(request()->ajax()) {
            return datatables()->of($Status)
                ->addColumn('action', 'basic.status.action_button')
                ->addColumn('officetype', 'basic.status.office_type')
               ->addColumn('nationality_name', 'basic.status.nationality')
                ->rawColumns(['action','officetype','nationality_name'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('basic.status.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $Nationalities = Nationalitie::where('status',1)->get();
        $view = view('basic.status.add',compact('Nationalities'))->render(); 
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
             'office_type' => 'required',
             'nationality_id' => 'required',
        ],[
            'name.required' => __('message.status_name_required'),
            'name.unique' => __('message.status_unique'),
            'office_type.required' => __('message.office_type_required'),
            'nationality_id.required' => __('message.nationality_required'),
        ]);

        if ($validator->passes()) {
            $params = $request->all();
            $data   = array();
            $data['name'] = $params['name'];
            $data['office_type'] = $params['office_type'];
            $data['nationality_id'] = $params['nationality_id'];
            $Status = Status::create($data);
            if ( $Status ){
                   addToLog('create_status',$Status->id,$Status->id,'Status' );
                return response()->json(['success' => __('message.status_create_success')]);
            } else {
                return response()->json(['error' => array('failed' =>  __('message.create_failed') )]);  
            }  
        }
        return response()->json(['error'=>$validator->errors()->all()]); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Status  $status
     * @return \Illuminate\Http\Response
     */
    public function show(Status $status)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Status  $status
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$getId)
    {
        $getId  = explode("-",base64_decode($getId));
        $id = base64_decode($getId['1']);
        if( $id != "" ) {
            $Status = Status::where('id',$id)->first();
            $Nationalities = Nationalitie::where('status',1)->get();
            if( $Status ) {
                $view = view('basic.status.edit',compact('Status','Nationalities'))->render(); 
                return response()->json(['view' => $view ]);
            } else {
                return response()->json('error', __('message.status_not_found')); 
            }
        }
        return response()->json('error',  __('message.create_failed')); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Status  $status
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $getId)
    {
        $getId  = explode("-",base64_decode($getId));
        $id = base64_decode($getId['1']);
        if( $id != "" ) {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'office_type' => 'required',
                'nationality_id' => 'required',
            ],[
                'name.required' => __('message.status_name_required'),
                'name.unique' => __('message.status_unique'),
                'office_type.required' => __('message.office_type_required'),
                'nationality_id.required' => __('message.nationality_required'),
            ]);
            
            if ($validator->passes()) {
                $params = $request->all();
                $data   = array();
                
                $Status = Status::where('id',$id)->first();
                if( $Status ) {
                    $data['name'] = $params['name'];
                    $data['office_type'] = $params['office_type'];
                    $data['nationality_id'] = $params['nationality_id'];
                    $Status->update($data);
                    $data['id'] = $Status->id; 
                    addToLog('update_status',serialize($data),$Status->id ,'Status');
                    return response()->json(['success' => __('message.status_update_success')]);
                } else {
                    return response()->json(['error' => array('failed' =>  __('message.status_not_found') )]); 
                }
            }
            return response()->json(['error'=>$validator->errors()->all()]); 
        }
        return response()->json(['error' => array('failed' =>  __('message.create_failed') )]); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Status  $status
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $params = $request->all();
        $getId  = explode("-",base64_decode($params['id']));
        $id = base64_decode($getId['1']);
        if( $id != "" ) {
            $Status = Status::find($id);
            if( $Status ) {
                $Status->delete();
                addToLog('delete_status',$Status->id ,$Status->id,'Status');
                return response()->json(['success' => __('message.delete_text')]);
            } else {
                return response()->json(['error' => __('message.status_not_found')]); 
            }
        }
        return response()->json(['error' =>  __('message.create_failed')]); 
    }

}
