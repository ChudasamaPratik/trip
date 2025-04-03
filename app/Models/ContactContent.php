<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContactContent extends Model
{
    use SoftDeletes;
    protected $keyType = 'string';
    public $incrementing = false;
}
