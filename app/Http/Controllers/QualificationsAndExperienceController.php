<?php

namespace App\Http\Controllers;

use App\QualificationsAndExperience;
use Illuminate\Http\Request;
use Redirect,Response;
use Validator;
class QualificationsAndExperienceController extends Controller
{
    public function __construct()
    {
        $this->middleware('role_or_permission:view qualifications and experience');
        $this->middleware('role_or_permission:create qualifications and experience', ['only' => ['create', 'store']]);
        $this->middleware('role_or_permission:edit qualifications and experience', ['only' => ['update', 'edit']]);
        $this->middleware('role_or_permission:delete qualifications and experience', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->ajax()) {
            $QualificationsAndExperience = QualificationsAndExperience::orderBy('id', 'DESC')->get();
            return datatables()->of($QualificationsAndExperience)
                ->addColumn('action', 'basic.qualifications_and_experience.action_button')
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('basic.qualifications_and_experience.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $view = view('basic.qualifications_and_experience.add')->render(); 
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
            'qualifications_and_experience' => 'required|unique:qualifications_and_experiences',
        ],[
            'qualifications_and_experience.required' => __('message.qualifications_and_experience_name_required'),
            'qualifications_and_experience.unique' => __('message.qualifications_and_experience_unique'),
        ]);

        if ($validator->passes()) {
            $params = $request->all();
            $data = array();
            $data['qualifications_and_experience'] = $params['qualifications_and_experience'];
            $QualificationsAndExperience = QualificationsAndExperience::create($data);
            if ( $QualificationsAndExperience ){
                   addToLog('create_qualifications_and_experience',$QualificationsAndExperience->id,$QualificationsAndExperience->id ,'QualificationsAndExperience');
                return response()->json(['success' => __('message.qualifications_and_experience_create_success')]);
            } else {
                return response()->json(['error' => array('failed' =>  __('message.create_failed') )]);  
            }  
        }
        return response()->json(['error'=>$validator->errors()->all()]); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\QualificationsAndExperience  $qualificationsAndExperience
     * @return \Illuminate\Http\Response
     */
    public function show(QualificationsAndExperience $qualificationsAndExperience)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\QualificationsAndExperience  $qualificationsAndExperience
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$getId)
    {
        $getId  = explode("-",base64_decode($getId));
        $id = base64_decode($getId['1']);
        if( $id != "" ) {
            $QualificationsAndExperience = QualificationsAndExperience::where('id',$id)->first();
            if( $QualificationsAndExperience ) {
                $view = view('basic.qualifications_and_experience.edit',compact('QualificationsAndExperience'))->render(); 
                return response()->json(['view' => $view ]);
            } else {
                return response()->json('error', __('message.qualifications_and_experience_not_found')); 
            }
        }
        return response()->json('error',  __('message.create_failed')); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\QualificationsAndExperience  $qualificationsAndExperience
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $getId)
    {
        $getId  = explode("-",base64_decode($getId));
        $id = base64_decode($getId['1']);
        if( $id != "" ) {
            $validator = Validator::make($request->all(), [
                    'qualifications_and_experience' => 'required|unique:qualifications_and_experiences,qualifications_and_experience,'.$id,
            ],[
                'qualifications_and_experience.required' => __('message.qualifications_and_experience_name_required'),
                'qualifications_and_experience.unique' => __('message.qualifications_and_experience_unique'),
            ]);

            if ($validator->passes()) {
                $params = $request->all();
                $data   = array();
                
                $QualificationsAndExperience = QualificationsAndExperience::where('id',$id)->first();
                if( $QualificationsAndExperience ) {
                    $data['qualifications_and_experience'] = $params['qualifications_and_experience'];
                    $QualificationsAndExperience->update($data);
                    $data['id'] = $QualificationsAndExperience->id; 
                    addToLog('update_qualifications_and_experience',serialize($data),$QualificationsAndExperience->id ,'QualificationsAndExperience');
                    return response()->json(['success' => __('message.qualifications_and_experience_update_success')]);
                } else {
                    return response()->json(['error' => array('failed' =>  __('message.qualifications_and_experience_not_found') )]); 
                }
            }
            return response()->json(['error'=>$validator->errors()->all()]); 
        }
        return response()->json(['error' => array('failed' =>  __('message.create_failed') )]); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\QualificationsAndExperience  $qualificationsAndExperience
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $params = $request->all();
        $getId  = explode("-",base64_decode($params['id']));
        $id = base64_decode($getId['1']);
        if( $id != "" ) {
            $QualificationsAndExperience = QualificationsAndExperience::find($id);
            if( $QualificationsAndExperience ) {
                $QualificationsAndExperience->delete();
                addToLog('delete_qualifications_and_experience',$QualificationsAndExperience->id,$QualificationsAndExperience->id ,'QualificationsAndExperience');
                return response()->json(['success' => __('message.delete_text')]);
            } else {
                return response()->json(['error' => __('message.qualifications_and_experience_not_found')]); 
            }
        }
        return response()->json(['error' => __('message.create_failed')]); 
    }
}
