<?php

namespace App\Http\Controllers;

use Exception;
use App\Http\Requests\ProductRequest\ProductRequest;
use App\Http\Resources\ProductResource\ProductResource;
use App\Services\ProductService\ProductServiceInterface;
use App\Repository\ProductRepository\ProductRepositoryInterface;


class ProductController extends Controller{

    protected $productRepository;
    protected $productService;

    public function __construct(ProductServiceInterface $productService, ProductRepositoryInterface $productRepository){

        $this->productService = $productService;
        $this->productRepository = $productRepository;

    }

    public function index(){
        try {
            $products = $this->productRepository->getAll();
            return response()->json([
                'message' => 'Products retrieved successfully',
                'data' => ProductResource::collection($products)
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function store (ProductRequest $request){
        try {
            $product = $this->productService->createProduct($request->validated());
            return response()->json([
                'message' => 'Product created successfully',
                'data' => new ProductResource($product)
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 500); 
        }
    }

    public function show($product){
        try {
            $product = $this->productRepository->findById($product);
            return response()->json([
                'message' => 'Product retrieved successfully',
                'data' => new ProductResource($product)
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function update(ProductRequest $request, $product){
        try {
            $product = $this->productRepository->update($product, $request->validated());
            return response()->json([
                'message' => 'Product updated successfully',
                'data' => new ProductResource($product)
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($product){
        try {
            $this->productService->deleteProduct($product);
            return response()->json([
                'message' => 'Product deleted successfully'
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }

}