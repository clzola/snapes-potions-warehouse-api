<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
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
}
