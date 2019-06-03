<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $fillable = ['scid', 'bid', 'image'];

    public function subcategory(){
        return $this->belongsTo('App\SubCategory', 'scid');
    }

    public function brand(){
        return $this->belongsTo('App\Brand', 'bid');
    }
}
