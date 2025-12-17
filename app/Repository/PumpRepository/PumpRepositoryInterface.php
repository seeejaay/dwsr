<?php

namespace App\Repository\PumpRepository;

use App\Repository\BaseRepository\BaseRepositoryInterface;

interface PumpRepositoryInterface extends BaseRepositoryInterface
{
    public function deletePump($pumpId);
}