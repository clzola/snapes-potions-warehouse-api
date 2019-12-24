<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePotionRecipeRequest extends FormRequest
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
            'instructions' => 'string',
            'ingredients' => 'array|min:1',
            'ingredients.*.id' => 'required_if:ingredients|integer|exists:ingredients,id',
            'ingredients.*.amount' => 'required_if:ingredients|integer|gt:0',
            'ingredients.*.measurement_unit' => 'required_if:ingredients|in:g,ml',
        ];
    }
}
