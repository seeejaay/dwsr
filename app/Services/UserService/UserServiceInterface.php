<?php

namespace App\Services\UserService;


interface UserServiceInterface
{
    public function createUser(array $data);
    public function updateUser($userId,array $data);
    public function deleteUser($userId);
    public function getUserProfile($userId);
    // public function getAllUsers();
    // public function getUserById($userId);

}