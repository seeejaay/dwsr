<?php

namespace App\Services\VarianceService;

use Exception;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Services\VarianceService\VarianceServiceInterface;
use App\Repository\VarianceRepository\VarianceRepositoryInterface;
class VarianceService implements VarianceServiceInterface
{
    protected $varianceRepository;
    public function __construct(VarianceRepositoryInterface $varianceRepositoryInterface)
    {
        $this->varianceRepository = $varianceRepositoryInterface;
    }
    public function createVariance(array $data)
    {
        DB::beginTransaction();

        try {
            if(!isset($data['id'])){
                $data['id'] =  (string) Str::uuid();
            }
            $variance = $this->varianceRepository->create($data);
            DB::commit();
            return $variance;
        }catch (Exception $e) {
        DB::rollBack();
        throw $e;
        }
    } 

    public function deleteVariance($varianceId)
    {
        DB::beginTransaction();

        try {
            $this->varianceRepository->deleteVariance($varianceId);
            DB::commit();
            return true;
        }catch (Exception $e) {
        DB::rollBack();
        throw $e;
        }
    }
}