<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PotionDifficultyLevelResource;
use App\PotionDifficultyLevel;

class PotionDifficultyLevelsController extends Controller
{
    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return PotionDifficultyLevelResource::collection(
            PotionDifficultyLevel::orderBy('order')->get()
        );
    }
}
