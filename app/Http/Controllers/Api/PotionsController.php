<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreatePotionRequest;
use App\Http\Requests\UpdatePotionRequest;
use App\Http\Resources\PotionResource;
use App\Potion;
use App\Services\StorePotionPictureService;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

class PotionsController extends Controller
{
    /**
     * @param CreatePotionRequest $request
     * @param StorePotionPictureService $service
     * @return PotionResource
     */
    public function store(CreatePotionRequest $request, StorePotionPictureService $service)
    {
        $potion = new Potion($request->all());
        $potion->bottles = $request->get('bottles', 0);

        $this->storePotionPicture(
            $potion,
            $request->file('picture'),
            $request->get('picture_crop'),
            $service
        );

        $potion->save();

        $potion->load(['potionCategory', 'potionDifficultyLevel']);

        return new PotionResource($potion);
    }


    /**
     * @param Potion $potion
     * @return PotionResource
     */
    public function show(Potion $potion)
    {
        $potion->load(['potionCategory', 'potionDifficultyLevel']);

        return new PotionResource($potion);
    }


    /**
     * @param Potion $potion
     * @param UpdatePotionRequest $request
     * @param StorePotionPictureService $service
     * @return PotionResource
     */
    public function update(Potion $potion, UpdatePotionRequest $request, StorePotionPictureService $service)
    {
        $potion->fill($request->all());

        if ($request->has('picture')) {
            $oldPictureFileName = $potion->picture;

            $this->storePotionPicture(
                $potion,
                $request->file('picture'),
                $request->get('picture_crop'),
                $service
            );
        }

        $potion->save();

        try {
            if (isset($oldPictureFileName))
                \Storage::delete("public/potions/pictures/$oldPictureFileName");
        } catch (\Exception $e) {}

        $potion->load(['potionCategory', 'potionDifficultyLevel']);

        return new PotionResource($potion);
    }


    /**
     * @param Potion $potion
     * @param UploadedFile $uploadedFile
     * @param array $cropParameters
     * @param StorePotionPictureService $service
     */
    protected function storePotionPicture(Potion $potion, UploadedFile $uploadedFile, array $cropParameters, StorePotionPictureService $service)
    {
        $pictureFileName = $service->store(
            $uploadedFile,
            $cropParameters
        );

        $potion->picture = $pictureFileName;
    }
}
