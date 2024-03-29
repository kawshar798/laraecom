<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Carbon;

class ProductController extends Controller {
    //

    public function index() {
       $products =  Product::get();
       $nav = "product";
        return view( 'admin.product.index',compact('products','nav') );
    }
    public function create() {

        $categories = Category::where( 'parent_id', 0 )->where( 'status', 'Active' )->get();
        $brands = Brand::where( 'status', 'Active' )->get();
        $nav = "product_create";
        return view( 'admin.product.create', compact( 'brands', 'categories','nav' ) );
    }

    public function store( Request $request ) {
        DB::beginTransaction();
        try {
            $product = new Product();
            $product->name = $request->name;
            $code = rand(000000,999999);
            if($request->code){
                $product->code = $request->code;
            }else{
                $product->code = $code;
            }
            $product->quantity = $request->quantity;
            $product->alert_quantity = $request->alert_quantity;
            $product->category_id = $request->category_id;
            $product->sub_category_id = $request->sub_category_id;
            $product->brand_id = $request->brand_id;
            $product->cost_price = $request->cost_price;
            $product->selling_price = $request->selling_price;
            $product->discount_price = $request->discount_price;
            $product->size = $request->size;
            $product->color = $request->color;
            $product->video_link = $request->video_link;
            $product->main_slider = $request->main_slider;
            $product->mid_slider = $request->mid_slider;
            $product->best_rated = $request->best_rated;
            $product->trend = $request->trend;
            $product->featured = $request->featured;
            $product->hot_deal = $request->hot_deal;
            $product->buy_get_one = $request->buy_get_one;
            $product->hot_new = $request->hot_new;
            $product->description = $request->description;
            $currentDate = Carbon::now()->toDateString();
            if ( $request->hasFile( 'image_one' ) ) {
                $image = $request->image_one;
                $file_name = $currentDate.$product->slug . "-" . uniqid() . "." . $image->getClientOriginalExtension();
                $path = 'public/backend/assets/uploads/image/product/';
                if ( !file_exists( $path ) ) {
                    mkdir( $path, 0777, true );
                }
                Image::make( $image )->resize( 1600, 1066 )->save( $file_name );
                $image->move( $path, $file_name );
                $product->image_one = $path . $file_name;
            }
            if ( $request->hasFile( 'image_two' ) ) {
                $image = $request->image_two;
                $file_name = $product->slug . "-" . uniqid() . "." . $image->getClientOriginalExtension();
                $path = 'public/backend/assets/uploads/image/product/';
                if ( !file_exists( $path ) ) {
                    mkdir( $path, 0777, true );
                }
                Image::make( $image )->resize( 1600, 1066 )->save( $file_name );
                $image->move( $path, $file_name );
                $product->image_two = $path . $file_name;
            }

            if ( $request->hasFile( 'image_three' ) ) {
                $image = $request->image_three;
                $file_name = $product->slug . "-" . uniqid() . "." . $image->getClientOriginalExtension();
//                $path = 'public/upload/image/product/';
                $path = 'public/backend/assets/uploads/image/product/';
                if ( !file_exists( $path ) ) {
                    mkdir( $path, 0777, true );
                }
                Image::make( $image )->resize( 1600, 1066 )->save( $file_name );
                $image->move($path, $file_name );
                $product->image_three = $path . $file_name;
            }
            $product->save();
            DB::commit();

            $notification = [
                'messege'    => 'Successfully  Product Create',
                'alert-type' => 'success',
            ];
            return Redirect()->route('product')->with( $notification );

        } catch ( Exception $e ) {
            DB::rollBack();
            return $e->getMessage();
        }

    }



