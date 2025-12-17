<?php

namespace App\Http\Controllers;

use Exception;
use App\Http\Requests\AdjustmentCategoryRequest\AdjustmentCategoryRequest;
use App\Http\Resources\AdjustmentCategoryResource\AdjustmentCategoryResource;
use App\Services\AdjustmentCategoryService\AdjustmentCategoryServiceInterface;
use App\Repository\AdjustmentCategoryRepository\AdjustmentCategoryRepositoryInterface;

class AdjustmentCategoryController extends Controller{

    protected $adjustmentCategoryRepository;
    protected $adjustmentCategoryService;

    public function __construct(AdjustmentCategoryServiceInterface $adjustmentCategoryService, AdjustmentCategoryRepositoryInterface $adjustmentCategoryRepository){

        $this->adjustmentCategoryService = $adjustmentCategoryService;
        $this->adjustmentCategoryRepository = $adjustmentCategoryRepository;

    }

    public function index(){
        try {
            $adjustmentCategories = $this->adjustmentCategoryRepository->getAll();
            return response()->json([
                'message' => 'Adjustment Categories retrieved successfully',
                'data' => AdjustmentCategoryResource::collection($adjustmentCategories)
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function store (AdjustmentCategoryRequest $request){
        try {
            $adjustmentCategory = $this->adjustmentCategoryService->createAdjustmentCategory($request->validated());
            return response()->json([
                'message' => 'Adjustment Category created successfully',
                'data' => new AdjustmentCategoryResource($adjustmentCategory)
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 500); 
        }
    }

    public function show($adjustmentCategory){
        try {
            $adjustmentCategory = $this->adjustmentCategoryRepository->findById($adjustmentCategory);
            return response()->json([
                'message' => 'Adjustment Category retrieved successfully',
                'data' => new AdjustmentCategoryResource($adjustmentCategory)
            ], 200);
        } catch (Exception $e) {
            $statusCode = $e->getCode() ?: 500;
            return response()->json([
                'message' => $e->getMessage()
            ], $statusCode);
        }
    }

    public function update(AdjustmentCategoryRequest $request, $adjustmentCategory){
        try {
            $adjustmentCategory = $this->adjustmentCategoryRepository->update($adjustmentCategory, $request->validated());
            return response()->json([
                'message' => 'Adjustment Category updated successfully',
                'data' => new AdjustmentCategoryResource($adjustmentCategory)
            ], 200);
        } catch (Exception $e) {
            $statusCode = $e->getCode() ?: 500;
            return response()->json([
                'message' => $e->getMessage()
            ], $statusCode);
        }
    }

    public function destroy($adjustmentCategory){
        try {
            $this->adjustmentCategoryRepository->delete($adjustmentCategory);
            return response()->json([
                'message' => 'Adjustment Category deleted successfully'
            ], 200);
        } catch (Exception $e) {
            $statusCode = $e->getCode() ?: 500;
            return response()->json([
                'message' => $e->getMessage()
            ], $statusCode);
        }
    }
}