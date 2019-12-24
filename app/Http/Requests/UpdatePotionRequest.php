<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePotionRequest extends FormRequest
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
            'name' => 'string|max:250',
            'other_names' => 'array',
            'other_names.*' => 'string|max:250',
            'potion_category_id' => 'integer|exists:potion_categories,id',
            'effect' => 'string|max:250',
            'characteristics' => 'array',
            'characteristics.*' => 'string|max:250',
            'side_effects' => 'array',
            'side_effects.*' => 'string|max:250',
            'brewing_time' => 'string|max:250',
            'potion_difficulty_level_id' => 'integer|exists:potion_difficulty_levels',
            'description' => 'string',
            "picture" => "mimes:jpeg,bmp,png",
            "picture_crop" => "array",
            "picture_crop.width" => "required_with:picture_crop|integer",
            "picture_crop.height" => "required_with:picture_crop|integer",
            "picture_crop.x" => "required_with:picture_crop|integer",
            "picture_crop.y" => "required_with:picture_crop|integer",
            'bottles' => 'integer|gte:0',
        ];
    }
}
