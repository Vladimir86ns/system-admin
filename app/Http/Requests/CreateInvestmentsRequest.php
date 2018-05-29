<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateInvestmentsRequest extends FormRequest
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
            'name' => 'required|unique:investments_admins|min:3|max:50',
            'city' => 'required|min:3|max:50',
            'country' => 'required|min:3|max:50',
            'address' => 'required|min:3|max:100',
            'total_investition' => 'required|numeric',
        ];
    }
}
