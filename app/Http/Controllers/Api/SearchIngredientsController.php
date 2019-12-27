<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SearchIngredientsRequest;
use App\Http\Resources\IngredientResource;
use App\Ingredient;
use Illuminate\Database\Eloquent\Builder;

class SearchIngredientsController extends Controller
{
    /**
     * @param SearchIngredientsRequest $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function __invoke(SearchIngredientsRequest $request)
    {
        $ingredients = Ingredient::query()
            ->when($request->get('search_term'), function (Builder $builder, $searchTerm) {
                $builder->where('name', 'like', "%$searchTerm%");
            })
            ->when($request->get('sort'), function(Builder $builder, $sort) use ($request) {
                foreach ($sort as $sortBy)
                    $builder->orderBy($sortBy['column'], $sortBy['direction']);
            })
            ->paginate($request->get('per_page'));

        return IngredientResource::collection($ingredients);
    }
}
