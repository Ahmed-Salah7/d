<?php

namespace App\Http\Controllers;

use App\Countrys;
use Illuminate\Http\Request;
use Validator;
use Redirect,Response;
use File;

class CountrysController extends Controller
{
    public function __construct()
    {
        $this->middleware('role_or_permission:view country');
        $this->middleware('role_or_permission:create country', ['only' => ['create', 'store']]);
        $this->middleware('role_or_permission:edit country', ['only' => ['update', 'edit']]);
        $this->middleware('role_or_permission:delete country', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
        $Countrys = Countrys::orderBy('id', 'DESC')->get();
         if(request()->ajax()) {
            return datatables()->of($Countrys)
                ->addColumn('action', 'basic.countrys.action_button')
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('basic.countrys.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $view = view('basic.countrys.add')->render(); 
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
            'name' => 'required|unique:countrys',
        ],[
            'name.required' => __('message.country_name_required'),
            'name.unique' => __('message.country_unique'),
        ]);

        if ($validator->passes()) {

            $params = $request->all();
            $data   = array();
            $data['name'] = $params['name'];
            $Country = Countrys::create($data);
            
            if ( $Country ){
                 addToLog('create_country',$Country->id,$Country->id ,'Countrys');
                return response()->json(['success' => __('message.country_create_success'),'country' => $Country,'action'=>base64_encode(\Carbon\Carbon::now()->format('MY').'-'.base64_encode($Country->id)),'title'=>__('page.edit_country') ]);
            } else {
                return response()->json(['error' => array('failed' =>  __('message.create_failed') )]);  
            }  
        }
        return response()->json(['error'=>$validator->errors()->all()]); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Countrys  $countrys
     * @return \Illuminate\Http\Response
     */
    public function show(Countrys $countrys)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Countrys  $countrys
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$getId)
    {
        $getId  = explode("-",base64_decode($getId));
        $id = base64_decode($getId['1']);
        $index = $request->index;
        if( $id != "" ) {
            $Country = Countrys::where('id',$id)->first();
            if( $Country ) {
                $view = view('basic.countrys.edit',compact('Country','index'))->render(); 
                return response()->json(['view' => $view ]);
            } else {
                return response()->json('error', __('message.country_not_found')); 
            }
        }
        return response()->json('error',  __('message.create_failed')); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Countrys  $countrys
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $getId)
    {
        $getId  = explode("-",base64_decode($getId));
        $id = base64_decode($getId['1']);
        if( $id != "" ) {
            $validator = Validator::make($request->all(), [
                 'name' => 'required|unique:countrys,name,'.$id,
            ],[
                'name.required' => __('message.country_name_required'),
                'name.unique' => __('message.country_unique'),
            ]);
            
            if ($validator->passes()) {
                $params = $request->all();
                $data   = array();
                
                $Country = Countrys::where('id',$id)->first();
                if( $Country ) {
                    $data['name'] = $params['name'];
                    $Country->update($data);
                    $data['id'] = $Country->id; 
                    addToLog('update_country',serialize($data),$Country->id ,'Countrys');
                    return response()->json(['success' => __('message.country_update_success'),'country' => $Country]);
                } else {
                    return response()->json(['error' => array('failed' =>  __('message.country_not_found') )]); 
                }
            }
            return response()->json(['error'=>$validator->errors()->all()]); 
        }
       return response()->json(['error' => array('failed' =>  __('message.create_failed') )]); 
    }
        

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Countrys  $countrys
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $params = $request->all();
        $getId  = explode("-",base64_decode($params['id']));
        $id = base64_decode($getId['1']);
        if( $id != "" ) {
            $Country = Countrys::find($id);
            if( $Country ) {
                $Country->delete();
                addToLog('delete_country',$Country->id,$Country->id ,'Countrys');
                return response()->json(['success' => __('message.delete_text')]);
            } else {
                return response()->json(['error' =>  __('message.country_not_found')]); 
            }
        }
        return response()->json(['error' =>   __('message.create_failed')]);  
    }
}
