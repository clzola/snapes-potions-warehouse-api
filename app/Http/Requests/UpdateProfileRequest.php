<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProfileRequest extends FormRequest
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
        $user = auth('api')->user();

        return [
            "title" => "required|string|max:250",
            "name" => "required|string|max:250",
            "email" => [
                "required",
                "string",
                "email",
                "max:250",
                Rule::unique("users")->ignore($user->id),
            ],
        ];
    }
}
