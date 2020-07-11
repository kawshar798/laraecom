<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\PostCategory;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index(){

        $posts = Post::get();
        $categories = PostCategory::where('status','Active')->get();
        $nav = "post";
        return view( 'admin.post.index',compact('posts','categories','nav'));
    }

    public function store(Request $request){


        DB::beginTransaction();
       try{
            if($request->id){
                $post = Post::find($request->id);
            }else{
                $post = new Post();
            }
        $post->title = $request->title;
        $post->slug =  Str::slug( $request->title );
        $post->body =  $request->body;
        $post->category_id =  $request->category_id;
        if ($request->hasFile( 'image' ) ) {
            $image = $request->image;
            $file_name = $post->slug . "." . $image->getClientOriginalExtension();
            $path = 'public/backend/assets/uploads/image/post/';
            if ( !file_exists( $path ) ) {
                mkdir( $path, 0777, true );
            }
            $image->move( $path, $file_name );
            $post->image = $path.$file_name;
        }
        $post->created_by = Auth::user()->id;
        $post->status = 'Active';
        $post->save();
        DB::commit();

        $output = ['success' => true,
        'messege'            => "Post Create success",
    ];
    return $output;
       }catch(Exception $e){
        DB::rollBack();

       return $e->getMessage();
       }
    }

    public function active($id){
        $post = Post::find( $id );
        $post->status = 'Active';
        $post->save();
        $output = ['success' => true,
        'messege'            => "Post Active success",
    ];
    return $output;
    }

    public function inactive($id){
        $post = Post::find( $id );
        $post->status = 'Inactive';
        $post->save();
        $output = ['success' => true,
        'messege'            => "Post InActive success",
    ];
    return $output;
    }

    public function destroy( $id ) {
        $post = Post::find( $id );
        if (file_exists($post->image)) {
            unlink( $post->image );
        }

        $post->delete();
        $output = ['success' => true,
            'messege'            => "Post Delete success",
        ];
        return $output;
    }
}


