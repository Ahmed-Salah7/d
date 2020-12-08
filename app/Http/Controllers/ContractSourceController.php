<?php

namespace App\Http\Controllers;

use App\ContractSource;
use Illuminate\Http\Request;
use Redirect,Response;
use Validator;
class ContractSourceController extends Controller
{
    public function __construct()
    {
        $this->middleware('role_or_permission:view contract source');
        $this->middleware('role_or_permission:create contract source', ['only' => ['create', 'store']]);
        $this->middleware('role_or_permission:edit contract source', ['only' => ['update', 'edit']]);
        $this->middleware('role_or_permission:delete contract source', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->ajax()) {
            $ContractSources = ContractSource::orderBy('id', 'DESC')->get();
            return datatables()->of($ContractSources)
                ->addColumn('action', 'basic.contract_sources.action_button')
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }
       return view('basic.contract_sources.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $view = view('basic.contract_sources.add')->render(); 
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
            'source' => 'required|unique:contract_sources',
        ],[
            'source.required' => __('message.source_name_required'),
            'source.unique' => __('message.source_unique'),
        ]);

        if ($validator->passes()) {
            $params = $request->all();
            $data = array();
            $data['source'] = $params['source'];
            $ContractSource = ContractSource::create($data);
            if ( $ContractSource ){
                   addToLog('create_conreact_source',$ContractSource->id,$ContractSource->id ,'ContractSource');
                return response()->json(['success' => __('message.source_create_success')]);
            } else {
                return response()->json(['error' => array('failed' =>  __('message.create_failed') )]);  
            }  
        }
        return response()->json(['error'=>$validator->errors()->all()]); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ContractSource  $contractSource
     * @return \Illuminate\Http\Response
     */
    public function show(ContractSource $contractSource)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ContractSource  $contractSource
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$getId)
    {
        $getId  = explode("-",base64_decode($getId));
        $id = base64_decode($getId['1']);
        if( $id != "" ) {
            
            $ContractSource = ContractSource::where('id',$id)->first();
            if( $ContractSource ) {
                $view = view('basic.contract_sources.edit',compact('ContractSource'))->render(); 
                return response()->json(['view' => $view ]);
            } else {
                return response()->json('error', __('message.source_not_found')); 
            }
        }
        return response()->json('error',  __('message.create_failed')); 
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ContractSource  $contractSource
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $getId)
    {
        $getId  = explode("-",base64_decode($getId));
        $id = base64_decode($getId['1']);
        if( $id != "" ) {
            $validator = Validator::make($request->all(), [
                'source' => 'required|unique:contract_sources,source,'.$id,
            ],[
                'source.required' => __('message.source_name_required'),
                'source.unique' => __('message.source_unique'),
            ]);
           if ($validator->passes()) {
                $params = $request->all();
                $data   = array();
                
                $ContractSource = ContractSource::where('id',$id)->first();
                if( $ContractSource ) {
                    $data['source'] = $params['source'];
                    $ContractSource->update($data);
                    $data['id'] = $ContractSource->id; 
                    addToLog('update_conreact_source',serialize($data),$ContractSource->id,'ContractSource' );
                    return response()->json(['success' => __('message.source_update_success')]);
                } else {
                    return response()->json(['error' => array('failed' =>  __('message.source_not_found') )]); 
                }
            }
            return response()->json(['error'=>$validator->errors()->all()]); 
        }
        return response()->json(['error' => array('failed' =>  __('message.create_failed') )]); 
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ContractSource  $contractSource
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $params = $request->all();
        $getId  = explode("-",base64_decode($params['id']));
        $id = base64_decode($getId['1']);
        if( $id != "" ) {
            $ContractSource = ContractSource::find($id);
            if( $ContractSource ) {
                $ContractSource->delete();
                addToLog('delete_conreact_source',$ContractSource->id,$ContractSource->id ,'ContractSource');
                return response()->json(['success' => __('message.delete_text')]);
            } else {
                return response()->json(['error' => __('message.source_not_found')]); 
            }
        }
        return response()->json(['error' =>   __('message.create_failed')]); 
    }
}
