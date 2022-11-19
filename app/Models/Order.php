<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Order extends Authenticatable
{
    protected $fillable = [
        'user_id','name','phone','address','total','status'
    ];

    public function items()
    {
        return $this->hasMany('App\Models\OrderItem');
    }
}