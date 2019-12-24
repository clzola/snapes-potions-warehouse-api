<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePotionRecipeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'potion_id' => 'required|integer|exists:potions,id',
            'instructions' => 'required|string',
            'ingredients' => 'required|array',
            'ingredients.*.id' => 'required|integer|exists:ingredients,id',
            'ingredients.*.amount' => 'required|integer|gt:0',
            'ingredients.*.measurement_unit' => 'required|in:g,ml',
        ];
    }
}
