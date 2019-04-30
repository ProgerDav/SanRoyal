<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    protected $fillable = ['contact_name', 'email', 'phone', 'organization', 'site', 'cid', 'city', 'source'];

    public function categories(){
        return $this->belongsToMany('App\Category', 'cid');
    }
}
