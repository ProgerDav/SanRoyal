<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CatalogFile extends Model
{
    protected $fillable = ['title', 'image', "file"];
}
