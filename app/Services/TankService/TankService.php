<?php

namespace App\Services\TankService;


use Exception;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Services\TankService\TankServiceInterface;
use App\Repository\TankRepository\TankRepositoryInterface;


class TankService implements TankServiceInterface
{
    protected $tankRepository;

    public function __construct(TankRepositoryInterface $tankRepository)
    {
        $this->tankRepository = $tankRepository;
    }

    public function createTank(array $data)
    {
        DB::beginTransaction();

        try {
            if(!isset($data['id'])){
                $data['id'] =  (string) Str::uuid();
            }
            $tank = $this->tankRepository->create($data);
            DB::commit();
            return $tank;
        }catch (Exception $e) {
        DB::rollBack();
        throw $e;
        }
    }

    public function deleteTank($tankId)
    {
        DB::beginTransaction();

        try {
            $this->tankRepository->deleteTank($tankId);
            DB::commit();
            return true;
        }catch (Exception $e) {
        DB::rollBack();
        throw $e;
        }
    }
}