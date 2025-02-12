<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Category extends Model
{
    use HasFactory;

    protected $appends = ['image_full_path'];

    protected $fillable = [
        'name',
        'slug',
        'image',
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'category_product');
    }

    public function getImageFullPathAttribute()
    {
        return url(Storage::url($this->image));
    }
}
