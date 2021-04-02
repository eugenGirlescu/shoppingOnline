<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable =['user_id' ,'status','delivery_type','comment','hour'];

    public function orderParts()
    {
        return $this->hasMany('App\OrderPart');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}