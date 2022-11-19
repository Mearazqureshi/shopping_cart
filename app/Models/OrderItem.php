<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class OrderItem extends Authenticatable
{
    protected $fillable = [
        'order_id','product_id','quantity','total'
    ];

    public function order()
    {
        return $this->belongsTo('App\Models\Order');
    }

    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }
}