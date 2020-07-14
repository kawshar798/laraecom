<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
//              return redirect()->to('/')->with($notification);


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
}
