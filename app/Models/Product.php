<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'quantyty',
        'description',
        'picture',
        'value',
        'brand_id'
    ];
    public function getPictureAttribute()
    {
        return Storage::url($this->attributes['picture']);
    }
    public function picture()
    {
        return $this->attributes['picture'];
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function userProducts()
    {
        return $this->hasMany(UserProduct::class);
    }
}
