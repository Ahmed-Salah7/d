<?php

namespace App\Http\Controllers;

use App\Offices;
use App\UserDatas;
use App\User;
use App\Roles;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Validator;
use Spatie\Permission\Models\Role;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->ajax()) {
        $Users = User::leftJoin('user_datas', 'users.id', '=', 'user_datas.user_id')
            ->select(
                     'users.*',
                    'user_datas.*','users.id as id'
            )
        ->orderBy('users.id', 'DESC')->get();
        return datatables()->of($Users)
            ->addColumn('action', 'basic.users.action_button')
            ->addColumn('status', 'basic.users.status_checkbox')
            ->rawColumns(['action','status'])
            ->addIndexColumn()
            ->make(true);
        }

        return view('basic.users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $Roles = Roles::get();
        $newRoles = Role::get();
        $Offices = Offices::get();
        $view = view('basic.users.add',compact('Roles','newRoles','Offices'))->render();
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
            'username' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'newRoles' => 'required',
            'password' => 'required|min:6',
            'status' => 'required'
        ],[
            'name.required' => __('message.name_required'),
            'username.required' => __('message.username_required'),
            'username.unique' => __('message.username_unique'),
            'email.required' => __('message.email_required'),
            'email.email' => __('message.email_valid_required'),
            'email.unique' => __('message.email_unique'),
            'newRoles.required' => __('message.role_required'),
            'password.required' => __('message.password_required'),
            'password.min' => __('message.password_min'),
            'status.required' => __('message.status_required'),
        ]);

        if ($validator->passes()) {
            $params = $request->all();
            $imageValidator = array();
            $data   = array();
            $userdata = array();
            if( isset($params['profile_pic'])){
                $imageValidator = Validator::make($request->all(), [
                    'profile_pic' => 'image|mimes:jpeg,png,jpg,gif,svg',
                ],[
                    'profile_pic.image' => __('message.profile_pic_image'),
                    'profile_pic.mimes' => __('message.profile_pic_mimes'),
                ]);
                if ( empty($imageValidator) || $imageValidator->passes()  ) {
                    $imageName = rand().'_'.$request->profile_pic->getClientOriginalName();
                    $request->profile_pic->move(public_path('storage/profile_pic/'), $imageName);
                    $profile_pic = 'storage/profile_pic/'.$imageName;
                    $data['profile_pic'] =  $profile_pic;
                } else {
                    return response()->json(['error'=>$imageValidator->errors()->all()]);
                }
            }

            $data['name']     = $params['name'];
            $data['username'] = $params['username'];
            $data['password'] = bcrypt($params['password']);
            $data['email']    = $params['email'];
            $data['role_id']  = 1;
            $data['status']   = $params['status'];
            $data['office_id']   = $params['office_id'];
            $userdata['gender']           = $params['gender'];
            $userdata['nationality']      = $params['nationality'];
            $userdata['qualification']    = $params['qualification'];
            $userdata['position']         = $params['position'];
            $User = User::create($data);
            if ( $User ){
                $userdata['user_id'] = $User->id;
                $UserData =  UserDatas::create($userdata);
                $User->syncRoles([$params['newRoles']]);
                addToLog('create_user',$User->id ,$User->id ,'User');
                return response()->json(['success' => __('message.user_create_success')]);
            } else {
                return response()->json(['error' => array('failed' =>  __('message.create_failed') )]);
            }
        }
        return response()->json(['error'=>$validator->errors()->all()]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\UserDatas  $userDatas
     * @return \Illuminate\Http\Response
     */
    public function show(UserDatas $userDatas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\UserDatas  $userDatas
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$getId)
    {
        $getId  = explode("-",base64_decode($getId));
        $id = base64_decode($getId['1']);
        if( $id != "" ) {
            $User = User::where('id',$id)->first();
            if( $User ) {
                $Roles = Roles::get();
                $newRoles = Role::get();
                $Offices = Offices::get();
                $view = view('basic.users.edit',compact('User','Roles','newRoles','Offices'))->render();
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
     * @param  \App\UserDatas  $userDatas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $getId)
    {
        $getId  = explode("-",base64_decode($getId));
        $id = base64_decode($getId['1']);
        if( $id != "" ) {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'username' => 'required|unique:users,username,'.$id,
                'email' => 'required|unique:users,email,'.$id,
                'newRoles' => 'required',
            ],[
                'name.required' => __('message.name'),
                'username.required' => __('message.username_required'),
                'username.unique' => __('message.username_unique'),
                'email.required' => __('message.email_required'),
                'email.email' => __('message.email_valid_required'),
                'email.unique' => __('message.email_unique'),
                'newRoles.required' => __('message.role_required'),
            ]);

            if ($validator->passes()) {
                $params = $request->all();
                $imageValidator = array();
                $data   = array();
                $userdata = array();
                $User = User::where('id',$id)->first();
                if( isset($params['password']) &&  $params['password'] !="" ){
                    $data['password'] = bcrypt($params['password']);
                }
                if(isset($params['status']) && $params['status'] !=""){
                    $data['status']   = $params['status'];
                }
                if( isset($params['profile_pic'])){
                    $imageValidator = Validator::make($request->all(), [
                        'profile_pic' => 'image|mimes:jpeg,png,jpg,gif,svg',
                    ],[
                        'profile_pic.image' => __('message.profile_pic_image'),
                        'profile_pic.mimes' => __('message.profile_pic_mimes'),
                    ]);
                    if ( empty($imageValidator) || $imageValidator->passes()  ) {
                        $imageName = rand().'_'.$request->profile_pic->getClientOriginalName();
                        $request->profile_pic->move(public_path('storage/profile_pic/'), $imageName);
                        $profile_pic = 'storage/profile_pic/'.$imageName;
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
                $data['name']     = $params['name'];
                $data['username'] = $params['username'];
                $data['email']    = $params['email'];
                $data['role_id']  = 1;
                $data['office_id']  = $params['office_id'];
                $userdata['gender']           = $params['gender'];
                $userdata['nationality']      = $params['nationality'];
                $userdata['qualification']    = $params['qualification'];
                $userdata['position']         = $params['position'];

                if ( $User ){
                    $User->update($data);
                    $User->syncRoles([$params['newRoles']]);
                    $UserData =  UserDatas::updateOrCreate([ 'user_id' => $id ],$userdata);
                    if( \Auth::user()->id ==  $User->id ) {
                        $user_id = $User->id;
                    } else {
                        $user_id = '';
                    }
                    $data['id'] = $User->id;
                    $userAllData = array('user'=>$data,'user_data'=>$userdata);
                    addToLog('update_user',serialize($userAllData),$User->id  ,'User');
                    return response()->json(['success' => __('message.user_update_success')]);
                } else {
                    return response()->json(['error' => array('failed' =>  __('message.user_not_found') )]);
                }
            }
            return response()->json(['error'=>$validator->errors()->all()]);
        }
        return response()->json(['error' => array('failed' =>  __('message.create_failed') )]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\UserDatas  $userDatas
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $params = $request->all();
        $getId  = explode("-",base64_decode($params['id']));
        $id = base64_decode($getId['1']);
        if( $id != "" ) {
            $User = User::find($id);
            if( $User ) {
                $User->delete();
                $UserDatas = UserDatas::where('user_id',$id)->delete();
                 addToLog('delete_user',$id,$User->id ,'User');
                return response()->json(['success' => __('message.delete_text')]);
            } else {
                return response()->json(['error' =>  __('message.user_not_found')]);
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
            $User = User::find($id);
            if( $User ) {
                $User->update(['status'=>$params['status']]);
                addToLog('user_status_update',json_encode(array("user_id"=>$User->id,'status'=>$params['status']) ),$User->id,'User' );
                if( $params['status'] == '1' ){
                    return response()->json(['success' => __('message.user_status_active_success') ]);
                } else {
                     return response()->json(['success' => __('message.user_status_deactive_success') ]);
                }
            } else {
                return response()->json(['error' =>  __('message.user_not_found')]);
            }
        }
        return response()->json(['error' => __('message.create_failed')]);
    }
}
