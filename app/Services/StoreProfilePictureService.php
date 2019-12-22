<?php

namespace App\Services;

use Intervention\Image\Constraint;
use Intervention\Image\Facades\Image;

class StoreProfilePictureService
{
    /**
     * @param \Illuminate\Http\UploadedFile|\Illuminate\Http\UploadedFile[] $uploadedFile
     * @param null $cropParameters
     * @return string
     */
    public function store($uploadedFile, $cropParameters = null)
    {
        $path = $uploadedFile->store('public/users/profile_pictures');

        $image = Image::make(storage_path("app/$path"));

        if(!is_null($cropParameters))
            $image->crop($cropParameters["width"], $cropParameters["height"], $cropParameters["x"], $cropParameters["y"]);

        $image->fit(512, 512, function (Constraint $constraints) {
            $constraints->upsize();
            $constraints->aspectRatio();
        });

        $image->save();

        return $image->basename;
    }
}