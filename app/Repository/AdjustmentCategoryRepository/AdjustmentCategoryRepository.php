<?php

namespace App\Repository\AdjustmentCategoryRepository;

use App\Models\AdjustmentCategory;
use App\Repository\BaseRepository\BaseRepository;

class AdjustmentCategoryRepository extends BaseRepository implements AdjustmentCategoryRepositoryInterface
{
   public function __construct(AdjustmentCategory $model)
   {
       parent::__construct($model);
   }

  
}