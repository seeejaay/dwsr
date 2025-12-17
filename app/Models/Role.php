<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
class Role extends Model
{
    //
     public $incrementing = false; // UUIDs are not auto-incrementing
    protected $keyType = 'string';
    protected $fillable = [
        'name',
        'description',
        'slug',
        
    ];
}
