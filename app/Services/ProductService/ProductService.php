<?php

namespace App\Services\ProductService;

use Exception;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Services\ProductService\ProductServiceInterface;
use App\Repository\ProductRepository\ProductRepositoryInterface;
class ProductService implements ProductServiceInterface
{
    protected $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }
    public function createProduct(array $data)
    {
        DB::beginTransaction();

        try {
            if(!isset($data['id'])){
                $data['id'] =  (string) Str::uuid();
            }
            $product = $this->productRepository->create($data);
            DB::commit();
            return $product;
        }catch (Exception $e) {
        DB::rollBack();
        throw $e;
        }
    } 

    public function deleteProduct($productId)
    {
        DB::beginTransaction();

        try {
            $this->productRepository->deleteProduct($productId);
            DB::commit();
            return true;
        }catch (Exception $e) {
        DB::rollBack();
        throw $e;
        }
    }
}