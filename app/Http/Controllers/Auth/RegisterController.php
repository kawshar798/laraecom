<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\VarificationEmail;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
//            'phone' => ['required', 'string', 'phone', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */

    public function  userRegister(Request $request){

        DB::beginTransaction();
        $this->validate($request,[
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);
        try{

                $user = new User();
                $code = rand(0000,9999);
                $user->name     = $request->name;
                $user->email    = $request->email;
                $user->phone    = $request->phone;
                $user->password = $request->password;
                $user->code     =  $code;
                $user->status = 0;
                $user->save();
                DB::commit();
                Mail::to($user->email)->send(new VarificationEmail($user));
                return redirect()->to('email/verify');




        }catch (\Exception $e){
            DB::rollBack();
        }

    }

    public  function  varifyEmail(Request  $request){
        if($request->isMethod('post')){
           $user =  User::where('code',$request->code)->where('email',$request->email)->first();
           if($user){
               $user->status = 1;
               $user->save();
               $notification=array(
                   'messege'=>'Your account is verified,Please login',
                   'alert-type'=>'success'
               );
               return redirect()->route('login')->with($notification);
           }else{
               $notification=array(
                   'messege'=>'Your Email or Verification Code is Invalid',
                   'alert-type'=>'error'
               );
               return redirect()->to('email/verify')->with($notification);
           }

        }
        return view('auth.emailVerification');
    }
//    protected function create(array $data)
//    {
//
//        return User::create([
//            'name' => $data['name'],
//            'email' => $data['email'],
//            'phone' => $data['phone'],
//            'password' => Hash::make($data['password']),
//        ]);
//    }
}
