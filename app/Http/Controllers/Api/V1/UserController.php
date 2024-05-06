<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\UserResource;
use App\Http\Resources\V1\WordCollectionResource;
use App\Services\UserService;
use App\Services\UserWordCollectionService;
use App\Traits\HttpResponseTrait;
use Illuminate\Http\Request;

class UserController extends Controller
{
    use HttpResponseTrait;

    private UserService $userService;
    private UserWordCollectionService $userWordCollectionService;

    public function __construct(UserService $userService, UserWordCollectionService $userWordCollectionService)
    {
        $this->userService = $userService;
        $this->userWordCollectionService = $userWordCollectionService;
    }

    public function index(){
        $user = $this->userService->getAllUsers();
        return UserResource::collection($user);
    }

    public function update($id, Request $request)
    {
        $data = $request->all();
        $user = $this->userService->updateUser($id, $data);
        return $this->success(new UserResource($user));
    }

    public function startCollection($userId, $collectionId){
        $this->userWordCollectionService->startCollection($userId, $collectionId);
        return $this->success('', "collection successfully started");
    }

    public function userCollections($userId)
    {
        $user = $this->userService->getUserById($userId);
        return $user->wordCollections;
    }


}
