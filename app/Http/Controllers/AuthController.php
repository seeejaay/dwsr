<?php

namespace App\Http\Controllers;

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
                'data' => new UserResource($result['user']),
                'token' => $result['token']
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
