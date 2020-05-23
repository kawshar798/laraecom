<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NewsLetter;
use Illuminate\Http\Request;

class NewsLetterController extends Controller
{
    //

    public function index(){
        $newsletters = NewsLetter::get();
        return view( 'admin.newsletter.index',compact('newsletters'));
    }
    public function destroy( $id ) {
        $newsletters = NewsLetter::find( $id );
        $newsletters->delete();
        $output = ['success' => true,
            'messege'            => "Newsletter Delete success",
        ];
        return $output;
    }
}
