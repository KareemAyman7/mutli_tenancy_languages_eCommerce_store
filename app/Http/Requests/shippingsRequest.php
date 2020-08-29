<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class shippingsRequest extends FormRequest
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
            'id' => 'required|exists:settings',
            'value' => 'required|string',
            'plain_value' => 'nullable|numeric',
        ];
    }

    public function messages()
    {
        return [
            'required' => __('admin\general.required_validate'),
            'numeric' => __('admin\general.numeric_validate')
        ];
    }
}
