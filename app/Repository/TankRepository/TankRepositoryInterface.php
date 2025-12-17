<?php

namespace App\Repository\TankRepository;

use App\Repository\BaseRepository\BaseRepositoryInterface;

interface TankRepositoryInterface extends BaseRepositoryInterface
{
    //

    public function deleteTank($tankId);
}