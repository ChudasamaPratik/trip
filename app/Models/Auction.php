<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Auction extends Model
{
    protected $keyType = 'string';
    public $incrementing = false;

    protected $appends = ['image_url', 'image_url1', 'image_url2'];

    /**
     * Get image URL with fallback to default image.
     *
     * @param string|null $imageName
     * @return string
     */
    protected function getImageUrl($imageName)
    {
        if ($imageName) {
            return asset('storage/auctionSection/' . $imageName);
        }
        return asset('storage/noimage.png'); 
    }

    /**
     * Get the URL for the primary image.
     *
     * @return string
     */
    public function getImageUrlAttribute()
    {
        return $this->getImageUrl($this->image);
    }

    /**
     * Get the URL for the first additional image.
     *
     * @return string
     */
    public function getImageUrl1Attribute()
    {
        return $this->getImageUrl($this->image1);
    }

    /**
     * Get the URL for the second additional image.
     *
     * @return string
     */
    public function getImageUrl2Attribute()
    {
        return $this->getImageUrl($this->image2);
    }


    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }
}
