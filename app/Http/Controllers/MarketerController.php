<?php

namespace App\Http\Controllers;

use App\Marketer;
use Illuminate\Http\Request;
use Redirect,Response;
use Validator;
class MarketerController extends Controller
{
    public function __construct()
    {
        $this->middleware('role_or_permission:view marketer');
        $this->middleware('role_or_permission:create marketer', ['only' => ['create', 'store']]);
        $this->middleware('role_or_permission:edit marketer', ['only' => ['update', 'edit']]);
        $this->middleware('role_or_permission:delete marketer', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->ajax()) {
            $Marketers = Marketer::orderBy('id', 'DESC')->get();
            return datatables()->of($Marketers)
                ->addColumn('action', 'basic.marketers.action_button')
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('basic.marketers.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $view = view('basic.marketers.add')->render(); 
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
            'marketer' => 'required|unique:marketers',
            'phone_no' => 'required',
        ],[
            'marketer.required' => __('message.marketer_name_required'),
            'marketer.unique' => __('message.marketer_unique'),
            'phone_no.required' => __('message.phone_no_required'),
        ]);

        if ($validator->passes()) {
            $params = $request->all();
            $data = array();
            $data['marketer'] = $params['marketer'];
            $data['phone_no'] = $params['phone_no'];
            $Marketer = Marketer::create($data);
            if ( $Marketer ){
                   addToLog('create_marketer',$Marketer->id,$Marketer->id ,'Marketer');
                return response()->json(['success' => __('message.marketer_create_success')]);
            } else {
                return response()->json(['error' => array('failed' =>  __('message.create_failed') )]);  
            }  
        }
        return response()->json(['error'=>$validator->errors()->all()]); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Marketer  $marketer
     * @return \Illuminate\Http\Response
     */
    public function show(Marketer $marketer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Marketer  $marketer
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$getId)
    {
        $getId  = explode("-",base64_decode($getId));
        $id = base64_decode($getId['1']);
        if( $id != "" ) {
            $Marketer = Marketer::where('id',$id)->first();
            if( $Marketer ) {
                $view = view('basic.marketers.edit',compact('Marketer'))->render(); 
                return response()->json(['view' => $view ]);
            } else {
                return response()->json('error', __('message.marketer_not_found')); 
            }
        }
        return response()->json('error',  __('message.create_failed')); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Marketer  $marketer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $getId)
    {
        $getId  = explode("-",base64_decode($getId));
        $id = base64_decode($getId['1']);
        if( $id != "" ) {
            $validator = Validator::make($request->all(), [
                'marketer' => 'required|unique:marketers,marketer,'.$id,
                'phone_no' => 'required',
        ],[
            'marketer.required' => __('message.marketer_name_required'),
            'marketer.unique' => __('message.marketer_unique'),
            'phone_no.required' => __('message.phone_no_required'),
        ]);

           if ($validator->passes()) {
                $params = $request->all();
                $data   = array();
                
                $Marketer = Marketer::where('id',$id)->first();
                if( $Marketer ) {
                    $data['marketer'] = $params['marketer'];
                    $data['phone_no'] = $params['phone_no'];
                    $Marketer->update($data);
                    $data['id'] = $Marketer->id; 
                    addToLog('update_marketer',serialize($data),$Marketer->id ,'Marketer');
                    return response()->json(['success' => __('message.marketer_update_success')]);
                } else {
                    return response()->json(['error' => array('failed' =>  __('message.marketer_not_found') )]); 
                }
            }
            return response()->json(['error'=>$validator->errors()->all()]); 
        }
        return response()->json(['error' => array('failed' =>  __('message.create_failed') )]); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Marketer  $marketer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $params = $request->all();
        $getId  = explode("-",base64_decode($params['id']));
        $id = base64_decode($getId['1']);
        if( $id != "" ) {
            $Marketer = Marketer::find($id);
            if( $Marketer ) {
                $Marketer->delete();
                addToLog('delete_marketer',$Marketer->id,$Marketer->id ,'Marketer');
                return response()->json(['success' => __('message.delete_text')]);
            } else {
                return response()->json(['error' =>  __('message.marketer_not_found')]); 
            }
        }
        return response()->json(['error' =>  __('message.create_failed')]); 
    }
}
