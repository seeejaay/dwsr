<?php

namespace App\Repository\ProductRepository;

use App\Repository\BaseRepository\BaseRepositoryInterface;

interface ProductRepositoryInterface extends BaseRepositoryInterface
{
    //
    public function deleteProduct($productId);
}