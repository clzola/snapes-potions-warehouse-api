<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreatePotionRequest;
use App\Http\Requests\UpdatePotionRequest;
use App\Http\Resources\PotionResource;
use App\Potion;
use App\Services\StorePotionPictureService;
use Illuminate\Http\UploadedFile;

class PotionsController extends Controller
{
    /**
     * PotionsController constructor.
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
        return PotionResource::collection(
            Potion::with(['potionCategory', 'potionDifficultyLevel'])
                ->orderBy('name')
                ->paginate()
        );
    }


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
     * @throws \Exception
     * @throws \Throwable
     */
    public function update(Potion $potion, UpdatePotionRequest $request, StorePotionPictureService $service)
    {
        $potion->fill($request->all());

        $oldPictureFileName = $this->replacePotionPicture(
            $potion,
            $request->file('picture'),
            $request->get('picture_crop'),
            $service
        );

        \DB::transaction(function () use ($potion, $oldPictureFileName) {
            $potion->save();
            if (isset($oldPictureFileName))
                \Storage::delete("public/potions/pictures/$oldPictureFileName");
        });

        $potion->load(['potionCategory', 'potionDifficultyLevel']);

        return new PotionResource($potion);
    }


    /**
     * @param Potion $potion
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Potion $potion)
    {
        $potion->delete();

        return response()->noContent();
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

        $potion->picture = basename($pictureFileName);
    }


    /**
     * @param Potion $potion
     * @param UploadedFile $uploadedFile
     * @param array $cropParameters
     * @param StorePotionPictureService $service
     * @return null|string
     */
    protected function replacePotionPicture(Potion $potion, UploadedFile $uploadedFile, array $cropParameters, StorePotionPictureService $service)
    {
        if (is_null($uploadedFile))
            return null;

        $oldPictureFileName = $potion->picture;
        $this->storePotionPicture(
            $potion,
            $uploadedFile,
            $cropParameters,
            $service
        );

        return $oldPictureFileName;
    }
}
