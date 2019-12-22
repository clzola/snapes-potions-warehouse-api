<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateProfileRequest;
use App\Http\Resources\ProfileResource;

class ProfilesController extends Controller
{
    /**
     * @param UpdateProfileRequest $request
     * @return ProfileResource|\Illuminate\Http\JsonResponse
     */
    public function update(UpdateProfileRequest $request)
    {
        /** @var \App\User $user */
        $user = auth('api')->user();

        $user->fill($request->except(["password", "profile_picture"]))->save();

        return new ProfileResource($user);
    }
}
