<?php


namespace App\Http\Controllers;

use Exception;
use App\Http\Requests\TaxTypeRequest\TaxTypeRequest;
use App\Http\Resources\TaxTypeResource\TaxTypeResource;
use App\Services\TaxTypeService\TaxTypeServiceInterface;
use App\Repository\TaxTypeRepository\TaxTypeRepositoryInterface;

class TaxTypeController extends Controller{

    protected $taxTypeRepository;
    protected $taxTypeService;

    public function __construct(TaxTypeServiceInterface $taxTypeService, TaxTypeRepositoryInterface $taxTypeRepository){

        $this->taxTypeService = $taxTypeService;
        $this->taxTypeRepository = $taxTypeRepository;

    }

    public function index(){
        try {
            $taxTypes = $this->taxTypeRepository->getAll();
            return response()->json([
                'message' => 'Tax Types retrieved successfully',
                'data' => TaxTypeResource::collection($taxTypes)
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }
    public function store (TaxTypeRequest $request){
        try {
            $taxType = $this->taxTypeService->createTaxType($request->validated());
            return response()->json([
                'message' => 'Tax Type created successfully',
                'data' => new TaxTypeResource($taxType)
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 500); 
        }
    }
    public function show($taxType){
        try {
            $taxType = $this->taxTypeRepository->findById($taxType);
            return response()->json([
                'message' => 'Tax Type retrieved successfully',
                'data' => new TaxTypeResource($taxType)
            ], 200);
        } catch (Exception $e) {
            $statusCode = $e->getCode() ?: 500;
            return response()->json([
                'message' => $e->getMessage()
            ], $statusCode);
        }
    }

    public function update(TaxTypeRequest $request, $taxType){
        try {
            $taxType = $this->taxTypeRepository->update($taxType, $request->validated());
            return response()->json([
                'message' => 'Tax Type updated successfully',
                'data' => new TaxTypeResource($taxType)
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($taxType){
        try {
            $this->taxTypeService->deleteTaxType($taxType);
            return response()->json([
                'message' => 'Tax Type deleted successfully'
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }

}

