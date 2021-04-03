<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function blogcount(){

        return $this->hasMany('App\Models\Blogs','category','id')->count();
    }
}
