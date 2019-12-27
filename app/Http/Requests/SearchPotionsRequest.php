<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SearchPotionsRequest extends FormRequest
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
            'search_term' => 'string',
            'potion_category_id' => 'integer',
            'potion_difficulty_level_id' => 'integer',
            'sort' => 'array',
            'sort.*.column' => [
                'required_with:sort',
                'string',
                Rule::in([
                    'name',
                    'potion_category_id',
                    'potion_difficulty_level_id',
                    'bottles',
                    'created_at',
                    'updated_at',
                ])
            ],
            'sort.*.direction' => 'string|in:asc,desc',
            'page' => 'integer',
            'per_page' => 'integer',
        ];
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $input = $this->all();

        if(isset($input['sort'])) {
            foreach ($input['sort'] as &$sort) {
                if(isset($sort['direction']))
                    $sort['direction'] = strtolower($sort['direction']);
                else $sort['direction'] = 'asc';
            }
        }

        $this->replace($input);
    }
}
