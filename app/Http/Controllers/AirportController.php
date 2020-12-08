<?php

namespace App\Http\Controllers;

use App\Airport;
use Illuminate\Http\Request;
use Redirect,Response;
use Validator;
class AirportController extends Controller
{
    public function __construct()
    {
        $this->middleware('role_or_permission:view air port');
        $this->middleware('role_or_permission:create air port', ['only' => ['create', 'store']]);
        $this->middleware('role_or_permission:edit air port', ['only' => ['update', 'edit']]);
        $this->middleware('role_or_permission:delete air port', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->ajax()) {
            $Airports = Airport::orderBy('id', 'DESC')->get();
            return datatables()->of($Airports)
                ->addColumn('action', 'basic.airports.action_button')
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('basic.airports.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $view = view('basic.airports.add')->render(); 
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
            'airport' => 'required|unique:airports',
            'airport_english' => 'required',
        ],[
            'airport.required' => __('message.airport_name_required'),
            'airport.unique' => __('message.airport_unique'),
            'airport_english.required' => __('message.airport_english_required'),
        ]);

        if ($validator->passes()) {
            $params = $request->all();
            $data = array();
            $data['airport'] = $params['airport'];
            $data['airport_english'] = $params['airport_english'];
            $Airport = Airport::create($data);
            if ( $Airport ){
                   addToLog('create_airport',$Airport->id,$Airport->id,'Airport' );
                return response()->json(['success' => __('message.airport_create_success')]);
            } else {
                return response()->json(['error' => array('failed' =>  __('message.create_failed') )]);  
            }  
        }
        return response()->json(['error'=>$validator->errors()->all()]); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Airport  $airport
     * @return \Illuminate\Http\Response
     */
    public function show(Airport $airport)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Airport  $airport
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$getId)
    {
        $getId  = explode("-",base64_decode($getId));
        $id = base64_decode($getId['1']);
        if( $id != "" ) {
            $Airport = Airport::where('id',$id)->first();
            if( $Airport ) {
                $view = view('basic.airports.edit',compact('Airport'))->render(); 
                return response()->json(['view' => $view ]);
            } else {
                return response()->json('error', __('message.airport_not_found')); 
            }
        }
        return response()->json('error',  __('message.create_failed')); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Airport  $airport
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $getId)
    {
        $getId  = explode("-",base64_decode($getId));
        $id = base64_decode($getId['1']);
        if( $id != "" ) {
            $validator = Validator::make($request->all(), [
                'airport' => 'required|unique:airports,airport,'.$id,
                'airport_english' => 'required',
        ],[
            'airport.required' => __('message.airport_name_required'),
            'airport.unique' => __('message.airport_unique'),
            'airport_english.required' => __('message.airport_english_required'),
        ]);
           if ($validator->passes()) {
                $params = $request->all();
                $data   = array();
                
                $Airport = Airport::where('id',$id)->first();
                if( $Airport ) {
                    $data['airport'] = $params['airport'];
                    $data['airport_english'] = $params['airport_english'];
                    $Airport->update($data);
                    $data['id'] = $Airport->id; 
                    addToLog('update_airport',serialize($data),$Airport->id,'Airport' );
                    return response()->json(['success' => __('message.airport_update_success')]);
                } else {
                    return response()->json(['error' => array('failed' =>  __('message.airport_not_found') )]); 
                }
            }
            return response()->json(['error'=>$validator->errors()->all()]); 
        }
        return response()->json(['error' => array('failed' =>  __('message.create_failed') )]); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Airport  $airport
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $params = $request->all();
        $getId  = explode("-",base64_decode($params['id']));
        $id = base64_decode($getId['1']);
        if( $id != "" ) {
            $Airport = Airport::find($id);
            if( $Airport ) {
                $Airport->delete();
                addToLog('delete_airport',$Airport->id,$Airport->id ,'Airport');
                return response()->json(['success' => __('message.delete_text')]);
            } else {
                return response()->json(['error' => __('message.airport_not_found') ]); 
            }
        }
        return response()->json(['error' =>   __('message.create_failed')]); 
    }
}
