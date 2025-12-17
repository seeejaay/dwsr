<?php

namespace App\Repository\PumpRepository;

use App\Models\Pump;
use App\Repository\BaseRepository\BaseRepository;

class PumpRepository extends BaseRepository implements PumpRepositoryInterface
{
   public function __construct(Pump $model)
   {
       parent::__construct($model);
   }

   public function deletePump($pumpId)
   {
       return $this->model->where('id', $pumpId)->update([
        'is_active' => 0,
        'is_deleted' => 1,
        'deleted_at' => now()
       ]);
   }
}