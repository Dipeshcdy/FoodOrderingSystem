<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable=[
        'name',
        'price',
        'status',
        'size_id',
        'user_id',
    ];
    public function size()
    {
        return $this->belongsTo(Size::class,'size_id');
        
    }
    public function cart_item()
    {
        return $this->hasMany(Cart_item::class,'cart_id','id');
    }
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}