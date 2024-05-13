<?php

namespace App\Services;

use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;

class UserService
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function createUser($user)
    {
        return $this->userRepository->createUser($user);
    }


    public function getUserByEmail($email){
        return $this->userRepository->getUserByEmail($email);
    }

    public function updateUser($id, $user){
        return $this->userRepository->updateUser($id, $user);
    }

    public function getUserById($userId)
    {
        return $this->userRepository->getUserById($userId);
    }

    public function getAllUsers($searchQuery)
    {
        return $this->userRepository->getAllUsers($searchQuery);
    }

    public function blockOrUnblockUser($id)
    {
        return $this->userRepository->blockOrUnblockUser($id);
    }
}
