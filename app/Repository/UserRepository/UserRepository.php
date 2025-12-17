<?php

namespace App\Repository\UserRepository;

use App\Models\User;
use App\Repository\BaseRepository\BaseRepository;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    public function deleteUser($userId)
    {
        return $this->model->where('id', $userId)->update([
            'is_deleted' => 1,
            'is_active' => 0,
            'deleted_at' => now()
        ]);
    }
}

