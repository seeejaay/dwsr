<?php

namespace App\Repository\TaxTypeRepository;

use App\Repository\BaseRepository\BaseRepositoryInterface;

interface TaxTypeRepositoryInterface extends BaseRepositoryInterface
{
    public function deleteTaxType($id);
}