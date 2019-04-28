<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    public $timestamps = false;
    protected $fillable = ['name', 'slug', 'description', 'image'];
    
    public function products(){
        return $this->hasMany("App\Product", 'bid');
    }

    public function sub_categories(){
        return $this->hasManyThrough("App\SubCategory", "App\Product", "bid", "id", "id", "id");
    }
}
