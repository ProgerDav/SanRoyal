<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function sub_categories(){
        return $this->belongsTo("App\SubCategory", 'id');
    }

    public function brands(){
        return $this->belongsTo("App\Brand", 'id');
    }
}
