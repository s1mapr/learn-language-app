<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{

    public function createUser($user)
    {
        return User::create($user);
    }

    public function getUserByEmail($email){
        return User::where('email', $email)->first();
    }

    public function updateUser($id, $data)
    {
        $user = User::find($id);

        if (!$user) {
            return null;
        }

        $user->update($data);

        return $user;
    }

    public function getUserById($userId)
    {
        return User::find($userId);
    }

    public function getAllUsers()
    {
        return User::all();
    }

}
