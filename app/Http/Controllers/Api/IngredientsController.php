<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateIngredientRequest;
use App\Http\Resources\IngredientResource;
use App\Ingredient;
use App\Services\StoreIngredientPictureService;

class IngredientsController extends Controller
{
    /**
     * @param CreateIngredientRequest $request
     * @param StoreIngredientPictureService $service
     * @return IngredientResource
     */
    public function store(CreateIngredientRequest $request, StoreIngredientPictureService $service)
    {
        $pictureFileName = $service->store(
            $request->file("picture"),
            $request->get('picture_crop', null)
        );

        $data = $request->all();
        $data['picture'] = basename($pictureFileName);
        $ingredient = Ingredient::create($data);

        return new IngredientResource($ingredient);
    }
}
