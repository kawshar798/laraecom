<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    //

    use SoftDeletes;

    protected $table = 'categories';
 
    protected $fillable = [
        'name', 'slug', 'description', 'parent_id', 'featured','image','status','created_by','updated_by','deleted_by'
    ];

    public function parent(){
        return $this->belongsTo(Category::class, 'parent_id');
        }
     
        public function children(){
            return $this->hasMany(Category::class, 'parent_id');
        }
 
}
