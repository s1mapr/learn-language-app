<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\LoginRequest;
use App\Http\Requests\V1\RegisterRequest;
use App\Http\Resources\V1\UserResource;
use App\Services\UserService;
use App\Traits\HttpResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    use HttpResponseTrait;

    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function register(RegisterRequest $request)
    {
        $user = $this->userService->createUser($request->only('name', 'surname', 'email', 'password'));

        $token = $user->createToken('default')->plainTextToken;

        return $this->success(
            [
                'user' => new UserResource($user),
                'token' => $token
            ],
        );
    }

    public function login(LoginRequest $request)
    {
        $user = $this->userService->getUserByEmail($request['email']);
        if(!$user){
            return $this->error('', 'No user with such email', 401);
        }
        if (!Hash::check($request['password'], $user->password)) {
            return $this->error('', 'Credentials not match', 401);
        }
        $token = $user->createToken('default')->plainTextToken;
        return $this->success([
            'user' => new UserResource($user),
            'token' => $token
        ]);
    }
}
