<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $timestamps = false;
    protected $fillable = ['name', 'slug', 'image'];

    public function subcategories(){
        return $this->hasMany('App\SubCategory', 'cid');
    }
}
