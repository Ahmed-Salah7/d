<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{ 
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    //protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       // $this->middleware('guest')->except('logout');
    }

    public function loginShow()
    {

        if ( \Auth::check()){
            return redirect('/');
        } 

        return view('auth.login');
    }

    public function getLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required',
        ],[
        'username.required' => __('message.username_required'),
        'password.required' => __('message.password_required')
        ]);

        if ($validator->passes()) {
            $params = $request->all();
            $admin = User::where('username',$params['username'])->first();
            if($admin) {
                if( $admin['status'] == 1 ){
                    if ( !empty($admin) && \Hash::check($params['password'], $admin->password) ){
                       \Auth::attempt(['username' => $params['username'], 'password' => $params['password']]);
                         addToLog('user_login','login');
                        return response()->json(['success'=> __('message.login_success') ]);
                    } else {
                        return response()->json(['error'=>array('failed'=>  __('message.login_failed') )]);         
                    } 
                } 
                return response()->json(['error'=>array('failed'=>  __('message.user_disabled') )]);
            }
            return response()->json(['error'=>array('failed'=>  __('message.user_not_found') )]);
        }
        return response()->json(['error'=>$validator->errors()->all()]); 
    }

    public function getLogout(Request $request)
    {
        addToLog('user_logout','logout');
        \Auth::logout();

        return redirect('login');
    }
    
}
