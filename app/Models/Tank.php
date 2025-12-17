<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tank extends Model
{
    //
    public $incrementing = false; // UUIDs are not auto-incrementing
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'code',
        'name',
    ];
}
