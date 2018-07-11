<?php

namespace App\Http\Requests\Owner;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'name' => 'required|min:3',
            'size' => 'required|min:3',
            'cost' => 'required|numeric|min:1',
            'price' => 'required|numeric|min:1',
            'time_to_prepare' => 'required|numeric|min:1',
        ];
    }
}
