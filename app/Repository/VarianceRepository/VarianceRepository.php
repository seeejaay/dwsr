<?php

namespace App\Repository\VarianceRepository;

use App\Models\Variance;
use App\Repository\BaseRepository\BaseRepository;

class VarianceRepository extends BaseRepository implements VarianceRepositoryInterface
{
    protected $model;

    public function __construct(Variance $model)
    {
        parent::__construct($model);
    }

    public function deleteVariance($id)
    {
        return $this->model->where('id', $id)->update([
            'is_deleted' => 1,
            'is_active' => 0,
            'deleted_at' => now(),
        ]);    
    }
}