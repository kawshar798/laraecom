<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Product extends Model
{
    //

    public function category(){
        return $this->belongsTo('App\Models\Category');
    }

    public function brand(){
        return $this->belongsTo('App\Models\Brand');
    }
}
