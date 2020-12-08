<?php

namespace App\Http\Controllers;

use App\Profession;
use Illuminate\Http\Request;
use Redirect,Response;
use Validator;

class ProfessionController extends Controller
{
    public function __construct()
    {
        $this->middleware('role_or_permission:view profession');
        $this->middleware('role_or_permission:create profession', ['only' => ['create', 'store']]);
        $this->middleware('role_or_permission:edit profession', ['only' => ['update', 'edit']]);
        $this->middleware('role_or_permission:delete profession', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->ajax()) {
        $Professions = Profession::orderBy('id', 'DESC')->get();
        return datatables()->of($Professions)
            ->addColumn('action', 'basic.professions.action_button')
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
       return view('basic.professions.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $view = view('basic.professions.add')->render(); 
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
            'occupation' => 'required|unique:professions',
            'job_english' => 'required',
        ],[
            'occupation.required' => __('message.religion_name_required'),
            'occupation.unique' => __('message.religion_unique'),
            'job_english.required' => __('message.religion_english_required'),
        ]);

        if ($validator->passes()) {
            $params = $request->all();
            $data = array();
            $data['occupation'] = $params['occupation'];
            $data['job_english'] = $params['job_english'];
            $Profession = Profession::create($data);
            if ( $Profession ){
                addToLog('create_profession',$Profession->id ,$Profession->id,'Profession');
                return response()->json(['success' => __('message.profession_create_success')]);
            } else {
                return response()->json(['error' => array('failed' =>  __('message.create_failed') )]);  
            }  
        }
        return response()->json(['error'=>$validator->errors()->all()]); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Profession  $profession
     * @return \Illuminate\Http\Response
     */
    public function show(Profession $profession)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Profession  $profession
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$getId)
    {
        $getId  = explode("-",base64_decode($getId));
        $id = base64_decode($getId['1']);
        if( $id != "" ) {
            
            $Profession = Profession::where('id',$id)->first();
            if( $Profession ) {
                $view = view('basic.professions.edit',compact('Profession'))->render(); 
                return response()->json(['view' => $view ]);
            } else {
                return response()->json('error', __('message.profession_not_found')); 
            }
        }
        return response()->json('error',  __('message.create_failed')); 
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Profession  $profession
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $getId)
    {
        $getId  = explode("-",base64_decode($getId));
        $id = base64_decode($getId['1']);
        if( $id != "" ) {
            $validator = Validator::make($request->all(), [
                'occupation' => 'required|unique:professions,occupation,'.$id,
                'job_english' => 'required',
            ],[
                'occupation.required' => __('message.religion_name_required'),
                'occupation.unique' => __('message.religion_unique'),
                'job_english.required' => __('message.religion_english_required'),
            ]);
           if ($validator->passes()) {
                $params = $request->all();
                $data   = array();
                
                $Profession = Profession::where('id',$id)->first();
                if( $Profession ) {
                    $data['occupation'] = $params['occupation'];
                    $data['job_english'] = $params['job_english'];
                    $Profession->update($data);
                    $data['id'] = $Profession->id; 
                    addToLog('update_profession',serialize($data) ,$Profession->id,'Profession');
                    return response()->json(['success' => __('message.profession_update_success')]);
                } else {
                    return response()->json(['error' => array('failed' =>  __('message.profession_not_found') )]); 
                }
            }
            return response()->json(['error'=>$validator->errors()->all()]); 
        }
        return response()->json(['error' => array('failed' =>  __('message.create_failed') )]); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Profession  $profession
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $params = $request->all();
        $getId  = explode("-",base64_decode($params['id']));
        $id = base64_decode($getId['1']);
        if( $id != "" ) {
            $Profession = Profession::find($id);
            if( $Profession ) {
                $Profession->delete();
                addToLog('delete_profession',$Profession->id,$Profession->id ,'Profession');
                return response()->json(['success' => __('message.delete_text')]);
            } else {
                return response()->json(['error' => __('message.profession_not_found')]); 
            }
        }
        return response()->json(['error' => __('message.create_failed')]); 
    }
}
