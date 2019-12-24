<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreatePotionDifficultyLevelRequest;
use App\Http\Requests\UpdatePotionDifficultyLevelRequest;
use App\Http\Resources\PotionDifficultyLevelResource;
use App\PotionDifficultyLevel;

class PotionDifficultyLevelsController extends Controller
{
    /**
     * PotionDifficultyLevelsController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }


    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return PotionDifficultyLevelResource::collection(
            PotionDifficultyLevel::orderBy('order')->get()
        );
    }


    /**
     * @param CreatePotionDifficultyLevelRequest $request
     * @return PotionDifficultyLevel
     */
    public function store(CreatePotionDifficultyLevelRequest $request)
    {
        $difficultyLevel = new PotionDifficultyLevel($request->all());
        $difficultyLevel->order = intval(PotionDifficultyLevel::max('order') ?? 0) + 1;
        $difficultyLevel->save();

        return new PotionDifficultyLevel($difficultyLevel);
    }


    /**
     * @param PotionDifficultyLevel $difficultyLevel
     * @return PotionDifficultyLevelResource
     */
    public function show(PotionDifficultyLevel $difficultyLevel)
    {
        return new PotionDifficultyLevelResource($difficultyLevel);
    }


    /**
     * @param PotionDifficultyLevel $difficultyLevel
     * @param UpdatePotionDifficultyLevelRequest $request
     * @return PotionDifficultyLevel
     */
    public function update(PotionDifficultyLevel $difficultyLevel, UpdatePotionDifficultyLevelRequest $request)
    {
        $difficultyLevel->fill($request->all());
        $difficultyLevel->save();

        PotionDifficultyLevel::where('order', '>=', $difficultyLevel->order)
            ->where('id', '<>', $difficultyLevel->id)
            ->update(['order' => \DB::raw('order + 1')]);

        return new PotionDifficultyLevel($difficultyLevel);
    }


    /**
     * @param PotionDifficultyLevel $difficultyLevel
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(PotionDifficultyLevel $difficultyLevel)
    {
        $difficultyLevel->delete();

        return response()->noContent();
    }
}
