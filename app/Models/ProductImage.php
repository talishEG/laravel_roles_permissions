<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class ProductImage extends Model
{
    protected $fillable = ['product_id', 'image_path','primary'];

    protected $appends = ['image_full_path'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function getImageFullPathAttribute()
    {
        return url(Storage::url($this->image_path));
    }
}
