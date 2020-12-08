<?php

namespace App\Http\Controllers;

use App\Cv;
use App\Nationalitie;
use App\Offices;
use App\Religion;
use App\Profession;
use Illuminate\Http\Request;
use Validator;
class CvController extends Controller
{
    public function __construct()
    {
        $this->middleware('role_or_permission:view cv');
        $this->middleware('role_or_permission:create cv', ['only' => ['create', 'store']]);
        $this->middleware('role_or_permission:edit cv', ['only' => ['update', 'edit']]);
        $this->middleware('role_or_permission:delete cv', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->ajax()) {
        $cv = Cv::leftJoin('professions', 'cv.profession_id', '=', 'professions.id')
            ->leftJoin('nationalities', 'cv.nationality_id', '=', 'nationalities.id')
            ->leftJoin('religions', 'cv.religion_id', '=', 'religions.id')
            ->leftJoin('offices', 'cv.office_id', '=', 'offices.id')
            ->select(
                    'cv.*',
                    'professions.*',
                    'nationalities.*',
                    'religions.*',
                    'offices.*',
                    'cv.id as id',
                    'offices.name as office_name',
                    'cv.status as status',
                    'cv.name as cv_name'
            )
            ->when(request('nationality_id') != '', function ($q) {
                return $q->where('cv.nationality_id', request('nationality_id'));
            })
            ->when(request('office_id') != '', function ($q) {
                return $q->where('cv.office_id', request('office_id'));
            })
            ->orderBy('cv.id', 'DESC')->get();
        return datatables()->of($cv)
            ->addColumn('action', 'office_work.cv.action_button')
            ->addColumn('status', 'office_work.cv.status_checkbox')
            ->addColumn('nationality', 'office_work.cv.nationality')
            ->addColumn('religion', 'office_work.cv.religion')
            ->addColumn('occupation', 'office_work.cv.occupation')
            ->addColumn('previous_experience', 'office_work.cv.previous_experience_checkbox')
            ->addColumn('reservation', 'office_work.cv.reservation_checkbox')
            ->rawColumns(['action','status','nationality','religion','occupation','previous_experience','reservation'])
            ->addIndexColumn()
            ->make(true);
        }

        $Nationalities = Nationalitie::get();
        $Offices = Offices::get();

        return view('office_work.cv.index',compact('Nationalities','Offices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $Nationalities = Nationalitie::where('status','1')->get();
        $Offices = Offices::where('status',1)->get();
        $Religions = Religion::get();
        $Professions = Profession::get();
        $view = view('office_work.cv.add',compact('Nationalities','Offices','Religions','Professions'))->render();
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
            'profession_id' => 'required',
            'nationality_id' => 'required',
            'religion_id' => 'required',
            'age' => 'required',
            'previous_experience' => 'required',
            'office_id' => 'required',
            'passport_number' => 'required',
//            'reservation' => 'required',
            'previous_experience' => 'required',
            'status' => 'required',
        ],[
            'name.required' => __('message.office_name_required'),
            'profession_id.required' => __('message.occupation_required'),
            'nationality_id.required' => __('message.nationality_required'),
            'religion_id.required' => __('message.religion_required'),
            'age.required' => __('message.age_required'),
            'previous_experience.required' => __('message.previous_experience_required'),
            'office_id.required' => __('message.office_id_required'),
            'passport_number.required' => __('message.passport_number_required'),
//            'reservation.required' => __('message.reservation_required'),
            'status.required' => __('message.status_required'),
        ]);

        if ($validator->passes()) {
            $params = $request->all();
            $data   = array();
            if( isset($params['profile_pic'])){
                $imageValidator = Validator::make($request->all(), [
                    'profile_pic' => 'image|mimes:jpeg,png,jpg,gif,svg',
                ],[
                    'profile_pic.image' => __('message.profile_pic_image'),
                    'profile_pic.mimes' => __('message.profile_pic_mimes'),
                ]);
                if ( empty($imageValidator) || $imageValidator->passes()  ) {
                    $imageName = rand().'_'.$request->profile_pic->getClientOriginalName();
                    $request->profile_pic->move(public_path('storage/cv_profile_pic/'), $imageName);
                    $profile_pic = 'storage/cv_profile_pic/'.$imageName;
                    $data['profile_pic'] =  $profile_pic;
                } else {
                    return response()->json(['error'=>$imageValidator->errors()->all()]);
                }
            }

            $data['name']                = $params['name'];
            $data['profession_id']       = $params['profession_id'];
            $data['nationality_id']      = $params['nationality_id'];
            $data['religion_id']         = $params['religion_id'];
            $data['age']                 = $params['age'];
            $data['previous_experience'] = $params['previous_experience'];
            $data['office_id']           = $params['office_id'];
            $data['passport_number']     = $params['passport_number'];
//            $data['reservation']         = $params['reservation'];
            $data['status']              = $params['status'];
            $data['notes']              = $params['notes'];
            $Cv = Cv::create($data);
            if ( $Cv ){
                addToLog('create_cv',$Cv->id,$Cv->id ,'Cv');
                return response()->json(['success' => __('message.cv_create_success')]);
            } else {
                return response()->json(['error' => array('failed' =>  __('message.create_failed') )]);
            }
        }
        return response()->json(['error'=>$validator->errors()->all()]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\cv  $cv
     * @return \Illuminate\Http\Response
     */
    public function show(cv $cv)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\cv  $cv
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$getId)
    {
        $getId  = explode("-",base64_decode($getId));
        $id = base64_decode($getId['1']);
        $Nationalities = Nationalitie::where('status','1')->get();
        $Offices = Offices::where('status',1)->get();
        $Religions = Religion::get();
        $Professions = Profession::get();
        if( $id != "" ) {
            $Cv = Cv::where('id',$id)->first();
            if( $Cv ) {
                $view = view('office_work.cv.edit',compact('Cv','Nationalities','Offices','Religions','Professions'))->render();
                return response()->json(['view' => $view ]);
            } else {
               return response()->json('error', __('message.cv_not_found'));
            }
        }
        return response()->json('error',  __('message.create_failed'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\cv  $cv
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $getId)
    {
         $validator = Validator::make($request->all(), [
            'name' => 'required',
            'profession_id' => 'required',
            'nationality_id' => 'required',
            'religion_id' => 'required',
            'age' => 'required',
            'previous_experience' => 'required',
            'office_id' => 'required',
            'passport_number' => 'required',
//            'reservation' => 'required',
            'previous_experience' => 'required',
            'status' => 'required',
        ],[
            'name.required' => __('message.office_name_required'),
            'profession_id.required' => __('message.occupation_required'),
            'nationality_id.required' => __('message.nationality_required'),
            'religion_id.required' => __('message.religion_required'),
            'age.required' => __('message.age_required'),
            'previous_experience.required' => __('message.previous_experience_required'),
            'office_id.required' => __('message.office_id_required'),
            'passport_number.required' => __('message.passport_number_required'),
//            'reservation.required' => __('message.reservation_required'),
            'status.required' => __('message.status_required'),
        ]);
        if ($validator->passes()) {
            $params = $request->all();
            $data   = array();
            $getId  = explode("-",base64_decode($getId));
            $id = base64_decode($getId['1']);
            if( $id != "" ) {
                $Cv = Cv::where('id',$id)->first();

                if( $Cv ) {
                    if( isset($params['profile_pic'])){
                        $imageValidator = Validator::make($request->all(), [
                            'profile_pic' => 'image|mimes:jpeg,png,jpg,gif,svg',
                        ],[
                            'profile_pic.image' => __('message.profile_pic_image'),
                            'profile_pic.mimes' => __('message.profile_pic_mimes'),
                        ]);
                        if ( empty($imageValidator) || $imageValidator->passes()  ) {
                            $imageName = rand().'_'.$request->profile_pic->getClientOriginalName();
                            $request->profile_pic->move(public_path('storage/cv_profile_pic/'), $imageName);
                            $profile_pic = 'storage/cv_profile_pic/'.$imageName;
                            $data['profile_pic'] =  $profile_pic;
                            if( isset($User->profile_pic) && $User->profile_pic !="" ) {
                                $profilpic = public_path()."/".$User->profile_pic;
                                if( file_exists($profilpic) ) {
                                    unlink($profilpic);
                                }
                            }
                        } else {
                            return response()->json(['error'=>$imageValidator->errors()->all()]);
                        }
                    }
                    $data['name']                = $params['name'];
                    $data['profession_id']       = $params['profession_id'];
                    $data['nationality_id']      = $params['nationality_id'];
                    $data['religion_id']         = $params['religion_id'];
                    $data['age']                 = $params['age'];
                    $data['previous_experience'] = $params['previous_experience'];
                    $data['office_id']           = $params['office_id'];
                    $data['passport_number']     = $params['passport_number'];
//                    $data['reservation']         = $params['reservation'];
                    $data['status']              = $params['status'];
                    $data['notes']              = $params['notes'];
                    $Cv->update($data);

                    $data['id'] = $Cv->id;
                    addToLog('update_cv',serialize($data),$Cv->id ,'Cv');
                    return response()->json(['success' => __('message.cv_update_success')]);
                } else {
                    return response()->json(['error' => array('failed' =>  __('message.cv_not_found') )]);
                }
            }
            return response()->json('error',  __('message.create_failed'));
        }
        return response()->json(['error'=>$validator->errors()->all()]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\cv  $cv
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $params = $request->all();
        $getId  = explode("-",base64_decode($params['id']));
        $id = base64_decode($getId['1']);
        if( $id != "" ) {
            $Cv = Cv::find($id);
            if( $Cv ) {
                $Cv->delete();
                addToLog('delete_cv',$Cv->id,$Cv->id ,'Cv');
                return response()->json(['success' => __('message.delete_text')]);
            } else {
                return response()->json(['error' => array('failed' =>  __('message.cv_not_found') )]);
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
            $Cv = Cv::find($id);
            if( $Cv ) {
                $Cv->update(['status'=>$params['status']]);
                addToLog('cv_status_update',json_encode(array("cv_id"=>$Cv->id,'status'=>$params['status']) ),$Cv->id,'Cv');
                if( $params['status'] == '1' ){
                    return response()->json(['success' => __('message.cv_status_active_success') ]);
                } else {
                     return response()->json(['success' => __('message.cv_status_deactive_success') ]);
                }
            } else {
                return response()->json(['error' =>  __('message.cv_not_found')]);
            }
        }
        return response()->json(['error' =>  __('message.create_failed')]);
    }

}
