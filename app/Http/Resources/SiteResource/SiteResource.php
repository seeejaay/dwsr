<?php

namespace App\Http\Resources\SiteResource;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SiteResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->site_name,
            'ship_to' => $this->ship_to,
            'cluster_id' => $this->cluster_id,
            'zone_id' => $this->zone_id,
            'retailer_owner_id' => $this->retailer_owner_id,
        ];
    }
    
}