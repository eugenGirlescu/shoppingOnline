<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderPart extends Model
{
    protected $fillable =['order_id','product_id','product_name','product_price','quantity','price'];
}