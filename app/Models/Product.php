<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Product extends Authenticatable
{
    protected $fillable = [
        'name', 'quantity', 'price', 'image', 'status'
    ];
}