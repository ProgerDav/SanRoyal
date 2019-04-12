<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $timestamps = false;

    public function subcategories(){
        return $this->hasMany('App\SubCategory', 'cid');
    }
}
