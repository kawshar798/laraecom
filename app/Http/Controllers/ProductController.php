<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Cart;
class ProductController extends Controller
{
    //
    public  function  productDetails($id,$product_name){

        $product = Product::where('id',$id)->first();
        $color = $product->color;
        $product_color = explode(',',$color);
        $size = $product->size;
        $product_size = explode(',',$size);
       return view("front-end.product_details",compact('product','product_color','product_size'));
    }


    public function  productCartAdd(Request $request,$id){

        $product = Product::where('id',$id)->first();

        $data = array();
        if($product->discount_price == NULL){
            $data['id'] = $product->id;
            $data['name'] = $product->name;
            $data['qty'] =  $request->qty;
            $data['price'] = $product->selling_price;
            $data['weight'] = 1;
            $data['options']['image'] = $product->image_one;
            $data['options']['color'] = $request->color;
            $data['options']['size'] = $request->size;
            Cart::add($data);
            $notification=array(
                'messege'=>'Successfully added on your Cart',
                'success' => true,
            );
            return  redirect()->back()->with($notification);
        }else{
            $data['id'] = $product->id;
            $data['name'] = $product->name;
            $data['qty'] = $request->qty;
            $data['price'] = $product->discount_price;
            $data['weight'] = 1;
            $data['options']['image'] = $product->image_one;
            $data['options']['color'] = $request->color;
            $data['options']['size'] = $request->size;
            Cart::add($data);
            $notification=array(
                'messege'=>'Successfully added on your Cart',
                'success' => true,
            );
            return  redirect()->back()->with($notification);
        }
    }
}
