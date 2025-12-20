<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
class Site extends BaseModel
{
    //
    public $incrementing = false; // UUIDs are not auto-incrementing
    protected $keyType = 'string';
    protected $fillable = [
        'id',
        'ship_to',
        'arnoc',
        'cluster_id',
        'retailer_id',
        'site_name',
        'plant_id',
        'type',
        'zone_id',
        'territory_manager_id',
        'retailer_owner_id',
    ];
}
