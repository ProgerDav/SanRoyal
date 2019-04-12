<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function subcategory(){
        return $this->belongsTo("App\SubCategory", 'id');
    }

    public function brand(){
        return $this->belongsTo("App\Brand", 'id');
    }
}
