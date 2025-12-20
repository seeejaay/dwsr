<?php

namespace App\Repository\ProductRepository;

use App\Models\Products;
use App\Repository\BaseRepository\BaseRepository;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{
    //
    public function __construct(Products $model)
    {
        parent::__construct($model);
    }

    public function deleteProduct($productId)
    {
        return $this->model->where('id', $productId)->update([
            'is_active' => 0,
            'is_deleted' => 1,
            'deleted_at' => now()
        ]);
    }
}