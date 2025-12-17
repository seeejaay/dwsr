<?php

namespace App\Http\Controllers;

use Exception;
use App\Http\Requests\TankRequest\TankRequest;
use App\Http\Resources\TankResource\TankResource;
use App\Services\TankService\TankServiceInterface;
use App\Repository\TankRepository\TankRepositoryInterface;

class TankController extends Controller{

    protected $tankRepository;
    protected $tankService;

    public function __construct(TankServiceInterface $tankService, TankRepositoryInterface $tankRepository){

        $this->tankService = $tankService;
        $this->tankRepository = $tankRepository;

    }

    public function index(){
        try {
            $tanks = $this->tankRepository->getAll();
            return response()->json([
                'message' => 'Tanks retrieved successfully',
                'data' => TankResource::collection($tanks)
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function store (TankRequest $request){
        try {
            $tank = $this->tankService->createTank($request->validated());
            return response()->json([
                'message' => 'Tank created successfully',
                'data' => new TankResource($tank)
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 500); 
        }
    }

    public function show($tank){
        try {
            $tank = $this->tankRepository->findById($tank);
            return response()->json([
                'message' => 'Tank retrieved successfully',
                'data' => new TankResource($tank)
            ], 200);
        } catch (Exception $e) {
            $statusCode = $e->getCode() ?: 500;
            return response()->json([
                'message' => $e->getMessage()
            ], $statusCode);
        }
    }

    public function update(TankRequest $request, $tank){
        try {
            $tank = $this->tankRepository->update($tank, $request->validated());
            return response()->json([
                'message' => 'Tank updated successfully',
                'data' => new TankResource($tank)
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($tank){
        try {
            $this->tankRepository->delete($tank);
            return response()->json([
                'message' => 'Tank deleted successfully'
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }

    
}