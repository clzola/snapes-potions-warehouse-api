<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateIngredientRequest extends FormRequest
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
            "name" => "required|string|max:250",
            "description" => "required|string",
            "picture" => "mimes:jpeg,bmp,png",
            "picture_crop" => "array",
            "picture_crop.width" => "required_with:picture_crop|integer",
            "picture_crop.height" => "required_with:picture_crop|integer",
            "picture_crop.x" => "required_with:picture_crop|integer",
            "picture_crop.y" => "required_with:picture_crop|integer",
            "amount" => "required|integer|gt:0",
            "measurement_unit" => "required|string|in:g,ml"
        ];
    }
}
