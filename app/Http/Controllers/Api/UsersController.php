<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use App\Http\Resources\UserResource;
use App\Services\StoreProfilePictureService;
use App\User;

class UsersController extends Controller
{
    /**
     * UsersController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }


    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return UserResource::collection(User::all());
    }


    /**
     * @param CreateUserRequest $request
     * @param StoreProfilePictureService $service
     * @return \Illuminate\Http\JsonResponse|UserResource
     */
    public function store(CreateUserRequest $request, StoreProfilePictureService $service)
    {
        // Prepare attributes
        $attributes = $request->except("profile_picture");
        $attributes["profile_picture"] = $this->storeProfilePicture($request, $service);

        // Create & save user
        $user = User::create($attributes);

        // Respond with user
        return (new UserResource($user))
            ->response()
            ->setStatusCode(201);
    }


    private function storeProfilePicture(CreateUserRequest $request, StoreProfilePictureService $service)
    {
        if (!$request->hasFile('profile_picture'))
            return null;

        return $service->store(
            $request->file("profile_picture"),
            $request->get('profile_picture_crop', null)
        );
    }
}
