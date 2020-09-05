<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
            'name' => 'required|string',
            'email' => 'required|unique:admins,email,'.$this->id,
        ];
    }

    public function messages()
    {
        return [
            'required' => __('admin\general.required_validate'),
            'numeric' => __('admin\general.numeric_validate'),
            'unique' => __('admin\general.unique_validate'),
        ];
    }
}
