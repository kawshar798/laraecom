<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

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
}
