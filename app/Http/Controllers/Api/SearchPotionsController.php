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
     * SearchPotionsController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }

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
            ->when($request->get('brewing_time'), function(Builder $builder, $brewingTime) {
                if(isset($brewingTime['min']) && !isset($brewingTime['max']))
                    $builder->where('brewing_time', '>=', $brewingTime['min']);
                else if(isset($brewingTime['max']) && !isset($brewingTime['min']))
                    $builder->where('brewing_time', '<=', $brewingTime['max']);
                else {
                    if($brewingTime['min'] === $brewingTime['max'])
                        $builder->where('brewing_time', $brewingTime['min']);
                    else $builder->whereBetween('brewing_time', [$brewingTime['min'], $brewingTime['max']]);
                }
            })
            ->when($request->get('sort'), function(Builder $builder, $sort) use ($request) {
                foreach ($sort as $sortBy)
                    $builder->orderBy($sortBy['column'], $sortBy['direction']);
            })
            ->paginate($request->get('per_page'));

        return PotionResource::collection($potions);
    }
}
