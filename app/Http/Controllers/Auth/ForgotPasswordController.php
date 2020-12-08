<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\Password;
use Validator;
class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }
    
   public function sendResetLinkEmail(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
           'email' => 'required|email',
        ],[
             'email.required' => __('message.email'),
            'email.email' => __('message.email_valid_required'),
        ]);
        if ($validator->passes()) {
            // Check if the user is active, if not then return the response
            $checkFailure = $this->checkUserActive($request->only('email'));
            if(!is_null($checkFailure)) {
              return $checkFailure;
            }

            // We will send the password reset link to this user. Once we have attempted
            // to send the link, we will examine the response then see the message we
            // need to show to the user. Finally, we'll send out a proper response.
            // $response = $this->broker()->sendResetLink($request->only('email'));
            $response = $this->broker()->sendResetLink($request->only('email'));

            $response == Password::RESET_LINK_SENT
                        ? $this->sendResetLinkResponse($request, $response)
                        : $this->sendResetLinkFailedResponse($request, $response);
            if($response == 'passwords.user') {
                 return response()->json(['error'=>array('failed'=> __('passwords.user') )]);
            } else {
                 return response()->json(['success'=> __('passwords.sent') ]);
            } 
        }
        return response()->json(['error'=>$validator->errors()->all()]); 
    }


    /**
     * CUSTOM METHOD, check if a user is active using the broker to grab user.
     * Notice PasswordBroker checks if active first, lets mimic this
     *  functionality by doing this first as well.
     *
     * @param  array  $credentials
     * @return \Illuminate\Http\RedirectResponse
     */
    public function checkUserActive(array $credentials)
    {
        // First we will check to see if we found a user at the given
        //  credentials and if we did not we will redirect back to this current
        //  URI with a piece of "flash" data in the session to indicate to the
        //  developers the errors.
        $user = $this->broker()->getUser($credentials);
        // This check is why we needed this extra method.  We first need to
        // Check with the broker if the user is not null, so that when arent
        //  checking if active on a null object
        if (is_null($user)) {
            return response()->json(['error'=>array('failed'=>  __('passwords.user') )]);
        }

        // Check if user is active now, before doing anything. In this case, we
        //  just return back with a message, telling them its not active yet.

        if ($user->status == 2) {
             return response()->json(['error'=>array('failed'=>  __('message.user_disabled') )]);
        }
    }
}
