<?php

namespace App\Http\Controllers;

use App\Religion;
use Illuminate\Http\Request;
use Redirect,Response;
use Validator;
class ReligionController extends Controller
{
    public function __construct()
    {
        $this->middleware('role_or_permission:view religion');
        $this->middleware('role_or_permission:create religion', ['only' => ['create', 'store']]);
        $this->middleware('role_or_permission:edit religion', ['only' => ['update', 'edit']]);
        $this->middleware('role_or_permission:delete religion', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if(request()->ajax()) {
        $Religions = Religion::orderBy('id', 'DESC')->get();
        return datatables()->of($Religions)
            ->addColumn('action', 'basic.religions.action_button')
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
       return view('basic.religions.index');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $view = view('basic.religions.add')->render(); 
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
            'religion' => 'required|unique:religions',
            'religion_english' => 'required',
        ],[
            'religion.required' => __('message.religion_name_required'),
            'religion.unique' => __('message.religion_unique'),
            'religion_english.required' => __('message.religion_english_required'),
        ]);

        if ($validator->passes()) {
            $params = $request->all();
            $data = array();
            $data['religion'] = $params['religion'];
            $data['religion_english'] = $params['religion_english'];
            $Religion = Religion::create($data);
            if ( $Religion ){
                   addToLog('create_religion',$Religion->id,$Religion->id ,'Religion');
                return response()->json(['success' => __('message.religion_create_success')]);
            } else {
                return response()->json(['error' => array('failed' =>  __('message.create_failed') )]);  
            }  
        }
        return response()->json(['error'=>$validator->errors()->all()]); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Religion  $religion
     * @return \Illuminate\Http\Response
     */
    public function show(Religion $religion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Religion  $religion
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$getId)
    {
        $getId  = explode("-",base64_decode($getId));
        $id = base64_decode($getId['1']);
        if( $id != "" ) {
            
            $Religion = Religion::where('id',$id)->first();
            if( $Religion ) {
                $view = view('basic.religions.edit',compact('Religion'))->render(); 
                return response()->json(['view' => $view ]);
            } else {
                return response()->json('error', __('message.religion_not_found')); 
            }
        }
        return response()->json('error',  __('message.create_failed')); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Religion  $religion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $getId)
    {
        $getId  = explode("-",base64_decode($getId));
        $id = base64_decode($getId['1']);
        if( $id != "" ) {
            $validator = Validator::make($request->all(), [
                'religion' => 'required|unique:religions,religion,'.$id,
                'religion_english' => 'required',
            ],[
                'religion.required' => __('message.religion_name_required'),
                'religion.unique' => __('message.religion_unique'),
                'religion_english.required' => __('message.religion_english_required'),
            ]);
           if ($validator->passes()) {
                $params = $request->all();
                $data   = array();
                
                $Religion = Religion::where('id',$id)->first();
                if( $Religion ) {
                    $data['religion'] = $params['religion'];
                    $data['religion_english'] = $params['religion_english'];
                    $Religion->update($data);
                    $data['id'] = $Religion->id; 
                    addToLog('update_religion',serialize($data),$Religion->id ,'Religion');
                    return response()->json(['success' => __('message.religion_update_success')]);
                } else {
                    return response()->json(['error' => array('failed' =>  __('message.religion_not_found') )]); 
                }
            }
            return response()->json(['error'=>$validator->errors()->all()]); 
        }
        return response()->json(['error' => array('failed' =>  __('message.create_failed') )]); 
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Religion  $religion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $params = $request->all();
        $getId  = explode("-",base64_decode($params['id']));
        $id = base64_decode($getId['1']);
        if( $id != "" ) {
            $Religion = Religion::find($id);
            if( $Religion ) {
                $Religion->delete();
                addToLog('delete_religion',$Religion->id,$Religion->id ,'Religion');
                return response()->json(['success' => __('message.delete_text')]);
            } else {
                return response()->json(['error' => __('message.religion_not_found')]); 
            }
        }
        return response()->json(['error' => __('message.create_failed')]); 
    }
}
