<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Slider extends Model
{
    use SoftDeletes;
    protected $keyType = 'string';
    public $incrementing = false;

    protected $appends = ['image_url'];
    public function getImageUrlAttribute()
    {
        if ($this->image) {
            return asset('storage/slider/' . $this->image);
        }
        // return asset('path/to/default-image.jpg'); // Fallback image
    }
}
