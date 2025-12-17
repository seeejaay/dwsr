<?php

namespace App\Services\VarianceService;

interface VarianceServiceInterface
{

    public function createVariance(array $data);

    public function deleteVariance($varianceId);
}