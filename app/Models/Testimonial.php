<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Testimonial extends Model
{
    use SoftDeletes;
    protected $keyType = 'string';
    public $incrementing = false;

    protected $appends = ['image_url'];
    public function getImageUrlAttribute()
    {
        if ($this->image) {
            return asset('storage/testimonials/' . $this->image);
        }
        return asset('storage/noimage.png');
    }
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }
}
