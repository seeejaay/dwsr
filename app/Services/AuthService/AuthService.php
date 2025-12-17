<?php

namespace App\Services\AuthService;

use Exception;
use App\Repository\AuthRepository\AuthRepositoryInterface;
use Illuminate\Support\Facades\Hash;

class AuthService implements AuthServiceInterface
{
    protected $authRepository;

    public function __construct(AuthRepositoryInterface $authRepository)
    {
        $this->authRepository = $authRepository;
    }

   public function login(array $credentials)
    {
        if (isset($credentials['email'])) {
            $user = $this->authRepository->findByEmail($credentials['email']);
        } elseif (isset($credentials['username'])) {
            $user = $this->authRepository->findByUsername($credentials['username']);
        } else {
            throw new Exception('Email or Username is required', 400);
        }

        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            throw new Exception('Email/Username or Password may be Incorrect', 401);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return [
            'user' => $user,
            'token' => $token
        ];
    }

    public function logout($user)
    {
        $user->currentAccessToken()->delete();
        return true;
    }
}