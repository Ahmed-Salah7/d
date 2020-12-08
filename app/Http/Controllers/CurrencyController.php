<?php

namespace App\Http\Controllers;

use App\Currencie;
use Illuminate\Http\Request;
use Redirect,Response;
use Validator;
class CurrencyController extends Controller
{
    public function __construct()
    {
        $this->middleware('role_or_permission:view currency');
        $this->middleware('role_or_permission:create currency', ['only' => ['create', 'store']]);
        $this->middleware('role_or_permission:edit currency', ['only' => ['update', 'edit']]);
        $this->middleware('role_or_permission:delete currency', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->ajax()) {
            $Currencies = Currencie::orderBy('id', 'DESC')->get();

            return datatables()->of($Currencies)
                ->addColumn('action', 'accounting.currencies.action_button')
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }
       return view('accounting.currencies.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $view = view('accounting.currencies.add')->render(); 
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
            'currency_name' => 'required|unique:currencies',
            'currency_name_english' => 'required',
            'abbreviation' => 'required',
        ],[
            'currency_name.required' => __('message.currency_name_required'),
            'currency_name.unique' => __('message.currency_unique'),
            'currency_name_english.required' => __('message.currency_english_required'),
            'abbreviation.required' => __('message.abbreviation_required'),
        ]);

        if ($validator->passes()) {
            $params = $request->all();
            $data = array();
            $data['currency_name'] = $params['currency_name'];
            $data['currency_name_english'] = $params['currency_name_english'];
            $data['abbreviation'] = $params['abbreviation'];
            $Currency = Currencie::create($data);
            if ( $Currency ){
                   addToLog('create_currency',$Currency->id,$Currency->id,'Currencie' );
                return response()->json(['success' => __('message.currency_create_success')]);
            } else {
                return response()->json(['error' => array('failed' =>  __('message.create_failed') )]);  
            }  
        }
        return response()->json(['error'=>$validator->errors()->all()]); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Currencie  $currencie
     * @return \Illuminate\Http\Response
     */
    public function show(Currencie $currencie)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Currencie  $currencie
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$getId)
    {
        $getId  = explode("-",base64_decode($getId));
        $id = base64_decode($getId['1']);
        if( $id != "" ) {
            
            $Currency = Currencie::where('id',$id)->first();
            if( $Currency ) {
                $view = view('accounting.currencies.edit',compact('Currency'))->render(); 
                return response()->json(['view' => $view ]);
            } else {
                return response()->json('error', __('message.currency_not_found')); 
            }
        }
        return response()->json('error',  __('message.create_failed')); 
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Currencie  $currencie
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $getId)
    {
        $getId  = explode("-",base64_decode($getId));
        $id = base64_decode($getId['1']);
        if( $id != "" ) {
            $validator = Validator::make($request->all(), [
                'currency_name' => 'required|unique:currencies,currency_name,'.$id,
                'currency_name_english' => 'required',
                'abbreviation' => 'required',
            ],[
                'currency_name.required' => __('message.currency_name_required'),
                'currency_name.unique' => __('message.currency_unique'),
                'currency_name_english.required' => __('message.currency_english_required'),
                'abbreviation.required' => __('message.abbreviation_required'),
            ]);
            
            if ($validator->passes()) {
                $params = $request->all();
                $data   = array();
                
                $Currency = Currencie::where('id',$id)->first();
                if( $Currency ) {
                    $data['currency_name'] = $params['currency_name'];
                    $data['currency_name_english'] = $params['currency_name_english'];
                    $data['abbreviation'] = $params['abbreviation'];
                    $Currency->update($data);
                    $data['id'] = $Currency->id; 
                    addToLog('update_currency',serialize($data),$Currency->id ,'Currencie');
                    return response()->json(['success' => __('message.currency_update_success')]);
                } else {
                    return response()->json(['error' => array('failed' =>  __('message.currency_not_found') )]); 
                }
            }
            return response()->json(['error'=>$validator->errors()->all()]); 
        }
        return response()->json(['error' => array('failed' =>  __('message.create_failed') )]); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Currencie  $currencie
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $params = $request->all();
        $getId  = explode("-",base64_decode($params['id']));
        $id = base64_decode($getId['1']);
        if( $id != "" ) {
            $Currency = Currencie::find($id);
            if( $Currency ) {
                $Currency->delete();
                addToLog('delete_currency',$Currency->id,$Currency->id ,'Currencie');
                return response()->json(['success' => __('message.delete_text')]);
            } else {
                return response()->json(['error' =>  __('message.currency_not_found')]); 
            }
        }
        return response()->json(['error' =>   __('message.create_failed')]);  
    }
}
