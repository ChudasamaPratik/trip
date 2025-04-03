<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HowItWork extends Model
{
    use SoftDeletes;
    protected $keyType = 'string';
    public $incrementing = false;

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }
}
