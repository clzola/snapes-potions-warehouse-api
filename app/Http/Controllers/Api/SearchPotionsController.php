<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SearchPotionsRequest;
use App\Http\Resources\PotionResource;
use App\Potion;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class SearchPotionsController
 * @package App\Http\Controllers\Api
 */
class SearchPotionsController extends Controller
{
    /**
     * @param SearchPotionsRequest $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function __invoke(SearchPotionsRequest $request)
    {
        $potions = Potion::with(['potionCategory', 'potionDifficultyLevel'])
            ->when($request->get('search_term'), function (Builder $builder, $searchTerm) {
                $builder->where(function (Builder $builder) use ($searchTerm) {
                    $builder->where('name', 'like', "%$searchTerm%")
                        ->orWhereRaw("JSON_SEARCH(other_names, 'one', '%$searchTerm%')");
                });
            })
            ->when($request->get('potion_category_id'), function (Builder $builder, $potionCategoryId) {
                $builder->where('potion_category_id', $potionCategoryId);
            })
            ->when($request->get('potion_difficulty_level_id'), function (Builder $builder, $potionDifficultyLevelId) {
                $builder->where('potion_difficulty_level_id', $potionDifficultyLevelId);
            })
            ->when($request->get('sort'), function(Builder $builder, $sort) use ($request) {
                foreach ($sort as $sortBy) {
                    $builder->orderBy($sortBy['column'], (isset($sortBy['asc']) && boolval($sortBy['asc'])) ? 'asc' : 'desc');
                }
            })
            ->paginate($request->get('per_page'));

        return PotionResource::collection($potions);
    }
}
