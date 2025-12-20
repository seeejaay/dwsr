<?php

namespace App\Models;

use Faker\Provider\Base;
use Illuminate\Database\Eloquent\Model;

class Products extends BaseModel
{
    //
    public $incrementing = false; // UUIDs are not auto-incrementing
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'product_name',
        'product_category_id',
        'product_type_id'
    ];
}
