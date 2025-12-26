<?php

namespace App\Repository\UserRepository;

use App\Models\User;
use Illuminate\Support\Facades\DB;
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

   public function getAllForExport($startDate = null, $endDate = null)
    {
        if ($startDate && $endDate) {
            return DB::select('SELECT * FROM get_users(?, ?)', [$startDate, $endDate]);
        } else {
            return DB::select('SELECT * FROM get_users()');
        }
    }
}

