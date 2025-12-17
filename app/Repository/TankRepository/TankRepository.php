<?php

namespace App\Repository\TankRepository;

use App\Repository\BaseRepository\BaseRepository;
use App\Repository\TankRepository\TankRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class TankRepository extends BaseRepository implements TankRepositoryInterface
{
    protected $model;

    public function __construct(Model $model)
    {
        parent::__construct($model);
    }
    public function deleteTank($tankId)
    {
        return $this->model->where('id', $tankId)->update([
            'is_deleted' => 1,
            'is_active' => 0,
            'deleted_at' => now(),
        ]);
    }
}