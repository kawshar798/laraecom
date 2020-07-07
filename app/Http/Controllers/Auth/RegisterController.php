<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
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
                return "ekhn tmk mail verifed korte hobe";




        }catch (\Exception $e){
            DB::rollBack();
        }

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
