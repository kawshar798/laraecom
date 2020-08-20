<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class WishlistController extends Controller
{
    //

    public function  addWishlist($id){
        $user_id = Auth::id();
        $product_id = $id;
        if(Auth::check()){
          $exist =  Wishlist::where('user_id',$user_id)->where('product_id',$product_id)->first();
          if($exist){
              $notification=array(
                  'messege'=>'This Product already has in your Wishlist',
                  'error' => true,
              );
              return $notification;
          }else{

              $wishlist = new Wishlist();
              $wishlist->user_id    = $user_id;
              $wishlist->product_id = $product_id;
              $wishlist->save();
              $notification=array(
                  'messege'=>'Add to  Wishlist',
                  'success' => true,
              );
              return $notification;
          }
        }else{

            $notification=array(
                'messege'=>'Login Your Account First',
//                'alert-type'=>'warning',
                'warning' => true,
            );
            return $notification;
        }
    }

    public  function userWishlist(){
        if(Auth::check()){
           $user_id = Auth::id();
           $products = DB::table('wishlists')
               ->join('products','wishlists.product_id','products.id')
               ->select('products.*','wishlists.user_id')
               ->where('wishlists.user_id',$user_id)
               ->get();
            return view('front-end.wishlist',compact('products'));
        }else{
            $notification=array(
                'messege'=>'Login Your Account First',
                'alert-type'=>'warning',
            );
            return redirect()->to('login')->with($notification);
        }
    }

    public  function  userWishlistRemove($id){
        $wishlist = Wishlist::find($id);
        $wishlist->delete();
        $notification=array(
            'messege'=>'Product remove success from Wishlist',
            'alert-type'=>'success',
        );
        return redirect()->back()->with($notification);
    }
}
