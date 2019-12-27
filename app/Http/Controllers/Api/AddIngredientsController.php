<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\AddIngredientsRequest;
use App\Ingredient;

class AddIngredientsController extends Controller
{
    /**
     * AddIngredientsController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }


    /**
     * @param AddIngredientsRequest $request
     * @return \Illuminate\Http\Response
     * @throws \Exception
     * @throws \Throwable
     */
    public function __invoke(AddIngredientsRequest $request)
    {
        \DB::transaction(function() use ($request) {
            foreach ($request->get('ingredients') as $ingredientInput) {
                $ingredient = Ingredient::find($ingredientInput["id"]);
                $ingredient->amount += $ingredientInput['amount'];
                $ingredient->save();
            }
        });

        return response()->noContent();
    }
}
