<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateIngredientPictureRequest extends FormRequest
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
            'required',
            'mimes:jpeg,bmp,png',
        ];

        if(!$this->has('picture_crop')) {
            $pictureRules[] = Rule::dimensions()->ratio(1.0);
        }

        return [
            "picture" => $pictureRules,
            "picture_crop" => "array",
            "picture_crop.width" => "required_with:picture_crop|integer",
            "picture_crop.height" => "required_with:picture_crop|integer",
            "picture_crop.x" => "required_with:picture_crop|integer",
            "picture_crop.y" => "required_with:picture_crop|integer",
        ];
    }
}
