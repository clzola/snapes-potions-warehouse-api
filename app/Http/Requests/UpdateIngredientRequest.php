<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateIngredientRequest extends FormRequest
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
        $pictureRules = [
            'mimes:jpeg,bmp,png',
        ];

        if(!$this->has('picture_crop')) {
            $pictureRules[] = Rule::dimensions()->ratio(1.0);
        }

        return [
            "name" => "string|max:250",
            "description" => "string",
            "amount" => "integer|gt:0",
            "measurement_unit" => "string|in:g,ml",
            "picture" => $pictureRules,
            "picture_crop" => "array",
            "picture_crop.width" => "required_with:picture_crop|integer",
            "picture_crop.height" => "required_with:picture_crop|integer",
            "picture_crop.x" => "required_with:picture_crop|integer",
            "picture_crop.y" => "required_with:picture_crop|integer",
        ];
    }
}
