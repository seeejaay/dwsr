<?php

namespace App\Http\Controllers;

use Exception;
use App\Http\Requests\RoleRequest\RoleRequest;
use App\Http\Resources\RoleResource\RoleResource;
use App\Services\RoleService\RoleServiceInterface;
use App\Repository\RoleRepository\RoleRepositoryInterface;

class RoleController extends Controller{

    protected $roleRepository;
    protected $roleService;

    public function __construct(RoleServiceInterface $roleService, RoleRepositoryInterface $roleRepository){

        $this->roleService = $roleService;
        $this->roleRepository = $roleRepository;

    }

    public function index(){
        try {
            $roles = $this->roleRepository->getAll();
            return response()->json([
                'message' => 'Roles retrieved successfully',
                'data' => RoleResource::collection($roles)
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function store (RoleRequest $request){
        try {
            $role = $this->roleService->createRole($request->validated());
            return response()->json([
                'message' => 'Role created successfully',
                'data' => new RoleResource($role)
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 500); 
        }
    }

    public function show($role){
        try {
            $role = $this->roleRepository->findById($role);
            return response()->json([
                'message' => 'Role retrieved successfully',
                'data' => new RoleResource($role)
            ], 200);
        } catch (Exception $e) {
            $statusCode = $e->getCode() ?: 500;
            return response()->json([
                'message' => $e->getMessage()
            ], $statusCode);
        }
    }

    public function update(RoleRequest $request, $role){
        try {
            $role = $this->roleRepository->update($role, $request->validated());
            return response()->json([
                'message' => 'Role updated successfully',
                'data' => new RoleResource($role)
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($role){
        try {
            $this->roleService->deleteRole($role);
            return response()->json([
                'message' => 'Role deleted successfully'
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }

    
}