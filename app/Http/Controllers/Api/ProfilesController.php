<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateProfilePasswordRequest;
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


    /**
     * @param UpdateProfilePasswordRequest $request
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function updatePassword(UpdateProfilePasswordRequest $request)
    {
        /** @var \App\User $user */
        $user = auth('api')->user();

        if(!\Hash::check($request->get('old_password'), $user->password)) {
            throw new \Exception("Incorrect old password.");
        }

        $user->password = $request->get('new_password');
        $user->save();

        return response()->noContent();
    }
}
