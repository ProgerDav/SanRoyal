<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rezume extends Model
{
    protected $fillable = ['name', 'phone', 'email', 'file', 'profession', 'text'];
}
