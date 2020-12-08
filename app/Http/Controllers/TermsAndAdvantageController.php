<?php

namespace App\Http\Controllers;

use App\TermsAndAdvantage;
use Illuminate\Http\Request;
use Redirect,Response;
use Validator;
class TermsAndAdvantageController extends Controller
{
    public function __construct()
    {
        $this->middleware('role_or_permission:view terms and advantage');
        $this->middleware('role_or_permission:create terms and advantage', ['only' => ['create', 'store']]);
        $this->middleware('role_or_permission:edit terms and advantage', ['only' => ['update', 'edit']]);
        $this->middleware('role_or_permission:delete terms and advantage', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->ajax()) {
            $TermsAndAdvantages = TermsAndAdvantage::orderBy('id', 'DESC')->get();
            return datatables()->of($TermsAndAdvantages)
                ->addColumn('action', 'basic.terms_and_advantages.action_button')
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('basic.terms_and_advantages.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $view = view('basic.terms_and_advantages.add')->render(); 
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
            'terms_and_advantage' => 'required|unique:terms_and_advantages',
        ],[
            'terms_and_advantage.required' => __('message.terms_and_advantage_name_required'),
            'terms_and_advantage.unique' => __('message.terms_and_advantage_unique'),
        ]);

        if ($validator->passes()) {
            $params = $request->all();
            $data = array();
            $data['terms_and_advantage'] = $params['terms_and_advantage'];
            $TermsAndAdvantage = TermsAndAdvantage::create($data);
            if ( $TermsAndAdvantage ){
                   addToLog('create_terms_and_advantage',$TermsAndAdvantage->id,$TermsAndAdvantage->id,'TermsAndAdvantage' );
                return response()->json(['success' => __('message.terms_and_advantage_create_success')]);
            } else {
                return response()->json(['error' => array('failed' =>  __('message.create_failed') )]);  
            }  
        }
        return response()->json(['error'=>$validator->errors()->all()]); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TermsAndAdvantage  $termsAndAdvantage
     * @return \Illuminate\Http\Response
     */
    public function show(TermsAndAdvantage $termsAndAdvantage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TermsAndAdvantage  $termsAndAdvantage
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$getId)
    {
        $getId  = explode("-",base64_decode($getId));
        $id = base64_decode($getId['1']);
        if( $id != "" ) {
            $TermsAndAdvantage = TermsAndAdvantage::where('id',$id)->first();
            if( $TermsAndAdvantage ) {
                $view = view('basic.terms_and_advantages.edit',compact('TermsAndAdvantage'))->render(); 
                return response()->json(['view' => $view ]);
            } else {
                return response()->json('error', __('message.terms_and_advantage_not_found')); 
            }
        }
        return response()->json('error',  __('message.create_failed')); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TermsAndAdvantage  $termsAndAdvantage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $getId)
    {
        $getId  = explode("-",base64_decode($getId));
        $id = base64_decode($getId['1']);
        if( $id != "" ) {
            $validator = Validator::make($request->all(), [
                'terms_and_advantage' => 'required|unique:terms_and_advantages,terms_and_advantage,'.$id,
        ],[
            'terms_and_advantage.required' => __('message.terms_and_advantage_name_required'),
            'terms_and_advantage.unique' => __('message.terms_and_advantage_unique'),
        ]);

            if ($validator->passes()) {
                $params = $request->all();
                $data   = array();
                
                $TermsAndAdvantage = TermsAndAdvantage::where('id',$id)->first();
                if( $TermsAndAdvantage ) {
                    $data['terms_and_advantage'] = $params['terms_and_advantage'];
                    $TermsAndAdvantage->update($data);
                    $data['id'] = $TermsAndAdvantage->id; 
                    addToLog('update_terms_and_advantage',serialize($data),$TermsAndAdvantage->id,'TermsAndAdvantage' );
                    return response()->json(['success' => __('message.terms_and_advantage_update_success')]);
                } else {
                    return response()->json(['error' => array('failed' =>  __('message.terms_and_advantage_not_found') )]); 
                }
            }
            return response()->json(['error'=>$validator->errors()->all()]); 
        }
        return response()->json(['error' => array('failed' =>  __('message.create_failed') )]); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TermsAndAdvantage  $termsAndAdvantage
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $params = $request->all();
        $getId  = explode("-",base64_decode($params['id']));
        $id = base64_decode($getId['1']);
        if( $id != "" ) {
            $TermsAndAdvantage = TermsAndAdvantage::find($id);
            if( $TermsAndAdvantage ) {
                $TermsAndAdvantage->delete();
                addToLog('delete_terms_and_advantage',$TermsAndAdvantage->id ,$TermsAndAdvantage->id,'TermsAndAdvantage');
                return response()->json(['success' => __('message.delete_text')]);
            } else {
                return response()->json(['error' => __('message.terms_and_advantage_not_found')]); 
            }
        }
        return response()->json(['error' => __('message.create_failed')]); 
    }
}
