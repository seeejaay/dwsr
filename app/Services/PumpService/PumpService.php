<?php

namespace App\Services\PumpService;

use Exception;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Services\PumpService\PumpServiceInterface;
use App\Repository\PumpRepository\PumpRepositoryInterface;
class PumpService implements PumpServiceInterface
{
    protected $pumpRepository;

    public function __construct(PumpRepositoryInterface $pumpRepository)
    {
        $this->pumpRepository = $pumpRepository;
    }
    public function createPump(array $data)
    {
        DB::beginTransaction();

        try {
            if(!isset($data['id'])){
                $data['id'] =  (string) Str::uuid();
            }
            $pump = $this->pumpRepository->create($data);
            DB::commit();
            return $pump;
        }catch (Exception $e) {
        DB::rollBack();
        throw $e;
        }
    } 

    public function deletePump($pumpId)
    {
        DB::beginTransaction();

        try {
            $this->pumpRepository->deletePump($pumpId);
            DB::commit();
            return true;
        }catch (Exception $e) {
        DB::rollBack();
        throw $e;
        }
    }
}