<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HouseIndexRequest extends FormRequest
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
            'name' => 'string|nullable',
            'min_price' => 'integer|nullable',
            'max_price' => 'integer|nullable',
            'bedrooms' => 'integer|nullable',
            'bathrooms' => 'integer|nullable',
            'storeys' => 'integer|nullable',
            'garages' => 'integer|nullable',
        ];
    }
}
