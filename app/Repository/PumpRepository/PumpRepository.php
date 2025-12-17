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
}