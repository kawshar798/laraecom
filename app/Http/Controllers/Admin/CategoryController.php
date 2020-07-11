<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Str;

class CategoryController extends Controller {
    //
    public function index() {

        $categories = Category::all();
        $nav='category';
        return view( 'admin.category.index', compact( 'categories','nav' ) );
    }

    /****
     ***** Store and update create category
     ****/
    public function create( Request $request ) {

        if ( $request->isMethod( 'post' ) ) {


            if ( $request->id ) {
                $category = Category::find( $request->id );
            } else {
                $request->validate( [
                    'name' => 'required|unique:categories|max:255',
                ] );
                $category = new Category();
            }
            DB::beginTransaction();
            try {

                if ( !empty( $request->parent_id ) ) {
                    $category->parent_id = $request->parent_id;
                } else {
                    $category->parent_id = 0;
                }
                $category->name = $request->name;
                $category->slug = Str::slug( $request->name );
                $category->description = $request->description;
                $category->featured = $request->featured ? 1 : 0;
                $category->status = 'Active';
                if ( $request->hasFile( 'image' ) ) {
                    $image = $request->image;
                    $file_name = $category->slug . "." . $image->getClientOriginalExtension();
                    $path = 'public/backend/assets/uploads/image/category/';
                    if ( !file_exists( $path ) ) {
                        mkdir( $path, 0777, true );
                    }
                    $image->move( $path, $file_name );
                    //delete old image
                    if ( $category->image ) {
                        unlink( $category->image );
                    }
                    $category->image = $path.$file_name;
                }

                //update same database image
                if ( $category->image ) {
                    $category->image = $category->image;
                }
                $category->created_by = Auth::user()->id;
                $category->save();
                DB::commit();

                if($category->id){
                    $notification = [
                        'messege'    => 'Successfully Category Update',
                        'alert-type' => 'success',
                    ];
                }else{
                    $notification = [
                        'messege'    => 'Successfully Category Create',
                        'alert-type' => 'success',
                    ];
                }

                return Redirect()->route( 'category.index' )->with( $notification );

            } catch ( Exception $e ) {
                DB::rollBack();
                $notification = [
                    'messege'    => $e->getMessage(),
                    'alert-type' => 'error',
                ];
                return Redirect()->route( 'category.index' )->with( $notification );
            }

        }
        $parent_categories = Category::where( 'parent_id', 0 )->get();
        // return $parent_categories;
        $nav='category_create';
        return view( 'admin.category.create', compact( 'parent_categories','nav' ) );

    }

    public function edit( $id ) {
        $category = Category::find( $id );
        $parent_categories = Category::where( 'parent_id', 0 )->get();
        return view( 'admin.category.create', compact( 'category', 'parent_categories' ) );
    }


    public function active($id){
        $category = Category::find( $id );
        $category->status = 'Active';
        $category->save();
        $output = ['success' => true,
        'messege'            => "Category Active success",
    ];
    return $output;
    }

    public function inactive($id){
        $category = Category::find( $id );
        $category->status = 'Inactive';
        $category->save();
        $output = ['success' => true,
        'messege'            => "Category InActive success",
    ];
    return $output;
    }


    public function getSubCategory($id){
        $subcategories = Category::where('parent_id',$id)->where('status','Active')->get();

        return $subcategories;

    }
    public function destroy( $id ) {
        $category = Category::find( $id );
        if (file_exists($category->image)) {
            unlink( $category->image );
        }

        $category->delete();
        $output = ['success' => true,
            'messege'            => "Category Delete success",
        ];
        return $output;
    }


}
