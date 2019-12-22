<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateProfilePasswordRequest;
use App\Http\Requests\UpdateProfilePictureRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Http\Resources\ProfileResource;
use App\Services\StoreProfilePictureService;

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

        if (!\Hash::check($request->get('old_password'), $user->password)) {
            throw new \Exception("Incorrect old password.");
        }

        $user->password = $request->get('new_password');
        $user->save();

        return response()->noContent();
    }


    /**
     * @param UpdateProfilePictureRequest $request
     * @param StoreProfilePictureService $service
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     * @throws \Throwable
     */
    public function updateProfilePicture(UpdateProfilePictureRequest $request, StoreProfilePictureService $service)
    {
        /** @var \App\User $user */
        $profilePictureFileName = $service->store(
            $request->file("profile_picture"),
            $request->get('profile_picture_crop', null)
        );

        $user = auth('api')->user();

        \DB::transaction(function() use ($user, $profilePictureFileName) {
            $oldProfilePictureFilename = $user->profile_picture;
            $user->profile_picture = $profilePictureFileName;
            $user->save();
            \Storage::delete("public/users/profile_pictures/$oldProfilePictureFilename");
        });

        return response()->json([
            "profile_picture_url" => url("storage/users/profile_pictures/{$user->profile_picture}")
        ]);
    }
}
