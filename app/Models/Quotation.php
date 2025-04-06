<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Quotation extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'requirement_id',
        'agent_id',
        'price',
        'id',
        'description',
        'attachment',
        'status'
    ];

    protected $keyType = 'string';
    public $incrementing = false;

    public function requirement()
    {
        return $this->belongsTo(UserRequirement::class, 'requirement_id');
    }
    public function agent()
    {
        return $this->belongsTo(User::class, 'agent_id');
    }
}
