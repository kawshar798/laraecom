<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    //

    public  function  addToCart($id){

        $product = Product::where('id',$id)->first();

        $data = array();

        if($product->discount_price == NULL){
            $data['id'] = $product->id;
            $data['name'] = $product->name;
            $data['qty'] = 1;
            $data['price'] = $product->selling_price;
            $data['weight'] = 1;
            $data['options']['image'] = $product->image_one;
            $data['options']['color'] = '';
            $data['options']['size'] = '';
            Cart::add($data);
            $notification=array(
                'messege'=>'Successfully added on your Cart',
                'success' => true,
            );
            return $notification;

        }else{
            $data['id'] = $product->id;
            $data['name'] = $product->name;
            $data['qty'] = 1;
            $data['price'] = $product->discount_price;
            $data['weight'] = 1;
            $data['options']['image'] = $product->image_one;
            $data['options']['color'] = '';
            $data['options']['size'] = '';
            Cart::add($data);
            $notification=array(
                'messege'=>'Successfully added on your Cart',
                'success' => true,
            );
            return $notification;
        }

    }

    public  function  check(){
        $content = Cart::content();
        return $content;
    }
}
