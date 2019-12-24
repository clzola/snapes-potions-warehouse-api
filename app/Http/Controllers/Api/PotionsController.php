<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreatePotionRequest;
use App\Http\Resources\PotionResource;
use App\Potion;
use App\Services\StorePotionPictureService;
use Illuminate\Http\Request;

class PotionsController extends Controller
{
    /**
     * @param CreatePotionRequest $request
     * @param StorePotionPictureService $service
     * @return PotionResource
     */
    public function store(CreatePotionRequest $request, StorePotionPictureService $service)
    {
        $picturePath = $service->store(
            $request->file('picture'),
            $request->get('picture_crop', null)
        );

        $potion = new Potion($request->all());
        $potion->picture = basename($picturePath);
        $potion->bottles = $request->get('bottles', 0);
        $potion->save();

        $potion->load(['potionCategory', 'potionDifficultyLevel']);

        return new PotionResource($potion);
    }
}
