<?php

namespace App\Services\TaxTypeService;

use Exception;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Services\TaxTypeService\TaxTypeServiceInterface;
use App\Repository\TaxTypeRepository\TaxTypeRepositoryInterface;

class TaxTypeService implements TaxTypeServiceInterface
{
    protected $taxTypeRepository;

    public function __construct(TaxTypeRepositoryInterface $taxTypeRepository)
    {
        $this->taxTypeRepository = $taxTypeRepository;
    }

    public function createTaxType(array $data)
    {
        DB::beginTransaction();

        try {
            if(!isset($data['id'])){
                $data['id'] =  (string) Str::uuid();
            }
            $taxType = $this->taxTypeRepository->create($data);
            DB::commit();
            return $taxType;
        }catch (Exception $e) {
        DB::rollBack();
        throw $e;
        }
    }

    public function deleteTaxType($id)
    {
        DB::beginTransaction();

        try {
            $this->taxTypeRepository->deleteTaxType($id);
            DB::commit();
            return true;
        }catch (Exception $e) {
        DB::rollBack();
        throw $e;
        }
    }
}