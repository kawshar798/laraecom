<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function login(Request $request)
    {
        $this->validateLogin($request);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {

            if(Auth::user()->status != 1){
//
//                session(['role_id' => Auth::user()->role_id]);
//                // User Log
//                $agent = new Agent();
//                $user_log = new SmUserLog();
//                $user_log->user_id = Auth::user()->id;
//                $user_log->role_id = Auth::user()->role_id;
//                $user_log->ip_address = $request->ip();
//                $user_log->user_agent = $agent->browser().', '.$agent->platform();
//                $user_log->save();
//                // User Log
                $this->guard()->logout();
                $notification=array(
                    'messege'=>'Your is not Verify yet!!!',
                    'alert-type'=>'error'
                );
                return redirect('login')->with($notification);


            }else{
                return $this->sendLoginResponse($request);

            }


        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
//        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $notification=array(
            'messege'=>'Successfully Logout',
            'alert-type'=>'success'
        );
        return Redirect()->route('login')->with($notification);
    }
}
