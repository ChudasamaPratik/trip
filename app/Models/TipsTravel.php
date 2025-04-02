<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TipsTravel extends Model
{
    use SoftDeletes;
    protected $keyType = 'string';
    public $incrementing = false;


    protected $appends = [
        'thumbnail_url',
        'image1_url',
        'image2_url'
    ];
    public function getThumbnailUrlAttribute()
    {
        if ($this->image) {
            return asset('storage/tips-and-travels/' . $this->image);
        }
        return null; // Or return a default image path
    }

    public function getImage1UrlAttribute()
    {
        if ($this->image1) {
            return asset('storage/tips-and-travels/' . $this->image1);
        }
        return null; // Or return a default image path
    }

    public function getImage2UrlAttribute()
    {
        if ($this->image2) {
            return asset('storage/tips-and-travels/' . $this->image2);
        }
        return null; // Or return a default image path
    }
}
