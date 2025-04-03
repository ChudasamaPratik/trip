<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Agent extends Model
{
    use SoftDeletes;
    protected $keyType = 'string';
    public $incrementing = false;
 
    protected $fillable = ['id','user_id'];

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }
}
