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
     * PotionRecipesController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }


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
                return [
                    $item["id"] => [
                        'amount' => $item['amount'],
                        'measurement_unit' => $item['measurement_unit'],
                        'named_amount_id' => $item['named_amount_id'],
                    ],
                ];
            });

        $recipe->ingredients()->attach($ingredients);
        $recipe->equipment()->attach($request->get('equipment'));

        return new PotionRecipeResource($recipe);
    }


    /**
     * @param PotionRecipe $recipe
     * @return PotionRecipeResource
     */
    public function show(PotionRecipe $recipe)
    {
        $recipe->load(['ingredients', 'equipment']);

        return new PotionRecipeResource($recipe);
    }


    /**
     * @param PotionRecipe $recipe
     * @param UpdatePotionRecipeRequest $request
     */
    public function update(PotionRecipe $recipe, UpdatePotionRecipeRequest $request)
    {
        $recipe->fill($request->all());
        $recipe->save();

        if ($request->has('ingredients')) {
            $ingredients = collect($request->get('ingredients'))
                ->mapWithKeys(function (array $item) {
                    return [
                        $item["id"] => [
                            'amount' => $item['amount'],
                            'measurement_unit' => $item['measurement_unit'],
                            'named_amount_id' => $item['named_amount_id'],
                        ],
                    ];
                });

            $recipe->ingredients()->sync($ingredients);
        }

        if ($request->has('equipment')) {
            $recipe->equipment()->sync($request->get('equipment'));
        }
    }

    /**
     * @param PotionRecipe $recipe
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(PotionRecipe $recipe)
    {
        $recipe->delete();

        return response()->noContent();
    }
}
