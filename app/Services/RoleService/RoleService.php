<?php

namespace App\Services\RoleService;

use Exception;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Services\RoleService\RoleServiceInterface;
use App\Repository\RoleRepository\RoleRepositoryInterface;
class RoleService implements RoleServiceInterface
{
    protected $roleRepository;

    public function __construct(RoleRepositoryInterface $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }
    public function createRole(array $data)
    {
        DB::beginTransaction();

        try {
            if(!isset($data['id'])){
                $data['id'] =  (string) Str::uuid();
            }
            $role = $this->roleRepository->create($data);
            DB::commit();
            return $role;
        }catch (Exception $e) {
        DB::rollBack();
        throw $e;
        }
    } 

    public function deleteRole($roleId)
    {
        DB::beginTransaction();

        try {
            $this->roleRepository->deleteRole($roleId);
            DB::commit();
            return true;
        }catch (Exception $e) {
        DB::rollBack();
        throw $e;
        }
    }
}