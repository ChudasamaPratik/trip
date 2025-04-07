<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserRequirement extends Model
{
    use SoftDeletes;
    protected $keyType = 'string';
    public $incrementing = false;
    protected $appends = ['image_url'];
    public function getImageUrlAttribute()
    {
        if ($this->image) {
            return asset('storage/requirements/' . $this->image);
        }
        return asset('storage/noimage.png');
    }
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }
    protected $fillable = [
        'user_id',
        'origin',
        'destination',
        'days',
        'person',
        'accommodation',
        'image',
        'breakfast',
        'price',
        'tour',
        'status',
        'response_deadline'
    ];
}
