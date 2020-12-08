<?php

namespace App\Http\Controllers;

use App\Nationalitie;
use Illuminate\Http\Request;
use Redirect,Response;
use Validator;
class NationalitieController extends Controller
{
    public function __construct()
    {
        $this->middleware('role_or_permission:view nationalitie');
        $this->middleware('role_or_permission:create nationalitie', ['only' => ['create', 'store']]);
        $this->middleware('role_or_permission:edit nationalitie', ['only' => ['update', 'edit']]);
        $this->middleware('role_or_permission:delete nationalitie', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->ajax()) {
        $Nationalities = Nationalitie::orderBy('id', 'DESC')->get();
        return datatables()->of($Nationalities)
            ->addColumn('action', 'basic.nationalities.action_button')
            ->addColumn('status', 'basic.nationalities.status_checkbox')
            ->rawColumns(['action','status'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('basic.nationalities.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $view = view('basic.nationalities.add')->render(); 
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
            'nationality' => 'required|unique:nationalities',
            'nationality_english' => 'required',
            'state' => 'required',
            'status' => 'required',
        ],[
            'nationality.required' => __('message.nationality_name_required'),
            'nationality.unique' => __('message.nationality_unique'),
            'nationality_english.required' => __('message.nationality_english_required'),
            'state.required' => __('message.state_required'),
            'status.required' => __('message.status_required'),
        ]);

        if ($validator->passes()) {
            $params = $request->all();
            $data = array();
            $data['nationality'] = $params['nationality'];
            $data['nationality_english'] = $params['nationality_english'];
            $data['state'] = $params['state'];
            $data['status'] = $params['status'];
            $Nationalitie = Nationalitie::create($data);
            if ( $Nationalitie ){
                   addToLog('create_status',$Nationalitie->id,$Nationalitie->id,'Nationalitie' );
                return response()->json(['success' => __('message.nationality_create_success')]);
            } else {
                return response()->json(['error' => array('failed' =>  __('message.create_failed') )]);  
            }  
        }
        return response()->json(['error'=>$validator->errors()->all()]); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Nationalitie  $nationalitie
     * @return \Illuminate\Http\Response
     */
    public function show(Nationalitie $nationalitie)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Nationalitie  $nationalitie
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$getId)
    {
        $getId  = explode("-",base64_decode($getId));
        $id = base64_decode($getId['1']);
        if( $id != "" ) {

            $Nationality = Nationalitie::where('id',$id)->first();
            if( $Nationality ) {
                $view = view('basic.nationalities.edit',compact('Nationality'))->render(); 
                return response()->json(['view' => $view ]);
            } else {
                return response()->json('error', __('message.nationality_not_found')); 
            }
        }
        return response()->json('error',  __('message.create_failed')); 
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Nationalitie  $nationalitie
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $getId)
    {
        $getId  = explode("-",base64_decode($getId));
        $id = base64_decode($getId['1']);
        if( $id != "" ) {
            $validator = Validator::make($request->all(), [
                'nationality' => 'required|unique:nationalities,nationality,'.$id,
                'nationality_english' => 'required',
                'state' => 'required',
                'status' => 'required',
            ],[
                'nationality.required' => __('message.nationality_name_required'),
                'nationality.unique' => __('message.nationality_unique'),
                'nationality_english.required' => __('message.nationality_english_required'),
                'state.required' => __('message.state_required'),
                'status.required' => __('message.status_required'),
            ]);
           if ($validator->passes()) {
                $params = $request->all();
                $data   = array();
                
                $Nationalitie = Nationalitie::where('id',$id)->first();
                if( $Nationalitie ) {
                    $data['nationality'] = $params['nationality'];
                    $data['nationality_english'] = $params['nationality_english'];
                    $data['state'] = $params['state'];
                    $data['status'] = $params['status'];
                    $Nationalitie->update($data);
                    $data['id'] = $Nationalitie->id; 
                    addToLog('update_status',serialize($data),$Nationalitie->id,'Nationalitie' );
                    return response()->json(['success' => __('message.nationality_update_success')]);
                } else {
                    return response()->json(['error' => array('failed' =>  __('message.nationality_not_found') )]); 
                }
            }
            return response()->json(['error'=>$validator->errors()->all()]); 
        }
        return response()->json(['error' => array('failed' =>  __('message.create_failed') )]); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Nationalitie  $nationalitie
     * @return \Illuminate\Http\Response
     */
     public function destroy(Request $request)
    {
        $params = $request->all();
        $getId  = explode("-",base64_decode($params['id']));
        $id = base64_decode($getId['1']);
        if( $id != "" ) {
            $Nationalitie = Nationalitie::find($id);
            if( $Nationalitie ) {
                $Nationalitie->delete();
                //addToLog('delete_office',$Office->id );
                return response()->json(['success' => __('message.delete_text')]);
            } else {
                return response()->json(['error' => array('failed' =>  __('message.nationality_not_found') )]); 
            }
        }
        return response()->json(['error' => array('failed' =>  __('message.create_failed') )]); 
    }
    public function statusUpdate(Request $request)
    {
        
        $params = $request->all();
        $getId  = explode("-",base64_decode($params['id']));
        $id = base64_decode($getId['1']);
        if( $id != "" ) {
            $Nationalitie = Nationalitie::find($id);
            if( $Nationalitie ) {
                $Nationalitie->update(['status'=>$params['status']]);
                //addToLog('office_status_update',json_encode(array("office_id"=>$Office->id,'status'=>$params['status']) ));
                if( $params['status'] == '1' ){
                    return response()->json(['success' => __('message.nationality_status_active_success') ]);
                } else {
                     return response()->json(['success' => __('message.nationality_status_deactive_success') ]);
                }
            } else {
                return response()->json(['error' =>  __('message.nationality_not_found')]); 
            }
        }
        return response()->json(['error' => array('failed' =>  __('message.create_failed') )]); 
    }
}
