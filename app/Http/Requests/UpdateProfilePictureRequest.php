<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfilePictureRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // TODO: Check if is authorized to create user
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
            "profile_picture" => "required|mimes:jpeg,bmp,png",
            "profile_picture_crop" => "array",
            "profile_picture_crop.width" => "required_with:profile_picture_crop|integer",
            "profile_picture_crop.height" => "required_with:profile_picture_crop|integer",
            "profile_picture_crop.x" => "required_with:profile_picture_crop|integer",
            "profile_picture_crop.y" => "required_with:profile_picture_crop|integer",
        ];
    }
}
