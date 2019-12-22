<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateIngredientRequest;
use App\Http\Requests\UpdateIngredientPictureRequest;
use App\Http\Requests\UpdateIngredientRequest;
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

        $ingredient = new Ingredient($request->all());
        $ingredient->picture = basename($pictureFileName);
        $ingredient->save();

        return new IngredientResource($ingredient);
    }


    /**
     * @param Ingredient $ingredient
     * @return IngredientResource
     */
    public function show(Ingredient $ingredient)
    {
        return new IngredientResource($ingredient);
    }


    /**
     * @param Ingredient $ingredient
     * @param UpdateIngredientRequest $request
     * @return IngredientResource
     */
    public function update(Ingredient $ingredient, UpdateIngredientRequest $request)
    {
        $ingredient->fill($request->all())->save();

        return new IngredientResource($ingredient);
    }


    /**
     * @param Ingredient $ingredient
     * @param UpdateIngredientPictureRequest $request
     * @param StoreIngredientPictureService $service
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     * @throws \Throwable
     */
    public function updatePicture(Ingredient $ingredient, UpdateIngredientPictureRequest $request, StoreIngredientPictureService $service)
    {
        $pictureFileName = $service->store(
            $request->file("picture"),
            $request->get('picture_crop', null)
        );

        \DB::transaction(function () use ($ingredient, $pictureFileName) {
            $oldPictureFilename = $ingredient->picture;
            $ingredient->picture = $pictureFileName;
            $ingredient->save();
            \Storage::delete("public/ingredients/pictures/$oldPictureFilename");
        });

        return response()->json([
            "picture_url" => url("storage/ingredients/pictures/{$ingredient->picture}")
        ]);
    }


    /**
     * @param Ingredient $ingredient
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Ingredient $ingredient)
    {
        $ingredient->delete();

        return response()->noContent();
    }
}
