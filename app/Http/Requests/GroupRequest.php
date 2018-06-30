<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class GroupRequest extends FormRequest
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
        switch ($this->method()) {
            case 'GET':
            case 'DELETE':
                return [];
                break;
            case 'POST':
                return [
                    'name' => 'required|unique:roles,name'
                ];
                break;
            case 'PUT':
            case 'PATCH':
                return [
                    'name' => 'required|unique:roles,name,'. $this->group
                ];
                break;
            default:
                return [];
                break;
        }
    }
}
