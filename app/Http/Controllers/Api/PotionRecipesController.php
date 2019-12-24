<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreatePotionRecipeRequest;
use App\Http\Requests\UpdatePotionRecipeRequest;
use App\Http\Resources\PotionRecipeResource;
use App\Potion;
use App\PotionRecipe;

class PotionRecipesController extends Controller
{
    /**
     * @param Potion $potion
     * @param CreatePotionRecipeRequest $request
     * @return PotionRecipeResource
     */
    public function store(Potion $potion, CreatePotionRecipeRequest $request)
    {
        $recipe = new PotionRecipe($request->all());
        $potion->potionRecipe()->save($recipe);

        $ingredients = collect($request->get('ingredients'))
            ->mapWithKeys(function (array $item) {
                return [$item["id"] => ['amount' => $item['amount'], 'measurement_unit' => $item['measurement_unit']]];
            });

        $recipe->ingredients()->attach($ingredients);

        return new PotionRecipeResource($recipe);
    }


    /**
     * @param Potion $potion
     * @return PotionRecipeResource
     */
    public function show(Potion $potion)
    {
        $recipe = $potion->potionRecipe;
        if (is_null($recipe))
            abort(404);

        $recipe->load('ingredients');

        return new PotionRecipeResource($recipe);
    }


    /**
     * @param Potion $potion
     * @param UpdatePotionRecipeRequest $request
     */
    public function update(Potion $potion, UpdatePotionRecipeRequest $request)
    {
        $recipe = $potion->potionRecipe;
        if (is_null($recipe))
            abort(400, 'Cannot update potion recipe because it does not exist');

        $recipe->fill($request->all());
        $recipe->save();

        if ($request->has('ingredients')) {
            $ingredients = collect($request->get('ingredients'))
                ->mapWithKeys(function (array $item) {
                    return [$item["id"] => ['amount' => $item['amount'], 'measurement_unit' => $item['measurement_unit']]];
                });

            $recipe->ingredients()->sync($ingredients);
        }
    }
}
