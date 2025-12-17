<?php

namespace App\Repository\VarianceRepository;

use App\Repository\BaseRepository\BaseRepositoryInterface;

interface VarianceRepositoryInterface extends BaseRepositoryInterface
{
    //

    public function deleteVariance($id);
}