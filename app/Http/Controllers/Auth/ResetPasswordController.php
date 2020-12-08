<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\User;
use DB;
use Validator;
class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }
    public function showResetForm(Request $request, $token = null)
    {
        $tokenByUser =  get_user_by_token($token);

        $TokenTime = "";
        if( isset($tokenByUser->created_at) && $tokenByUser->created_at !="" ) {
            $TokenTime = Carbon::parse($tokenByUser->created_at)->addSeconds(config('auth.passwords.users.expire')*60)->isPast();
        } 
        if( $TokenTime !="" ) {
            return redirect('/login')->with('error',  __('message.token_expire'));
        } elseif( $tokenByUser =="" ) {
             return redirect('/login')->with('error',  __('message.token_not_found'));   
        }
        return view('auth.passwords.reset')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }
    /**
     * Reset the given user's password.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function reset(Request $request)
    {
       $validator = Validator::make($request->all(), [
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:6',
        ],[
            'token.required' => __('message.token_required'),
            'email.required' => __('message.email'),
            'email.email' => __('message.email_valid_required'),
            'password.required' => __('message.password_required'),
            'password.confirmed' => __('message.password_confirmed'),
            'password.min' => __('message.password_min'),
        ]);

        if ($validator->passes()) {
            $params = $request->all();
            $user = User::where('email',$params['email'])->first();
            if( !empty($user) ) {         
                $user->password = Hash::make($params['password']);
                $user->setRememberToken(Str::random(60));
                $user->save();
                DB::table('password_resets')->where('email',$params['email'])->delete();
                event(new PasswordReset($user));
                $this->guard()->login($user);
                return response()->json(['success'=> __('message.password_reset_success') ]);
            }
            return response()->json(['error'=>array('failed'=>  __('passwords.user') )]);
        }
        return response()->json(['error'=>$validator->errors()->all()]);
    }
    protected function guard()
    {
        return Auth::guard();
    }
}
