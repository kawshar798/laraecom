<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PostCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Str;
use Illuminate\Support\Facades\Auth;
use Exception;

class PostCategoryController extends Controller
{
    //

    public function index(){
        $post_categories = PostCategory::get();
        return view( 'admin.post-category.index',compact('post_categories'));
    }

    public function store(Request $request){
            DB::beginTransaction();
           try{
                if($request->id){
                    $category = PostCategory::find($request->id);
                }else{
                    $category = new PostCategory();
                }
          
    
    
            $category->name = $request->name;
            $category->slug =  Str::slug( $request->name );
            $category->description = $request->description;
            $category->status = 'Active';
            $category->created_by = Auth::user()->id;
            $category->save();
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
            $category = PostCategory::find( $id );
            $category->status = 'Active';
            $category->save();
            $output = ['success' => true,
            'messege'            => "Category Active success",
        ];
        return $output;
        }
    
        public function inactive($id){
            $category = PostCategory::find( $id );
            $category->status = 'Inactive';
            $category->save();
            $output = ['success' => true,
            'messege'            => "Category InActive success",
        ];
        return $output;
        }
    
        public function destroy( $id ) {
            $category = PostCategory::find( $id );
            $category->delete();
            $output = ['success' => true,
                'messege'            => "Category Delete success",
            ];
            return $output;
        }
    
}
