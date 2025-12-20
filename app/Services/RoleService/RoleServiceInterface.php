<?php

namespace App\Services\RoleService;

interface RoleServiceInterface
{

    public function createRole(array $data);

    public function deleteRole($roleId);
}