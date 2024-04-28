<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\UserResource;
use App\Services\UserService;
use App\Traits\HttpResponseTrait;
use Illuminate\Http\Request;

class UserController extends Controller
{
    use HttpResponseTrait;

    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function update($id, Request $request)
    {
        $data = $request->all();
        $user = $this->userService->updateUser($id, $data);
        return $this->success(new UserResource($user));
    }
}
