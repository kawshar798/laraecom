<?php

namespace App\Http\Controllers;

use App\Models\NewsLetter;
use App\Models\Product;
use App\User;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function fontendShow(){
        $featureds   = Product::where('status','Active')->where('featured',1)->get();
        $trends      = Product::where('status','Active')->where('trend',1)->get();
        $best_rateds = Product::where('status','Active')->where('best_rated',1)->get();
        $hots_daels  = Product::where('status','Active')->where('hot_deal',1)->orderBy('id','desc')->limit(3)->get();


        return view('welcome',compact('hots_daels','best_rateds','trends','featureds'));
    }

    public function index()
    {
        return view('user.userhome');
    }
  public function userOrder()
    {
        return view('user.orders');
    }

    public function userProfile()
    {
        return view('user.profile');
    }
    public function userAddress()
    {
        return view('user.address');
    }

    public function userChangePassword(Request $request)
    {
        if($request->isMethod('post')){
            DB::beginTransaction();
            $this->validate($request,[
                'currentpassword' => 'required',
                'password' => 'required|min:6|confirmed',
                'password_confirmation' => 'required|min:6'
            ]);
            $password=Auth::user()->password;
            $currentpass=$request->currentpassword;

            try{
                if (Hash::check($currentpass,$password)){
                    $user=User::find(Auth::id());
                    $user->password=Hash::make($request->password);
                    $user->save();

                    $notification=array(
                        'messege'=>'Your Password change Success',
                        'alert-type'=>'success'
                    );
                    return redirect()->to('user/dashboard')->with($notification);

//            return Redirect()->route('login')->with('Successfully password change');
                }else{

                    $notification=array(
                        'messege'=>'Your current password was incorrect',
                        'alert-type'=>'error'
                    );
                    return redirect()->to('user/change-password')->with($notification);
                }
            }catch (\Exception $e){
                return $e->getMessage();
                DB::rollBack();
            }
        }
        return view('user.changepassword');
    }

    public function newsletterStore(Request $request){

        DB::beginTransaction();
        try{
        $newsletter = new NewsLetter();
         $newsletter->email = $request->email;
         $newsletter->save();
         DB::commit();
         $output = ['success' => true,
         'messege'            => "Thank you for subscribe",
     ];
     return $output;
        }catch(Exception $e){
         DB::rollBack();

        return $e->getMessage();
        }

    }


}
