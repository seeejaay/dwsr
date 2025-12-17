<?php

namespace App\Http\Controllers;

use Exception;
use App\Http\Requests\VarianceRequest\VarianceRequest;
use App\Http\Resources\VarianceResource\VarianceResource;
use App\Services\VarianceService\VarianceServiceInterface;
use App\Repository\VarianceRepository\VarianceRepositoryInterface;

class VarianceController extends Controller
{
    protected $varianceService;
    protected $varianceRepository;

    public function __construct(
        VarianceServiceInterface $varianceService,
        VarianceRepositoryInterface $varianceRepository
    ) {
        $this->varianceService = $varianceService;
        $this->varianceRepository = $varianceRepository;
    }

    public function index()
    {
        try {
            $variances = $this->varianceRepository->getAll();
            return response()->json([
                'message' => 'Variances retrieved successfully',
                'data' => VarianceResource::collection($variances)
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function store(VarianceRequest $request)
    {
        try {
            $variance = $this->varianceService->createVariance($request->validated());
            return response()->json([
                'message' => 'Variance created successfully',
                'data' => new VarianceResource($variance)
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function show($variance){
        try {
            $variance = $this->varianceRepository->findById($variance);
            return response()->json([
                'message' => 'Variance retrieved successfully',
                'data' => new VarianceResource($variance)
            ], 200);
        } catch (Exception $e) {
            $statusCode = $e->getCode() ?: 500;
            return response()->json([
                'message' => $e->getMessage()
            ], $statusCode);
        }
    }

    public function update(VarianceRequest $request, $variance)
    {
        try {
            $variance = $this->varianceRepository->update($variance, $request->validated());
            return response()->json([
                'message' => 'Variance updated successfully',
                'data' => new VarianceResource($variance)
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }
    public function destroy($variance)
    {
        try {
            $this->varianceService->deleteVariance($variance);
            return response()->json([
                'message' => 'Variance deleted successfully'
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }
}