<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AuthRequest\AuthRequest;
use App\Services\AuthService\AuthServiceInterface;
use App\Http\Resources\UserResource\UserResource;

class AuthController extends Controller
{
    //
    protected $authService;

    public function __construct(AuthServiceInterface $authService)
    {
        $this->authService = $authService;
    }


    public function login(AuthRequest $request){
        try {
            $result = $this->authService->login($request->validated());
            return response()->json([
                'message' => 'Login Successful',
                'user' => new UserResource($result['user']),
                'token' => $result['token']
            ], 200);
        } catch (\Exception $e) {
              $statusCode = $e->getCode() ?: 500;
            return response()->json([
                'message' => $e->getMessage()
            ], $statusCode);
        }
    }
}
