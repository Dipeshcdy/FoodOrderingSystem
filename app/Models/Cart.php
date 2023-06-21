<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Cart extends Model
{
    use HasFactory;
    protected $fillable=[
        'price',
        'is_checkout',
        'user_id',
        
    ];
    function Cart_item()
    {
        return $this->hasMany(Cart_item::class,'cart_id','id');
    }
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}