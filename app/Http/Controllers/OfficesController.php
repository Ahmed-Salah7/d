<?php

namespace App\Http\Controllers;

use App\Offices;
use App\LogActivity;
use Illuminate\Http\Request;
use Validator;
class OfficesController extends Controller
{
    public function __construct()
    {
        $this->middleware('role_or_permission:view office');
        $this->middleware('role_or_permission:create office', ['only' => ['create', 'store']]);
        $this->middleware('role_or_permission:edit office', ['only' => ['update', 'edit']]);
        $this->middleware('role_or_permission:delete office', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->ajax()) {
         $Offices = Offices::orderBy('id', 'DESC')->get();
        return datatables()->of($Offices)
            ->addColumn('action', 'basic.offices.action_button')
            ->addColumn('status', 'basic.offices.status_checkbox')
            ->addColumn('office_type', 'basic.offices.office_type')
            ->rawColumns(['action','status','office_type'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('basic.offices.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $view = view('basic.offices.add')->render(); 
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
            'name' => 'required',
            'city' => 'required',
            'phone_no' => 'required',
            'email' => 'required|email',
            'office_type' => 'required',
            'status' => 'required',
        ],[
            'name.required' => __('message.office_name_required'),
            'city.required' => __('message.city_required'),
            'phone_no.required' => __('message.phone_no_required'),
            'email.required' => __('message.email_required'),
            'email.email' => __('message.email_valid_required'),
            'office_type.required' => __('message.office_type_required'),
            'status.required' => __('message.status_required'),
        ]);
        
        if ($validator->passes()) {

            $params = $request->all();
            $data   = array();

            $data['name']        = $params['name'];
            $data['city']        = $params['city'];
            $data['phone']       = $params['phone_no'];
            $data['email']       = $params['email'];
            $data['office_type'] = $params['office_type'];
            $data['status']      = $params['status'];
            $Office = Offices::create($data);
            if ( $Office ){
                addToLog('create_office',$Office->id,$Office->id,'Offices' );
                return response()->json(['success' => __('message.office_create_success')]);
            } else {
                return response()->json(['error' => array('failed' =>  __('message.create_failed') )]);  
            }  
        }
        return response()->json(['error'=>$validator->errors()->all()]); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Offices  $offices
     * @return \Illuminate\Http\Response
     */
    public function show(Offices $offices)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Offices  $offices
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$getId)
    {
        $getId  = explode("-",base64_decode($getId));
        $id = base64_decode($getId['1']);
        if( $id != "" ) {
            $Office = Offices::where('id',$id)->first();
            if( $Office ) {
                $view = view('basic.offices.edit',compact('Office'))->render(); 
                return response()->json(['view' => $view ]);
            } else {
               return response()->json('error', __('message.office_not_found')); 
            }
        }
        return response()->json('error',  __('message.create_failed'));  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Offices  $offices
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $getId)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'city' => 'required',
            'phone_no' => 'required',
            'email' => 'required|email',
            'office_type' => 'required',
            'status' => 'required',
        ],[
            'name.required' => __('message.office_name_required'),
            'city.required' => __('message.city_required'),
            'phone_no.required' => __('message.phone_no_required'),
            'email.required' => __('message.email_required'),
            'email.email' => __('message.email_valid_required'),
            'office_type.required' => __('message.office_type_required'),
            'status.required' => __('message.status_required'),
        ]);
        
        if ($validator->passes()) {
            $params = $request->all();
            $data   = array();
            $getId  = explode("-",base64_decode($getId));
            $id = base64_decode($getId['1']);
            if( $id != "" ) {
                $Office = Offices::where('id',$id)->first();
                
                if( $Office ) {
                    $data['name']        = $params['name'];
                    $data['city']        = $params['city'];
                    $data['phone']       = $params['phone_no'];
                    $data['email']       = $params['email'];
                    $data['office_type'] = $params['office_type'];
                    $data['status']      = $params['status'];
                    $Office->update($data);
                    if( $Office->office_type == 1 ) {
                       $office_type =  __('page.external');
                    } else{
                        $office_type =  __('page.internal');
                    }
                    $data['id'] = $Office->id;
                    addToLog('update_office',serialize($data),$Office->id ,'Offices');
                    return response()->json(['success' => __('message.office_update_success')]);
                } else {
                    return response()->json(['error' => array('failed' =>  __('message.office_not_found') )]); 
                }
            }
            return response()->json(['error' => array('failed' =>  __('message.create_failed') )]); 
        }
        return response()->json(['error'=>$validator->errors()->all()]); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Offices  $offices
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $params = $request->all();
        $getId  = explode("-",base64_decode($params['id']));
        $id = base64_decode($getId['1']);
        if( $id != "" ) {
            $Office = Offices::find($id);
            if( $Office ) {
                $Office->delete();
                addToLog('delete_office',$Office->id,$Office->id,'Offices' );
                return response()->json(['success' => __('message.delete_text')]);
            } else {
                return response()->json(['error' => __('message.office_not_found')]); 
            }
        }
        return response()->json(['error' => __('message.create_failed')]); 
    }
    
    public function statusUpdate(Request $request)
    {
        
        $params = $request->all();
        $getId  = explode("-",base64_decode($params['id']));
        $id = base64_decode($getId['1']);
        if( $id != "" ) {
            $Office = Offices::find($id);
            if( $Office ) {
                $Office->update(['status'=>$params['status']]);
                addToLog('office_status_update',json_encode(array("office_id"=>$Office->id,'status'=>$params['status']) ),$Office->id,'Offices');
                if( $params['status'] == '1' ){
                    return response()->json(['success' => __('message.office_status_active_success') ]);
                } else {
                     return response()->json(['success' => __('message.office_status_deactive_success') ]);
                }
            } else {
                return response()->json(['error' =>  __('message.office_not_found')]); 
            }
        }
        return response()->json(['error' => __('message.create_failed')]); 
    }
}
