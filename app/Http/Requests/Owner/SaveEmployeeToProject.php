<?php

namespace App\Http\Requests\Owner;

use Illuminate\Foundation\Http\FormRequest;

class SaveEmployeeToProject extends FormRequest
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
            'gender' => 'required|in:male,female',
            'country' => 'required|min:3',
            'state' => 'required|min:3',
            'city' => 'required|min:3',
            'address' => 'required',
            'postal' => 'required|integer'
        ];
    }
}
