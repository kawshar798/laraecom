<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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


    public function  showCart(){
        $contents = Cart::content();
        return view('front-end.cart',compact('contents'));
    }

    public function  removeCart($id){
        Cart::remove($id);

        $notification = [
            'messege'    => 'Product Remove from Cart Success',
            'alert-type' => 'success',
        ];
        return Redirect()->back();

    }


    public function  udpateCartProductQty(Request $request){

            $rowId = $request->id;
            $qty = $request->qty;
            Cart::update($rowId,$qty);
            $notification = [
                        'messege'    => 'Product Update Success',
                        'alert-type' => 'success',
                    ];
        return Redirect()->back();

    }

    public function  cartProductView($id){
            $product = Product::where('id',$id)->first();
        $product_cat = $product->category->name?$product->category->name:'';
        $product_sub_cat = $product->subcategory->name?$product->subcategory->name:'';
        $product_brand = $product->brand->name?$product->brand->name:'';

        $color = $product->color;
        $product_color = explode(',',$color);
        $size = $product->size;
        $product_size = explode(',',$size);
            return response()->json(array(
                'product' => $product,
                'product_color' => $product_color,
                'product_size' => $product_size,
                'product_cat' => $product_cat,
                'product_sub_cat' => $product_sub_cat,
                'product_brand' => $product_brand,
            ));
    }


    public function  addProductInCart(Request $request){
        if($request->product_id){
            $id = $request->product_id;
            $product = Product::where('id',$id)->first();
            $data = array();

            if($product->discount_price == NULL){
                $data['id'] = $product->id;
                $data['name'] = $product->name;
                $data['qty'] =$request->qty;
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
                return redirect()->back()->with($notification);

            }else{
                $data['id'] = $product->id;
                $data['name'] = $product->name;
                $data['qty'] =$request->qty;
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
                return redirect()->back()->with($notification);
            }
        }
    }

    public function  userCheckOut(){

        if(Auth::check()){
            $contents = Cart::content();
            return view('front-end.checkout',compact('contents'));
        }else{
            $notification=array(
                'messege'=>'Login Your Account First',
                'alert-type'=>'warning',
//                'warning' => true,
            );
            return redirect()->to('login')->with($notification);
        }
    }
}
