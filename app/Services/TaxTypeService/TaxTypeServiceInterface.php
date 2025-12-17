<?php

namespace App\Services\TaxTypeService;

interface TaxTypeServiceInterface
{
    public function createTaxType(array $data);
    public function deleteTaxType($id);
}