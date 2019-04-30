<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'warranty', 'production', 'json_properties', 'slug', 'description', 'scid', 'bid', 'image', 'additional_images'];

    public function sub_categories(){
        return $this->belongsTo("App\SubCategory", 'scid');
    }

    public function brands(){
        return $this->belongsTo("App\Brand", 'bid');
    }
}
