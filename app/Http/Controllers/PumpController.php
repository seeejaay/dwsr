<?php

namespace App\Http\Controllers;

use Exception;
use App\Http\Requests\PumpRequest\PumpRequest;
use App\Http\Resources\PumpResource\PumpResource;
use App\Services\PumpService\PumpServiceInterface;
use App\Repository\PumpRepository\PumpRepositoryInterface;

class PumpController extends Controller{

    protected $pumpRepository;
    protected $pumpService;

    public function __construct(PumpServiceInterface $pumpService, PumpRepositoryInterface $pumpRepository){

        $this->pumpService = $pumpService;
        $this->pumpRepository = $pumpRepository;

    }

    public function index(){
        try {
            $pumps = $this->pumpRepository->getAll();
            return response()->json([
                'message' => 'Pumps retrieved successfully',
                'data' => PumpResource::collection($pumps)
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function store (PumpRequest $request){
        try {
            $pump = $this->pumpService->createPump($request->validated());
            return response()->json([
                'message' => 'Pump created successfully',
                'data' => new PumpResource($pump)
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 500); 
        }
    }

    public function show($pump){
        try {
            $pump = $this->pumpRepository->findById($pump);
            return response()->json([
                'message' => 'Pump retrieved successfully',
                'data' => new PumpResource($pump)
            ], 200);
        } catch (Exception $e) {
            $statusCode = $e->getCode() ?: 500;
            return response()->json([
                'message' => $e->getMessage()
            ], $statusCode);
        }
    }

    public function update(PumpRequest $request, $pump){
        try {
            $pump = $this->pumpRepository->update($pump, $request->validated());
            return response()->json([
                'message' => 'Pump updated successfully',
                'data' => new PumpResource($pump)
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($pump){
        try {
            $this->pumpRepository->delete($pump);
            return response()->json([
                'message' => 'Pump deleted successfully'
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }

    
}