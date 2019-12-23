<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreatePotionCategoryRequest;
use App\Http\Requests\UpdatePotionCategoryRequest;
use App\Http\Resources\PotionCategoryResource;
use App\PotionCategory;
use Illuminate\Http\Request;

class PotionCategoriesController extends Controller
{
    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function listAll()
    {
        return PotionCategoryResource::collection(
            PotionCategory::orderBy('name')->get()
        );
    }


    /**
     * @param CreatePotionCategoryRequest $request
     * @return PotionCategoryResource
     */
    public function store(CreatePotionCategoryRequest $request)
    {
        return new PotionCategoryResource(
            PotionCategory::create($request->all())
        );
    }


    /**
     * @param PotionCategory $potionCategory
     * @return PotionCategoryResource
     */
    public function show(PotionCategory $potionCategory)
    {
        return new PotionCategoryResource($potionCategory);
    }


    /**
     * @param PotionCategory $potionCategory
     * @param UpdatePotionCategoryRequest $request
     * @return PotionCategoryResource
     */
    public function update(PotionCategory $potionCategory, UpdatePotionCategoryRequest $request)
    {
        $potionCategory->fill($request->all())->save();

        return new PotionCategoryResource($potionCategory);
    }
}
