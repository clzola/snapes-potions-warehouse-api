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
     * @param CreateUserRequest $request
     * @param StoreProfilePictureService $service
     * @return \Illuminate\Http\JsonResponse|UserResource
     */
    public function store(CreateUserRequest $request, StoreProfilePictureService $service)
    {
        // Save profile picture if sent
        $profilePictureFileName = null;
        if ($request->hasFile('profile_picture')) {
            $profilePictureFileName = $service->store(
                $request->file("profile_picture"),
                $request->get('profile_picture_crop', null)
            );
        }

        // Create user
        $data = $request->except("profile_picture");
        $data["profile_picture"] = $profilePictureFileName;
        $user = new User($data);

        // Save user
        $user->save();

        // Respond with user
        return (new UserResource($user))
            ->response()
            ->setStatusCode(201);
    }
}
