<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AgentBid extends Model
{
    //
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }
}