        public function edit($id){
            $categories = Category::where( 'parent_id', 0 )->where( 'status', 'Active' )->get();
            $sub_categories = Category::where( 'parent_id', '!=',0 )->where( 'status', 'Active' )->get();

            $brands = Brand::where( 'status', 'Active' )->get();
            $product = Product::where('id',$id)->first();
            return view( 'admin.product.edit', compact( 'brands', 'categories','product','sub_categories') );

        }
        public function update(Request $request){
            DB::beginTransaction();
            try {
                $product = Product::find($request->id);
                $product->name = $request->name;
                $product->code = $request->code;
                $product->quantity = $request->quantity;
                $product->alert_quantity = $request->alert_quantity;
                $product->category_id = $request->category_id;
                $product->sub_category_id = $request->sub_category_id;
                $product->brand_id = $request->brand_id;
                $product->cost_price = $request->cost_price;
                $product->selling_price = $request->selling_price;
                $product->discount_price = $request->discount_price;
                $product->size = $request->size;
                $product->color = $request->color;
                $product->video_link = $request->video_link;
                $product->main_slider = $request->main_slider;
                $product->mid_slider = $request->mid_slider;
                $product->best_rated = $request->best_rated;
                $product->trend = $request->trend;
                $product->featured = $request->featured;
                $product->hot_new = $request->hot_new;
                $product->hot_deal = $request->hot_deal;
                $product->buy_get_one = $request->buy_get_one;
                $product->description = $request->description;
                $currentDate = Carbon::now()->toDateString();
                if ( $request->hasFile( 'image_one' ) ) {
                    $image = $request->image_one;
                    $file_name = $currentDate.$product->slug . "-" . uniqid() . "." . $image->getClientOriginalExtension();
                    $path = 'public/backend/assets/uploads/image/product/';
                    if ( !file_exists( $path ) ) {
                        mkdir( $path, 0777, true );
                    }
                    Image::make( $image )->resize( 1600, 1066 )->save( $file_name );
                    $image->move( $path, $file_name );
                    $product->image_one = $path . $file_name;
                }
                if ( $request->hasFile( 'image_two' ) ) {
                    $image = $request->image_two;
                    $file_name = $product->slug . "-" . uniqid() . "." . $image->getClientOriginalExtension();
                    $path = 'public/backend/assets/uploads/image/product/';
                    if ( !file_exists( $path ) ) {
                        mkdir( $path, 0777, true );
                    }
                    Image::make( $image )->resize( 1600, 1066 )->save( $file_name );
                    $image->move( $path, $file_name );

                    $product->image_two = $path . $file_name;
                }

                if ( $request->hasFile( 'image_three' ) ) {
                    $image = $request->image_three;
                    $file_name = $product->slug . "-" . uniqid() . "." . $image->getClientOriginalExtension();
                    $path = 'public/backend/assets/uploads/image/product/';
                    if ( !file_exists( $path ) ) {
                        mkdir( $path, 0777, true );
                    }
                    Image::make( $image )->resize( 1600, 1066 )->save( $file_name );
                    $image->move( $path, $file_name );
                    $product->image_three = $path . $file_name;
                }
                $product->save();
                DB::commit();

                $notification = [
                    'messege'    => 'Successfully  Product Update',
                    'alert-type' => 'success',
                ];
                return Redirect()->route( 'product' )->with( $notification );

            } catch ( Exception $e ) {
                DB::rollBack();
                return $e->getMessage();

            }
        }

    public function active($id){
        $category = Product::find( $id );
        $category->status = 'Active';
        $category->save();
        $output = ['success' => true,
        'messege'            => "Product Active success",
    ];
    return $output;
    }

    public function inactive($id){
        $category = Product::find( $id );
        $category->status = 'Inactive';
        $category->save();
        $output = ['success' => true,
        'messege'            => "Product InActive success",
    ];
    return $output;
    }

    public function destroy( $id ) {
        $category = Product::find( $id );
        if (file_exists($category->image)) {
            unlink( $category->image );
        }

        $category->delete();
        $output = ['success' => true,
            'messege'            => "Product Delete success",
        ];
        return $output;
    }





}
