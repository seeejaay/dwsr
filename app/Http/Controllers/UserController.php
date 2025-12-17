<?php 

namespace App\Http\Controllers;

use Exception;
use App\Http\Requests\UserRequest\UserRequest;
use App\Http\Resources\UserResource\UserResource;
use App\Services\UserService\UserServiceInterface;
use App\Repository\UserRepository\UserRepositoryInterface;

class UserController extends Controller {
    protected $userService;
    protected $userRepository;

    public function __construct(UserServiceInterface $userService, UserRepositoryInterface $userRepository) {
        $this->userService = $userService;
        $this->userRepository = $userRepository;
    }

    public function index(){
        try {
            $users = $this->userRepository->getAll();
            return response()->json([
                'message' => 'Users retrieved successfully',
                'data' => UserResource::collection($users)
            ], 200);
        } catch (Exception $e) {
            $statusCode = $e->getCode() ?: 500;
            return response()->json([
                'message' => $e->getMessage()
            ], $statusCode);
        }
    }

    public function store(UserRequest $request){
        try {
            $user = $this->userService->createUser($request->validated());
            return response()->json([
                'message' => 'User created successfully',
                'data' => new UserResource($user)
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 500); // Use a valid HTTP status code
        }
    }

    public function show($user){
        try {
            $user = $this->userRepository->findById($user);
            return response()->json([
                'message' => 'User retrieved successfully',
                'data' => new UserResource($user)
            ], 200);
        } catch (Exception $e) {
            $statusCode = $e->getCode() ?: 500;
            return response()->json([
                'message' => $e->getMessage()
            ], $statusCode);
        }
    }

    public function update(UserRequest $request, $user){
        try {
            $user = $this->userService->updateUser($user, $request->validated());
            return response()->json([
                'message' => 'User updated successfully',
                'data' => new UserResource($user)
            ], 200);
        } catch (Exception $e) {
            $statusCode = $e->getCode() ?: 500;
            return response()->json([
                'message' => $e->getMessage()
            ], $statusCode);
        }
    }

    public function destroy($user){
        try {
            $this->userService->deleteUser($user);
            return response()->json([
                'message' => 'User deleted successfully'
            ], 200);
        } catch (Exception $e) {
            $statusCode = $e->getCode() ?: 500;
            return response()->json([
                'message' => $e->getMessage()
            ], $statusCode);
        }
    }

    public function profile($user){
        try {
            $user = $this->userService->getUserProfile($user);
            return response()->json([
                'message' => 'User profile retrieved successfully',
                'data' => new UserResource($user)
            ], 200);
        } catch (Exception $e) {
            $statusCode = $e->getCode() ?: 500;
            return response()->json([
                'message' => $e->getMessage()
            ], $statusCode);
        }
    }
}