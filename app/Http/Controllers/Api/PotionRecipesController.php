<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreatePotionRecipeRequest;
use App\Http\Resources\PotionRecipeResource;
use App\PotionRecipe;
use Illuminate\Http\Request;

class PotionRecipesController extends Controller
{
    /**
     * @param CreatePotionRecipeRequest $request
     * @return PotionRecipeResource
     */
    public function store(CreatePotionRecipeRequest $request)
    {
        $recipe = PotionRecipe::create($request->all());

        $ingredients = collect($request->get('ingredients'))
            ->mapWithKeys(function (array $item) {
                return [$item["id"] => ['amount' => $item['amount'], 'measurement_unit' => $item['measurement_unit']]];
            });

        $recipe->ingredients()->attach($ingredients);

        return new PotionRecipeResource($recipe);
    }
}
