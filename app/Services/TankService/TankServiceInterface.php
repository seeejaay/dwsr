<?php

namespace App\Services\TankService;

interface TankServiceInterface
{
    public function createTank(array $data);
    public function deleteTank($tankId);
}