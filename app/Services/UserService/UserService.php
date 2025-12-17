<?php

namespace App\Services\UserService;

use Exception;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Services\UserService\UserServiceInterface;
use App\Repository\UserRepository\UserRepositoryInterface;

class UserService implements UserServiceInterface {

    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository) {
        $this->userRepository = $userRepository;
    }

    public function createUser(array $data){
        DB::beginTransaction();

        try {
            $data['password'] = Hash::make($data['password']);

            if(!isset($data['id'])){
                $data['id'] =  (string) Str::uuid();
            }

            if(!isset($data['role_id'])){
                $data['role_id'] = 'aec0b8c0-e3e8-4980-b21b-fee141f3cf3b'; 
            }

            $user = $this->userRepository->create($data);
            DB::commit();
            return $user;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function updateUser($userId, array $data){
        DB::beginTransaction();

        try {
            if (isset($data['password'])){
                $data['password'] = Hash::make($data['password']);
            }

            $user = $this->userRepository->update($userId, $data);
            DB::commit();

            return $user;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function deleteUser($userId){
        DB::beginTransaction();

        try {
            $this->userRepository->deleteUser($userId);
            DB::commit();
            return true;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function getUserProfile($userId){
        return $this->userRepository->findById($userId);
    }


}