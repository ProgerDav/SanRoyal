<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    public $timestamps = false;

    public function categories(){
        return $this->belongsTo("App\Category", "cid");
    }

    public function products(){
        return $this->hasMany("App\Product", 'scid');
    }
}
