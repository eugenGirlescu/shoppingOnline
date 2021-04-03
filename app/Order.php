<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

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

    public static function removeCart()
    {
        $loggedUser = Auth::user()->id;
        $order = Order::with('orderParts')
                        ->where('user_id', $loggedUser)
                        ->where('status', 'DRAFT')
                        ->orderBy('created_at', 'DESC')
                        ->first();

        if ($order) {
            if (count($order->orderParts)) {
                foreach ($order->orderParts as $part) {
                    $part->delete();
                }
            }
            $order->delete();
        }

        return true;
    }
}