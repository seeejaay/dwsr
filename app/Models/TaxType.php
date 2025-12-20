<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TaxType extends BaseModel
{
    //
    public $incrementing = false; // UUIDs are not auto-incrementing
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'name',
    ];
}
