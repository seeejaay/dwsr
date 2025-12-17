<?php

namespace App\Services\AdjustmentCategoryService;

use Exception;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Services\AdjustmentCategoryService\AdjustmentCategoryServiceInterface;
use App\Repository\AdjustmentCategoryRepository\AdjustmentCategoryRepositoryInterface;
class AdjustmentCategoryService implements AdjustmentCategoryServiceInterface
{
    protected $adjustmentCategoryRepository;
    public function __construct(AdjustmentCategoryRepositoryInterface $adjustmentCategoryRepositoryInterface)
    {
        $this->adjustmentCategoryRepository = $adjustmentCategoryRepositoryInterface;
    }
    public function createAdjustmentCategory(array $data)
    {
        DB::beginTransaction();

        try {
            if(!isset($data['id'])){
                $data['id'] =  (string) Str::uuid();
            }
            $adjustmentCategory = $this->adjustmentCategoryRepository->create($data);
            DB::commit();
            return $adjustmentCategory;
        }catch (Exception $e) {
        DB::rollBack();
        throw $e;
        }
    } 

    // public function deleteAdjustmentCategory($adjustmentCategoryId)
    // {
    //     DB::beginTransaction();

    //     try {
    //         $this->adjustmentCategoryRepository->delete($adjustmentCategoryId);
    //         DB::commit();
    //         return true;
    //     }catch (Exception $e) {
    //     DB::rollBack();
    //     throw $e;
    //     }
    // }
}