<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    //
    public function index(){

        $categories = Category::all();
        return view('admin.category.index',compact('categories'));
    }

    public function create(Request $request){


        if($request->isMethod('post')){
           
            DB::beginTransaction();
            try{
                $category = new Category();
                $category->name = $request->name;
                $category->slug = $request->name;
                $category->description = $request->description;
                $category->parent_id = $request->parent_id;
                $category->status = 'Active';
    
                if($request->hasFile('image')){
                    $image = $request->image;
                    $file_name =  $category->slug . "." . $image->getClientOriginalExtension();
                    $path = 'uploads/image/category/';
                    if (!file_exists($path)) {
                        mkdir($path, 0777, true);
                    }
                    $image->move($path, $file_name);
                    $category->image = $file_name;
                }
                $category->created_by = Auth::user()->id;
                $category->save();
                DB::commit();

                return "kaj hoice";

            }catch(Exception $e){
                DB::rollBack();
                return $e->getMessage();
            }
    
        }
       return view('admin.category.create');


    }

    public function destroy($id){
      $cate =  Category::find($id);
      $cate->delete();
      $output = ['success' => true,
      'messege' => "Category Delete success"
      ];
      return $output;

    }
}
