<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    use HasFactory;
    protected $fillable=[
        'name',
    ];
    public function product()
    {
        return $this->hasMany(Product::class,'size_id','id');
    }
}