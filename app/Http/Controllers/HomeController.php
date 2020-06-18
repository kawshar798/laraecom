<?php

namespace App\Http\Controllers;

use App\Models\NewsLetter;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\DB;

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
    public function index()
    {
        return view('userhome');
    }

    public function fontendShow(){
        return view('welcome');
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
