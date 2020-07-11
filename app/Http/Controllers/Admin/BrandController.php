<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Str;
class BrandController extends Controller
{
    //

    public function index(){

        $brands = Brand::get();
        $nav = 'brand';
        return view( 'admin.brand.index',compact('brands','nav'));
    }

    public function store(Request $request){


        DB::beginTransaction();
       try{
            if($request->id){
                $brand = Brand::find($request->id);
            }else{
                $brand = new Brand();
            }



        $brand->name = $request->name;
        $brand->slug =  Str::slug( $request->name );
        if ($request->hasFile( 'logo' ) ) {
            $image = $request->logo;
            $file_name = $brand->slug . "." . $image->getClientOriginalExtension();
            $path = 'public/backend/assets/uploads/image/brand/';
            if ( !file_exists( $path ) ) {
                mkdir( $path, 0777, true );
            }
            $image->move( $path, $file_name );
            // $request->logo->move(public_path($path), $file_name);
            $brand->logo = $path.$file_name;
        }
        $brand->status = 'Active';
        $brand->created_by = Auth::user()->id;
        $brand->save();
        DB::commit();

        $output = ['success' => true,
        'messege'            => "Category Delete success",
    ];
    return $output;
       }catch(Exception $e){
        DB::rollBack();

       return $e->getMessage();
       }
    }

    public function active($id){
        $category = Brand::find( $id );
        $category->status = 'Active';
        $category->save();
        $output = ['success' => true,
        'messege'            => "Brand Active success",
    ];
    return $output;
    }

    public function inactive($id){
        $category = Brand::find( $id );
        $category->status = 'Inactive';
        $category->save();
        $output = ['success' => true,
        'messege'            => "Brand InActive success",
    ];
    return $output;
    }

    public function destroy( $id ) {
        $brand = Brand::find( $id );
        if (file_exists($brand->image)) {
            unlink( $brand->image );
        }
        $brand->delete();
        $output = ['success' => true,
            'messege'            => "Brand Delete success",
        ];
        return $output;
    }
}
