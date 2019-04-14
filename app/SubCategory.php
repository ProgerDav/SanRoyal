<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    public $timestamps = false;
    // protected $fillable = ["cid", "name", "slug", "image"];

    public function categories(){
        return $this->belongsTo("App\Category", "id");
    }

    public function products(){
        return $this->hasMany("App\Product", 'scid');
    }
}
