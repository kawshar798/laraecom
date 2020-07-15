<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Product extends Model
{
    //

    protected $table = 'products';

    protected $fillable = [
        'name', 'category_id', 'description','quantity', 'color', 'featured','image','status','created_by','updated_by','deleted_by'
    ];

    public function category(){
//        return $this->belongsTo('App\Models\Category');
        return $this->belongsTo(Category::class,'category_id','id');
    }
    public function subcategory(){
//        return $this->belongsTo('App\Models\Category');
        return $this->belongsTo(Category::class,'sub_category_id','id');
    }

    public function brand(){
//        return $this->belongsTo('App\Models\Brand');
        return $this->belongsTo(Brand::class,'brand_id','id');

    }
}
