<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
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
