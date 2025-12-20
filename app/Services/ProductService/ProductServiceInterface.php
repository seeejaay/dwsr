<?php

namespace App\Services\ProductService;

interface ProductServiceInterface
{

    public function createProduct(array $data);

    public function deleteProduct($productId);
}