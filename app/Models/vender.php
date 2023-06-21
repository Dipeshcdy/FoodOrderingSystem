<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class vender extends Model
{
    use HasFactory;
    protected $fillable=[
        'brand_name',
        'service',
        'logo',
        'is_approved',
        'image_cover',
        'user_id',
    ];

    public function user()
    {
       return $this->belongsTo(User::class,'user_id');
    }
}