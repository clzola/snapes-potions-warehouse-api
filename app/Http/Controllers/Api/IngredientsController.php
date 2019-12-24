<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateIngredientRequest;
use App\Http\Requests\UpdateIngredientPictureRequest;
use App\Http\Requests\UpdateIngredientRequest;
use App\Http\Resources\IngredientResource;
use App\Ingredient;
use App\Services\StoreIngredientPictureService;
use Illuminate\Http\UploadedFile;

class IngredientsController extends Controller
{
    /**
     * IngredientsController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }


    /**
     * @param CreateIngredientRequest $request
     * @param StoreIngredientPictureService $service
     * @return IngredientResource
     */
    public function store(CreateIngredientRequest $request, StoreIngredientPictureService $service)
    {
        $ingredient = new Ingredient($request->all());

        $this->storeIngredientPicture(
            $ingredient,
            $request->file("picture"),
            $request->get('picture_crop', null),
            $service
        );


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
     * @param StoreIngredientPictureService $service
     * @return IngredientResource
     * @throws \Exception
     * @throws \Throwable
     */
    public function update(Ingredient $ingredient, UpdateIngredientRequest $request, StoreIngredientPictureService $service)
    {
        $ingredient->fill($request->all());

        $oldPictureFileName = $this->replaceIngredientPicture(
            $ingredient,
            $request->file("picture"),
            $request->get('picture_crop', null),
            $service
        );

        \DB::transaction(function () use ($ingredient, $oldPictureFileName) {
            $ingredient->save();
            if (isset($oldPictureFileName))
                \Storage::delete("public/ingredients/pictures/$oldPictureFileName");
        });

        return new IngredientResource($ingredient);
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


    /**
     * @param Ingredient $ingredient
     * @param UploadedFile $uploadedFile
     * @param array $cropParameters
     * @param StoreIngredientPictureService $service
     */
    protected function storeIngredientPicture(Ingredient $ingredient, UploadedFile $uploadedFile, array $cropParameters, StoreIngredientPictureService $service)
    {
        $pictureFileName = $service->store(
            $uploadedFile,
            $cropParameters
        );

        $ingredient->picture = basename($pictureFileName);
    }


    /**
     * @param Ingredient $ingredient
     * @param UploadedFile $uploadedFile
     * @param array $cropParameters
     * @param StoreIngredientPictureService $service
     * @return null|string
     */
    protected function replaceIngredientPicture(Ingredient $ingredient, UploadedFile $uploadedFile, array $cropParameters, StoreIngredientPictureService $service)
    {
        if (is_null($uploadedFile))
            return null;

        $oldPictureFileName = $ingredient->picture;
        $this->storeIngredientPicture(
            $ingredient,
            $uploadedFile,
            $cropParameters,
            $service
        );

        return $oldPictureFileName;
    }
}
