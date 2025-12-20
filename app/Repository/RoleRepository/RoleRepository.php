<?php

namespace App\Repository\RoleRepository;

use App\Models\Role;
use App\Repository\BaseRepository\BaseRepository;

class RoleRepository extends BaseRepository implements RoleRepositoryInterface
{
   public function __construct(Role $model)
   {
       parent::__construct($model);
   }

    public function deleteRole($roleId)
    {
       return $this->model->where('id', $roleId)->update([
        'is_active' => 0,
        'is_deleted' => 1,
        'deleted_at' => now()
       ]);
   }
}