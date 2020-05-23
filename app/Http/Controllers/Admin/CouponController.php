<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Str;
class CouponController extends Controller
{
    //
    
    public function index(){

        $coupons = Coupon::get();
        return view( 'admin.coupon.index',compact('coupons'));
    }

    public function store(Request $request){
        
     
         $request->id;
        DB::beginTransaction();
       try{
            if($request->id){
                $coupon = Coupon::find($request->id);
            }else{
                $coupon = new Coupon();
            }
      
        $coupon->coupon = $request->coupon;
        $coupon->discount = $request->discount;
        $coupon->status = 'Active';
        if($request->id){
            $coupon->updated_by =Auth::user()->id;
        }else{
            $coupon->created_by =Auth::user()->id;
        }
        
        $coupon->save();
        DB::commit();
        // return "kaj hoice";
        
        $output = ['success' => true,
        'messege'            => "Coupon Create success",
    ];
    return $output;

       }catch(Exception $e){
        DB::rollBack();
       
       return $e->getMessage();
       }
    }

    public function active($id){
        $category = Coupon::find( $id );
        $category->status = 'Active';
        $category->save();
        $output = ['success' => true,
        'messege'            => "Brand Active success",
    ];
    return $output;
    }

    public function inactive($id){
        $category = Coupon::find( $id );
        $category->status = 'Inactive';
        $category->save();
        $output = ['success' => true,
        'messege'            => "Brand InActive success",
    ];
    return $output;
    }

    public function destroy( $id ) {
        $coupon = Coupon::find( $id );
        $coupon->delete();
        $output = ['success' => true,
            'messege'            => "Coupon Delete success",
        ];
        return $output;
    }
}
