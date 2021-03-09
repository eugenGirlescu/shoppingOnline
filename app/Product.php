<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    protected $fillable = ['name', 'expire_date'];
    
    public function category()
    {
        return $this->belongsTo('App\Category');
    }
}