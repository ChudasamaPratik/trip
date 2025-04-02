<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Auction extends Model
{
    protected $keyType = 'string';
    public $incrementing = false;

    protected $appends = ['image_url', 'image_url1', 'image_url2'];
    public function getImageUrlAttribute()
    {
        if ($this->image) {
            return asset('storage/auctionSection/' . $this->image);
        }
        // return asset('path/to/default-image.jpg'); // Fallback image
    }
    public function getImageUrl1Attribute()
    {
        if ($this->image1) {
            return asset('storage/auctionSection/' . $this->image1);
        }
        // return asset('path/to/default-image.jpg'); // Fallback image
    }
    public function getImageUrl2Attribute()
    {
        if ($this->image2) {
            return asset('storage/auctionSection/' . $this->image2);
        }
        // return asset('path/to/default-image.jpg'); // Fallback image
    }
}
