<?php

namespace App\Repository\UserRepository;

use App\Repository\BaseRepository\BaseRepositoryInterface;

interface UserRepositoryInterface extends BaseRepositoryInterface
{
    public function deleteUser($userId);

    public function getAllForExport($startDate = null, $endDate = null);
}