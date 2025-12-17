<?php

namespace App\Repository\TaxTypeRepository;

use App\Repository\BaseRepository\BaseRepository;
use App\Models\TaxType;

class TaxTypeRepository extends BaseRepository implements TaxTypeRepositoryInterface
{
    protected $model;

    public function __construct(TaxType $model)
    {
        parent::__construct($model);
    }

    public function deleteTaxType($id)
    {
        return $this->model->where('id', $id)->update([
            'is_deleted' => 1,
            'is_active' => 0,
            'deleted_at' => now(),
        ]);    
    }
}